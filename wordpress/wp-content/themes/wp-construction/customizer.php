<?php
add_action( 'customize_register', 'wp_construction_customizer' );
function wp_construction_customizer($wp_customize)
{  
	// Default Images
	$logo = esc_url(get_template_directory_uri() ."/assets/img/Logo.png");

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.logobrand-desktop .site-title',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.logobrand-desktop a p',
	) );
	$wp_customize->selective_refresh->add_partial( 'construction_logo', array(
		'selector' => '.logobrand-desktop a.logoo',
	) );

	$wp_customize->add_panel( 'wp_construction_theme_option', 
		array('title' => esc_html__( 'HomePage Options','wp-construction' ), 
		'priority' => 1 
	));

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'refresh';
	

	// general Settings start
	$wp_customize->add_section('general_sec',	
		array('title' =>  esc_html__( 'General Options','wp-construction' ),
			'panel'=>'wp_construction_theme_option',
            'description' => esc_html__('Here you can manage General Options(Like:- Custom Css etc.)','wp-construction'),
			'capability'=>'edit_theme_options',
            'priority' => 32,
        ));

	// logo height width //
	$wp_customize->add_setting(
		'construction_logo_heigth',
		array(
			'type'    => 'theme_mod',
			'default'=>102,
			'sanitize_callback'=>'wp_construction_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( new wp_construction_Customizer_Range_Value_Control( $wp_customize, 'logo_height', array(
	'type'     => 'range-value',
	'section'  => 'general_sec',
	'settings' => 'construction_logo_heigth',
	'label'    => __( 'Logo Height','wp-construction' ),
	'input_attrs' => array(
		'min'    => 1,
		'max'    => 500,
		'step'   => 1,
		'suffix' => 'px', //optional suffix
  	),
	)));
	
	$wp_customize->add_setting(
		'construction_logo_width',
		array(
			'type'    => 'theme_mod',
			'default'=>230,
			'sanitize_callback'=>'wp_construction_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);	
	$wp_customize->add_control( new wp_construction_Customizer_Range_Value_Control( $wp_customize, 'logo_width', array(
	'type'     => 'range-value',
	'section'  => 'general_sec',
	'settings' => 'construction_logo_width',
	'label'    => __('Logo Width','wp-construction' ),
	'input_attrs' => array(
		'min'    => 1,
		'max'    => 310,
		'step'   => 1,
		'suffix' => 'px', //optional suffix
  	),
	)));
	// logo height width //
		
	$wp_customize->add_setting(
		'construction_search_box',
		array(
			'type'    => 'theme_mod',
			'default'=>1,
			'sanitize_callback'=>'wp_construction_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'construction_search_box', array(
		'label'        => __( 'Enable Search Box on Homepage', 'wp-construction' ),
		'type'=>'checkbox',
		'section'  => 'general_sec',
		'settings'   => 'construction_search_box',
	) );

	$wp_customize->selective_refresh->add_partial( 'construction_search_box', array(
		'selector' => '.home_toop_search form',
	) );

	$wp_customize->add_setting(
		'construction_sticky_head',
		array(
			'type'    => 'theme_mod',
			'default'=>1,
			'sanitize_callback'=>'wp_construction_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'construction_sticky_header', array(
		'label'        => __( 'Enable sticky Header', 'wp-construction' ),
		'type'=>'checkbox',
		'section'  => 'general_sec',
		'settings'   => 'construction_sticky_head',
	) );
	
	$wp_customize->add_setting('construction_box_layout',
        array(
			'type'=>'theme_mod',
            'sanitize_callback' => 'wp_construction_sanitize_text',
			'capability'        => 'edit_theme_options',
        )
    );
    $wp_customize->add_control('construction_box_layout', array(
		'label'=>__( 'Boxed Layout', 'wp-construction' ),
        'section' => 'general_sec',
        'type'    => 'select',
        'choices' => array(
            '1'   => __('Full-Width', 'wp-construction'),
            '2'   => __('Boxed', 'wp-construction'),
        ),
		'settings'=>'construction_box_layout',
    )); 


	/* Slider Section */
	$wp_customize->add_section(
        'slider_sec',
        array(
            'title' => __('Theme Slider Options','wp-construction'),
			'panel'=>'wp_construction_theme_option',
            'description' => __('Here you can add slider images','wp-construction'),
			'capability'=>'edit_theme_options',
            'priority' => 36,
			'active_callback' => 'is_front_page',
        )
    );

    $wp_customize->add_setting(
		'slider_home',
		array(
			'type'    => 'theme_mod',
			'default'=>1,
			'sanitize_callback'=>'wp_construction_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'slider_home', array(
		'label'        => __( 'Enable Slider on Homepage', 'wp-construction' ),
		'type'=>'checkbox',
		'section'  => 'slider_sec',
		'settings'   => 'slider_home',
	) );

	$wp_customize->add_setting(
		'construction_slide_image_1',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_setting(
		'construction_slide_image_2',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'construction_slide_image_3',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_setting(
		'construction_slide_title_1',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'wp_construction_sanitize_text'
		)
	);
	for ($i=1; $i <4 ; $i++) { 
	$wp_customize->selective_refresh->add_partial( 'construction_slide_title_'.$i, array(
		'selector' => '.sl-slider .slider_'.$i.' h2.title',
	) );
	$wp_customize->selective_refresh->add_partial( 'slide_desc_'.$i, array(
		'selector' => '.sl-slider .slider_'.$i.' blockquote',
	) );
	$wp_customize->selective_refresh->add_partial( 'construction_slide_link_'.$i, array(
		'selector' => '.sl-slider .slider_'.$i.' .slider-btn-start',
	) );
	}
	$wp_customize->add_setting(
		'construction_slide_title_2',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'wp_construction_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'construction_slide_title_3',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'wp_construction_sanitize_text'
		)
	);
	$wp_customize->add_setting(
	'slide_desc_1',
		array(
		'type'    => 'theme_mod',
		'default'=>'',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'capability'=>'edit_theme_options'
	));	
	
	$wp_customize->add_setting(
	'slide_desc_2',
		array(
		'type'    => 'theme_mod',
		'default'=>'',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'capability'=>'edit_theme_options'
	));	
	
	$wp_customize->add_setting(
	'slide_desc_3',
		array(
		'type'    => 'theme_mod',
		'default'=>'',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'capability'=>'edit_theme_options'
	));	
	$wp_customize->add_setting(
		'construction_slide_link_1',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	
	$wp_customize->add_setting(
		'construction_slide_link_2',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'construction_slide_link_3',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);

	$wp_customize->add_setting(
		'construction_buttun_text-1',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'wp_construction_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'construction_buttun_text-2',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'wp_construction_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'construction_buttun_text-3',
		array(
			'type'    => 'theme_mod',
			'default'=>'',
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'wp_construction_sanitize_text'
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'construction_slider_image_1', array(
		'label'        => __( 'Slider Image One', 'wp-construction' ),
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_image_1'
	) ) );
	$wp_customize->add_control( 'construction_slide_title_1', array(
		'label'        => __( 'Slider title one', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_title_1'
	) );
	
	$wp_customize->add_control('slide_desc_1', array(
		'label'        => __( 'Slider description one', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc_1'
	));	
	$wp_customize->add_control( 'slide_btnlink_1', array(
		'label'        => __( 'Slider Button Link', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_link_1'
	) );
	$wp_customize->add_control( 'real_button_1', array(
		'label'        => __( 'Slider Button Text One', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'construction_buttun_text-1'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'construction_slider_image_2', array(
		'label'        => __( 'Slider Image Two ', 'wp-construction' ),
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_image_2'
	) ) );
	
	$wp_customize->add_control( 'slide_title_2', array(
		'label'        => __( 'Slider Title Two', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_title_2'
	) );
	$wp_customize->add_control('slide_desc_2', array(
		'label'        => __( 'Slider description Two', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc_2'
	));
	$wp_customize->add_control( 'slide_btnlink_2', array(
		'label'        => __( 'Slider Link Two', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_link_2'
	) );
	$wp_customize->add_control( 'real_button_2', array(
		'label'        => __( 'Slider Button Text Two', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'construction_buttun_text-2'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'construction_slider_image_3', array(
		'label'        => __( 'Slider Image Three', 'wp-construction' ),
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_image_3'
	) ) );
	$wp_customize->add_control( 'slide_title_3', array(
		'label'        => __( 'Slider Title Three', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_title_3'
	) );
	$wp_customize->add_control('slide_desc_3', array(
		'label'        => __( 'Slider description Three', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc_3'
	));
	$wp_customize->add_control( 'slide_btnlink_3', array(
		'label'        => __( 'Slider Button Link Three', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'construction_slide_link_3'
	) );
	$wp_customize->add_control( 'construction_button_3', array(
		'label'        => __( 'Slider Button Text Three', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'construction_buttun_text-3'
	) );

	/* Blog Option */
	$wp_customize->add_section('blog_section',array(
	'title'=>__("Home Blog Options","wp-construction"),
	'panel'=>'wp_construction_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 40
	));
	$wp_customize->add_setting(
	'blog_home',
	array(
		'type'    => 'theme_mod',
		'default'=>1,
		'sanitize_callback'=>'wp_construction_sanitize_checkbox',
		'capability' => 'edit_theme_options'
	)
	);
	$wp_customize->add_control( 'construction_show_blog', array(
		'label'        => __( 'Enable Blog on Home', 'wp-construction' ),
		'type'=>'checkbox',
		'section'    => 'blog_section',
		'settings'   => 'blog_home'
	) );
	$wp_customize->add_setting(
	'construction_blog_title',
		array(
		'default'=>'Our Blogs',
		'type'=>'theme_mod',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'construction_blog_title', array(
		'selector' => '#blog1 .block-heading h1',
	) );
	$wp_customize->add_control( 'construction_blog_title', array(
		'label'        => __( 'Home Blog Title', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'blog_section',
		'settings'   => 'construction_blog_title'
	) );

	$wp_customize->add_setting(
	'construction_blog_desc',
		array(
		'default'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
		'type'=>'theme_mod',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'construction_blog_desc', array(
		'selector' => '#blog1 .block-heading p',
	) );
	$wp_customize->add_control( 'construction_blog_desc', array(
		'label'        => __( 'Home Blog Description', 'wp-construction' ),
		'type'=>'textarea',
		'section'    => 'blog_section',
		'settings'   => 'construction_blog_desc'
	) );

	$wp_customize->add_setting( 'excerpt_blog', array(
        'default'=>30,
        'type'=>'theme_mod',
        'sanitize_callback'=>'wp_construction_sanitize_integer',
        'capability'=>'edit_theme_options'
    ) );
        $wp_customize->add_control( 'excerpt_blog', array(
        'label'        => __( 'Excerpt length blog section', 'wp-construction' ),
        'type'=>'number',
        'section'    => 'blog_section',
		'description' => esc_html__('Excerpt length only for home blog section.', 'wp-construction'),
		'settings'   => 'excerpt_blog'
    ) );

    $wp_customize->add_setting( 'construction_blog_no', array(
        'default'=>6,
        'type'=>'theme_mod',
        'sanitize_callback'=>'wp_construction_sanitize_integer',
        'capability'=>'edit_theme_options'
    ) );
        $wp_customize->add_control( 'number_blog', array(
        'label'        => __( 'No. of Blogs', 'wp-construction' ),
        'type'=>'number',
        'section'    => 'blog_section',
		'description' => esc_html__('type no of blogs to display.', 'wp-construction'),
		'settings'   => 'construction_blog_no'
    ) );

	
	$wp_customize->add_setting('construction_blog_cat', array(
		'type' => 'theme_mod',
		'capability'=>'edit_theme_options',
        'sanitize_callback' => 'wp_construction_sanitize_select'
    ));
         
    $wp_customize->add_control('construction_blog_cat', array(
        'label' => esc_html__( 'Choose Post Category', 'wp-construction' ),
        'section' => 'blog_section',
        'type' => 'select',
        'choices' => wp_construction_category_Control(),
    ));  
	
	/* Social options */
	$wp_customize->add_section('social_section',array(
	'title'=>__("Social Options","wp-construction"),
	'panel'=>'wp_construction_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 42
	));
	$wp_customize->add_setting(
	'header_social',
		array(
		'default'=>1,
		'type'=>'theme_mod',
		'sanitize_callback'=>'wp_construction_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'header_social', array(
		'selector' => '.header-social .social-icons',
	) );
	$wp_customize->add_control( 'header_social_media_in_enabled', array(
		'label'        => __( 'Enable Social Media Icons in Header', 'wp-construction' ),
		'type'=>'checkbox',
		'section'    => 'social_section',
		'settings'   => 'header_social'
	) );

	$wp_customize->add_setting(
	'footer_social',
		array(
		'default'=>1,
		'type'=>'theme_mod',
		'sanitize_callback'=>'wp_construction_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'footer_social', array(
		'selector' => '.cont-socia-linkl',
	) );
	$wp_customize->add_control( 'footer_section_social_media_enbled', array(
		'label'        => __( 'Enable Social Media Icons in Footer', 'wp-construction' ),
		'type'=>'checkbox',
		'section'    => 'social_section',
		'settings'   => 'footer_social'
	) );
	$wp_customize->add_setting(
	'twitter_link',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'twitter_linkk', array(
		'label'        =>  __('Twitter', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'twitter_link'
	) );
	$wp_customize->add_setting(
	'facebook_link',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'facebook_linkk', array(
		'label'        => __( 'Facebook', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'facebook_link'
	) );
	$wp_customize->add_setting(
	'linkedin_link',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'linkedin_linkk', array(
		'label'        => __( 'LinkedIn', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'linkedin_link'
	) );
	$wp_customize->add_setting(
	'youtube_link',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'youtube_linkk', array(
		'label'        => __( 'Youtube_link', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'youtube_link'
	) );
	$wp_customize->add_setting(
	'google_plus',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'google_pluss', array(
		'label'        => __( 'Google+', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'google_plus'
	) );
		$wp_customize->add_setting(
	'rss_link',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'rss_linkk', array(
		'label'        => __( 'rss_link', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'rss_link'
	) );
		$wp_customize->add_setting(
	'flicker_link',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'sanitize_callback'=>'esc_url_raw',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'flicker_linkk', array(
		'label'        => __( 'flicker_link', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'flicker_link'
	) );
	$wp_customize->add_setting(
	'construction_email',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'is_email',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'construction_email', array(
		'selector' => '.construction_email',
	) );
		$wp_customize->add_control( 'contact_email', array(
		'label'        => __( 'Email-ID', 'wp-construction' ),
		'type'=>'email',
		'section'    => 'social_section',
		'settings'   => 'construction_email'
	) );
	$wp_customize->add_setting(
	'construction_phone',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'wp_construction_sanitize_integer',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'construction_phone', array(
		'selector' => '.constuction-header-box.construction_phone',
	) );
		$wp_customize->add_control( 'construction_phone', array(
		'label'        => __( 'Phone Number', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'social_section',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'settings'   => 'construction_phone'
	) );
	$wp_customize->add_setting(
	'construction_address',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'construction_address', array(
		'selector' => '.construction_address',
	) );
		$wp_customize->add_control( 'address', array(
		'label'        => __( 'Address', 'wp-construction' ),
		'type'=>'textarea',
		'section'    => 'social_section',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'settings'   => 'construction_address'
	) );

	/* Footer Options */
	$wp_customize->add_section('footer_section',array(
	'title'=>__("Footer Options","wp-construction"),
	'panel'=>'wp_construction_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 50,
	));

	$wp_customize->add_setting(
	'construction_footer_customization',
		array(
		'default'=>'Powered by WordPress',
		'type'=>'theme_mod',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'construction_footer_customization', array(
		'selector' => '.copyright.text-center p',
	) );
	$wp_customize->add_control( 'construction_footer_customizationn', array(
		'label'        => __( 'Footer Customization Text', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'construction_footer_customization'
	) );

	$wp_customize->add_setting(
	'construction_develop_by',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'sanitize_callback'=>'wp_construction_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'construction_develop_byy', array(
		'label'        => __( 'Footer developed by Text', 'wp-construction' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'construction_develop_by'
	) );
	$wp_customize->add_setting(
	'construction_deve_link',
		array(
		'default'=>'',
		'type'=>'theme_mod',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_control( 'construction_deve_linkk', array(
		'label'        => __( 'Footer developed by link', 'wp-construction' ),
		'type'=>'url',
		'section'    => 'footer_section',
		'settings'   => 'construction_deve_link'
	) );

	//sanitize callbacks
	function wp_construction_sanitize_text( $input ) {
    	return wp_kses_post( force_balance_tags( $input ) );
	}
 	function wp_construction_sanitize_checkbox( $input ) {
	   if ( $input == 1 ) {
			return 1 ;
		} else {
			return 0;
		}
	}
	function wp_construction_sanitize_integer( $input ) {
		return (int)($input);
	}
function wp_construction_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug
	$input = sanitize_key( $input );
	
	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it;
	// otherwise, return the default
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
}


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'wp_construction_Customizer_Range_Value_Control' ) ) :
class wp_construction_Customizer_Range_Value_Control extends WP_Customize_Control {
	public $type = 'range-value';
	 // Enqueue scripts/styles.
	public function enqueue() {
		wp_enqueue_script( 'customizer-range-value-control', get_stylesheet_directory_uri() . '/js/customizer-range-value-control.js', array( 'jquery' ), rand(), true );
		wp_enqueue_style( 'customizer-range-value-control', get_stylesheet_directory_uri() . '/assets/css/customizer-range-value-control.css', array(), rand() );
	} 
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<div class="range-slider"  style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
				<span  style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); $this->link(); ?>>
				<span class="range-slider__value">0</span></span>
			</div>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}
endif;

/* class for categories */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'wp_construction_category_Control' ) ) :
class wp_construction_category_Control extends WP_Customize_Control 
{   public function render_content(){ ?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php  $wp_news_category = get_categories(); ?>
		<select <?php $this->link(); ?> >
			<option value= "" <?php if($this->value()=='') echo 'selected="selected"';?>><?php echo esc_html('No category','wp-construction'); ?></option>
			<?php foreach($wp_news_category as $category){ ?>
				<option value= "<?php echo esc_attr($category->cat_name); ?>" <?php if($this->value()=='') echo 'selected="selected"';?> ><?php echo esc_html($category->cat_name); ?>				  </option>
			<?php } ?>
		</select> <?php
	}  /* public function ends */
}/*   class ends */
endif;
?>