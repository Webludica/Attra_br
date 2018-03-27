<?php
if ( ! function_exists( 'thememove_register_theme_plugins' ) ) :
	function thememove_register_theme_plugins() {

		$plugins = array(
			array(
				'name'     => 'ThemeMove Core',
				'slug'     => 'thememove-core',
				'source'   => 'https://drive.google.com/uc?export=download&id=0By5Ytx4iv5jwaEtZMDJuQndWN0k',
				'version'  => '1.3.5.1',
				'required' => true
			),
			array(
				'name'     => 'Visual Composer',
				'slug'     => 'js_composer',
				'source'   => 'https://drive.google.com/uc?export=download&id=0By5Ytx4iv5jwS1hfZE5XS3RLNk0',
				'version'  => '5.4',
				'required' => false
			),
			array(
				'name'     => 'Essential Grid',
				'slug'     => 'essential-grid',
				'source'   => 'https://drive.google.com/uc?export=download&id=0By5Ytx4iv5jwejdKdDBoak0wSlU',
				'version'  => '2.1.6',
				'required' => false
			),
			array(
				'name'     => 'Revolution Slider',
				'slug'     => 'revslider',
				'source'   => 'https://drive.google.com/uc?export=download&id=0By5Ytx4iv5jwbEl3bEtXcktKZk0',
				'version'  => '5.4.6.2',
				'required' => false
			),
			array(
				'name'     => 'WP Job Manager',
				'slug'     => 'wp-job-manager',
				'required' => false
			),
			array(
				'name'     => 'Testimonials by WooThemes',
				'slug'     => 'testimonials-by-woothemes',
				'required' => false
			),
			array(
				'name'     => 'Projects by WooThemes',
				'slug'     => 'projects-by-woothemes',
				'required' => true
			),
			array(
				'name'     => 'WooCommerce',
				'slug'     => 'woocommerce',
				'required' => false
			),
			array(
				'name'     => 'Widget Logic',
				'slug'     => 'widget-logic',
				'required' => false
			),
			array(
				'name'     => 'MailChimp for WordPress',
				'slug'     => 'mailchimp-for-wp',
				'required' => false
			),
			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => false
			)
		);

		$config = array(
			'id'           => 'tgmpa',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => true,
			'message'      => '',
		);

		tgmpa( $plugins, $config );

	}

	add_action( 'tgmpa_register', 'thememove_register_theme_plugins' );
endif;
