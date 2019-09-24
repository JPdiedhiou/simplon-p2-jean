<?php
/**
 * Logistic Transport Theme Customizer
 *
 * @package Logistic Transport
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function logistic_transport_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'logistic_transport_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'logistic-transport' ),
	) );

	//Layouts
	$wp_customize->add_section( 'logistic_transport_left_right', array(
    	'title'      => __( 'Theme Layout Settings', 'logistic-transport' ),
		'priority'   => 30,
		'panel' => 'logistic_transport_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('logistic_transport_theme_options',array(
	        'default' => __( 'Right Sidebar', 'logistic-transport' ),
	        'sanitize_callback' => 'logistic_transport_sanitize_choices'
	) );

	$wp_customize->add_control('logistic_transport_theme_options',
	    array(
	        'type' => 'radio',
	        'section' => 'logistic_transport_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','logistic-transport'),
	            'Right Sidebar' => __('Right Sidebar','logistic-transport'),
	            'One Column' => __('One Column','logistic-transport'),
	            'Three Columns' => __('Three Columns','logistic-transport'),
	            'Four Columns' => __('Four Columns','logistic-transport'),
	            'Grid Layout' => __('Grid Layout','logistic-transport')
	        ),
	    )
    );

    $font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Kavoon' =>'Kavoon',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//add home page setting pannel
	$wp_customize->add_panel( 'logistic_transport_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'logistic-transport' ),
	    'description' => __( 'Description of what this panel does.', 'logistic-transport' )
	) );

	//Color / Font Pallete
	$wp_customize->add_section( 'logistic_transport_typography', array(
    	'title'      => __( 'Color / Font Pallete', 'logistic-transport' ),
		'priority'   => 30,
		'panel' => 'logistic_transport_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'logistic_transport_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_paragraph_color', array(
		'label' => __('Paragraph Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_paragraph_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( 'Paragraph Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	$wp_customize->add_setting('logistic_transport_paragraph_font_size',array(
		'default'	=> '12px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('logistic_transport_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','logistic-transport'),
		'section'	=> 'logistic_transport_typography',
		'setting'	=> 'logistic_transport_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'logistic_transport_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_atag_color', array(
		'label' => __('"a" Tag Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_atag_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( '"a" Tag Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'logistic_transport_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_li_color', array(
		'label' => __('"li" Tag Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_li_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( '"li" Tag Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'logistic_transport_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_h1_color', array(
		'label' => __('H1 Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_h1_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( 'H1 Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('logistic_transport_h1_font_size',array(
		'default'	=> '50px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('logistic_transport_h1_font_size',array(
		'label'	=> __('H1 Font Size','logistic-transport'),
		'section'	=> 'logistic_transport_typography',
		'setting'	=> 'logistic_transport_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'logistic_transport_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_h2_color', array(
		'label' => __('h2 Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_h2_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( 'h2 Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('logistic_transport_h2_font_size',array(
		'default'	=> '45px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('logistic_transport_h2_font_size',array(
		'label'	=> __('h2 Font Size','logistic-transport'),
		'section'	=> 'logistic_transport_typography',
		'setting'	=> 'logistic_transport_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'logistic_transport_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_h3_color', array(
		'label' => __('h3 Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_h3_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( 'h3 Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('logistic_transport_h3_font_size',array(
		'default'	=> '36px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('logistic_transport_h3_font_size',array(
		'label'	=> __('h3 Font Size','logistic-transport'),
		'section'	=> 'logistic_transport_typography',
		'setting'	=> 'logistic_transport_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'logistic_transport_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_h4_color', array(
		'label' => __('h4 Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_h4_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( 'h4 Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('logistic_transport_h4_font_size',array(
		'default'	=> '30px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('logistic_transport_h4_font_size',array(
		'label'	=> __('h4 Font Size','logistic-transport'),
		'section'	=> 'logistic_transport_typography',
		'setting'	=> 'logistic_transport_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'logistic_transport_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_h5_color', array(
		'label' => __('h5 Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_h5_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( 'h5 Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('logistic_transport_h5_font_size',array(
		'default'	=> '25px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('logistic_transport_h5_font_size',array(
		'label'	=> __('h5 Font Size','logistic-transport'),
		'section'	=> 'logistic_transport_typography',
		'setting'	=> 'logistic_transport_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'logistic_transport_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logistic_transport_h6_color', array(
		'label' => __('h6 Color', 'logistic-transport'),
		'section' => 'logistic_transport_typography',
		'settings' => 'logistic_transport_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('logistic_transport_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'logistic_transport_sanitize_choices'
	));
	$wp_customize->add_control(
	    'logistic_transport_h6_font_family', array(
	    'section'  => 'logistic_transport_typography',
	    'label'    => __( 'h6 Fonts','logistic-transport'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('logistic_transport_h6_font_size',array(
		'default'	=> '18px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('logistic_transport_h6_font_size',array(
		'label'	=> __('h6 Font Size','logistic-transport'),
		'section'	=> 'logistic_transport_typography',
		'setting'	=> 'logistic_transport_h6_font_size',
		'type'	=> 'text'
	));

	$wp_customize->add_section( 'logistic_transport_left_right', array(
    	'title'      => __( 'Layout Settings', 'logistic-transport' ),
		'priority'   => null,
		'panel' => 'logistic_transport_panel_id'
	) );


    //topbar
	$wp_customize->add_section('logistic_transport_topbar',array(
		'title'	=> __('Social Icons','logistic-transport'),
		'priority'	=> null,
		'panel' => 'logistic_transport_panel_id',
	));

	$wp_customize->add_setting('logistic_transport_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('logistic_transport_facebook_url',array(
		'label'	=> __('Add Facebook link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('logistic_transport_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('logistic_transport_twitter_url',array(
		'label'	=> __('Add Twitter link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('logistic_transport_google_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('logistic_transport_google_url',array(
		'label'	=> __('Add Instagram link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_google_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('logistic_transport_linkdin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('logistic_transport_linkdin_url',array(
		'label'	=> __('Add Linkdin link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_linkdin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('logistic_transport_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('logistic_transport_youtube_url',array(
		'label'	=> __('Add Youtube link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_youtube_url',
		'type'		=> 'url'
	));

	//Header
	$wp_customize->add_section('logistic_transport_header',array(
		'title'	=> __('Header','logistic-transport'),
		'priority'	=> null,
		'panel' => 'logistic_transport_panel_id',
	));

	$wp_customize->add_setting('logistic_transport_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('logistic_transport_call',array(
		'label'	=> __('Call Number','logistic-transport'),
		'section'	=> 'logistic_transport_header',
		'setting'	=> 'logistic_transport_call',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('logistic_transport_mail',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('logistic_transport_mail',array(
		'label'	=> __('Email Address','logistic-transport'),
		'section'	=> 'logistic_transport_header',
		'setting'	=> 'logistic_transport_mail',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('logistic_transport_time',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('logistic_transport_time',array(
		'label'	=> __('Time','logistic-transport'),
		'section'	=> 'logistic_transport_header',
		'setting'	=> 'logistic_transport_time',
		'type'	=> 'text'
	));

	//home page slider
	$wp_customize->add_section( 'logistic_transport_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'logistic-transport' ),
		'priority'   => null,
		'panel' => 'logistic_transport_panel_id'
	) );

	$wp_customize->add_setting('logistic_transport_slider_hide_show',array(
       'default' => 'true',
       'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('logistic_transport_slider_hide_show',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider','logistic-transport'),
	   'section' => 'logistic_transport_slidersettings',
	));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'logistic_transport_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'logistic_transport_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'logistic_transport_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'logistic-transport' ),
			'section'  => 'logistic_transport_slidersettings',
			'type'     => 'dropdown-pages'
		) );

	}

	//Services
	$wp_customize->add_section('logistic_transport_services',array(
		'title'	=> __('Services Section','logistic-transport'),
		'panel' => 'logistic_transport_panel_id',
	));	

	$categories = get_categories();
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';	
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('logistic_transport_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('logistic_transport_services_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display Latest Post','logistic-transport'),
		'description'=> __('Size of image should be 80 x 80 ','logistic-transport'),
		'section' => 'logistic_transport_services',
	));

	//About More
	$wp_customize->add_section('logistic_transport_discover',array(
		'title'	=> __('About Section','logistic-transport'),
		'panel' => 'logistic_transport_panel_id',
	));

	$post_list = get_posts();
	$i = 0;
	$posts[]='Select';	
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('logistic_transport_discover_post',array(
		'sanitize_callback' => 'logistic_transport_sanitize_choices',
	));
	$wp_customize->add_control('logistic_transport_discover_post',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','logistic-transport'),
		'section' => 'logistic_transport_discover',
	));

	//Footer
	$wp_customize->add_section('logistic_transport_footer_section',array(
		'title'	=> __('Copyright','logistic-transport'),
		'priority'	=> null,
		'panel' => 'logistic_transport_panel_id',
	));
	
	$wp_customize->add_setting('logistic_transport_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('logistic_transport_footer_copy',array(
		'label'	=> __('Copyright Text','logistic-transport'),
		'section'	=> 'logistic_transport_footer_section',
		'type'		=> 'text'
	));
	/** home page setions end here**/	
}
add_action( 'customize_register', 'logistic_transport_customize_register' );


/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Logistic_Transport_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );
		
		// Register custom section types.
		$manager->register_section_type( 'Logistic_Transport_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Logistic_Transport_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Transport Pro Theme', 'logistic-transport' ),
					'pro_text' => esc_html__( 'Go Pro','logistic-transport' ),
					'pro_url'  => esc_url( 'https://www.themescaliber.com/themes/transport-wordpress-theme/' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'logistic-transport-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'logistic-transport-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Logistic_Transport_Customize::get_instance();