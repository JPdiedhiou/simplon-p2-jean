<?php 

function input($id){
	/* utilisation du ternaire a travers la $value 
	$value='<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>;
	*/
	$value = isset($_POST['$id']) ? $_POST['$id'] : '';
 return "<input type='text' class='form-control' id='$id' name='$id' value='$value'>";
}

function textarea($id){
	/* utilisation du ternaire a travers la $value 
	$value='<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>;
	*/
	$value = isset($_POST['$id']) ? $_POST['$id'] : '';
return "<textarea type='text' class='form-control' id='$id' name='$id'>$value</textarea>";
}

function select($id, $options = array()){
	$return = "<select class='form-control' id='$id' name='$id' >";
	foreach($options as $k => $v){
		$selected= '';
		if (isset($_POST[$id]) && $k == $_POST[$id]) {
			$selected = 'selected = "selected"';
		}
		$return .= "<option value='$k' $selected>$v</options>";
	}
	$return .= '</select>';
return $return;
}
