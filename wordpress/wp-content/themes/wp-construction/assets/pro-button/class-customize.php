<?php
/**
 * Singleton class for handling the theme's customizer integration.
 */
final class wp_construction_Updgrade_Pro_Button {

	/**
	 * Returns the instance.
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
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'assets/pro-button/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'wp_construction_Updgrade_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new wp_construction_Updgrade_Section_Pro(
				$manager,
				'construction_buy_pro',
				array(
					'priority' => 0,
					'title'    => esc_html__( 'Upgrade to PRO Theme', 'wp-construction' ),
					'pro_text' => esc_html__( 'Go Pro',         'wp-construction' ),
					'pro_url'  => 'https://weblizar.com/themes/construction-premium-wordpress-theme/',
				)
			)
		);
	}

	public function enqueue_control_scripts() {

		wp_enqueue_script( 'enigma-customize-controls-pro-button', trailingslashit( get_template_directory_uri() ) . 'assets/pro-button/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'enigma-customize-controls-pro-button', trailingslashit( get_template_directory_uri() ) . 'assets/pro-button/customize-controls.css' );
	}
}

// Doing this customizer thang!
wp_construction_Updgrade_Pro_Button::get_instance();
