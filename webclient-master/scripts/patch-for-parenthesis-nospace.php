#!/usr/bin/env php
<?PHP
/**
 * As requested several times, to get my self to stop using typeof(x) in favour of typeof x, I'd writen this script
 * that will fix all current/previous usages of this "bad" pattern.
 *
 * This script can be used in jenkins, to verify the code for typeof(x) and will return -1 if such are found.
 *
 * If argument "fixit" is passed as 1st argument, the script would replace ALL usages found (Except for several
 * folders, as vendor/).
 */
define("BASEDIR", realpath(dirname(__FILE__)."/../"));

$FAILED = 0;

$changed_files = array();

function changed_file($fp) {
	global $changed_files;

	$changed_files[] = $fp;
}
function show_git_revert_command() {
	global $changed_files;
	if (count($changed_files) > 0) {
		echo "To revert your changes, type this:\n";
		echo "> git clone " . implode($changed_files, " ") . "\n";
	}
}

function fail($msg) {
	global $FAILED;

	$FAILED++;
	echo $msg."\n";
}

function check_for_typeof($dir) {
	$r = 0;
	foreach(glob($dir."/*.js") as $f) {
		$file_contents = file_get_contents($f);

		$pattern = '#(.*)for\((.*)#U';
		$replacement = '$1for ($2';

		$foundMatches = preg_match_all($pattern, $file_contents, $matches);

		if ($foundMatches) {
			fail("Bad usage found in: " . $f);

			if ($foundMatches){
				echo "Found matches:\n";
				foreach($matches[0] as $line) {
					$replaced_with = preg_replace($pattern, $replacement, $line);
					echo "\t" . $line . " -=> " . $replaced_with . "\n";
				}
			}

			global $argv;

			if (isset($argv[1]) && $argv[1] === "fixit") {
				$file_contents = preg_replace( $pattern, $replacement, $file_contents );
				changed_file( $f );
				file_put_contents($f, $file_contents);
				echo "----- File automatically fixed. -----\n";
			}
		}
	}
}



function recurse_dirs($root, $cb) {

	$iter = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
		RecursiveIteratorIterator::SELF_FIRST,
		RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
	);



	foreach ($iter as $path => $dir) {
		if ($dir->isDir()) {
			if (strpos($dir, "/.") !== false) {
				continue;
			}
			if (strpos($dir, "/__") !== false) {
				continue;
			}
			if (strpos($dir, "/test") !== false) {
				continue;
			}
			if (strpos($dir, "/docs") !== false) {
				continue;
			}
			if (strpos($dir, "/dont-deploy") !== false) {
				continue;
			}
			if (strpos($dir, "/node_modules") !== false) {
				continue;
			}
			if (strpos($dir, "/vendor") !== false) {
				continue;
			}
			if (strpos($dir, "/coverage") !== false) {
				continue;
			}
			$cb($path);
		}
	}
}

recurse_dirs(BASEDIR, function($d) {
	check_for_typeof($d);
});

echo "\n";

show_git_revert_command();

echo "\n";

if ($FAILED > 0) {
	echo "Failed with: ".$FAILED." errors.\n";
	exit -1;
}
