<?php
include( 'class-tm-walker-nav-menu.php' );

class ThemeMove_Mega_Menu {

	public function __construct() {
		// Hook into the 'init' action
		add_action( 'init', array( $this, 'thememove_register_mega_menu' ), 0 );

		// Remove view & preview in post row actions
		add_filter( 'post_row_actions', array( $this, 'thememove_remove_view_link' ), 10, 2 );

		add_action( 'wp_head', array( $this, 'thememove_generate_vc_custom_css' ), 1000 );
	}

	// Register Custom Post Type
	function thememove_register_mega_menu() {

		$labels = array(
			'name'               => _x( 'Mega Menus', 'Post Type General Name', 'tm-core' ),
			'singular_name'      => _x( 'Mega Menu', 'Post Type Singular Name', 'tm-core' ),
			'menu_name'          => __( 'Mega Menu', 'tm-core' ),
			'name_admin_bar'     => __( 'Mega Menu', 'tm-core' ),
			'parent_item_colon'  => __( 'Parent Menu:', 'tm-core' ),
			'all_items'          => __( 'All Menus', 'tm-core' ),
			'add_new_item'       => __( 'Add New Menu', 'tm-core' ),
			'add_new'            => __( 'Add New', 'tm-core' ),
			'new_item'           => __( 'New Menu', 'tm-core' ),
			'edit_item'          => __( 'Edit Menu', 'tm-core' ),
			'update_item'        => __( 'Update Menu', 'tm-core' ),
			'view_item'          => __( 'View Menu', 'tm-core' ),
			'search_items'       => __( 'Search Menu', 'tm-core' ),
			'not_found'          => __( 'Not found', 'tm-core' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'tm-core' ),
		);
		$args   = array(
			'label'               => __( 'tm_mega_menu', 'tm-core' ),
			'description'         => __( 'ThemeMove Mega Menu', 'tm-core' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-list-view',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'page',
		);
		register_post_type( 'tm_mega_menu', $args );

	}

	function thememove_remove_view_link( $actions ) {
		unset( $actions['inline hide-if-no-js'] );
		unset ( $actions['view'] );

		return $actions;
	}

	// Generate VC Custom CSS
	function thememove_generate_vc_custom_css() {

		$locations = get_nav_menu_locations();

		foreach ( $locations as $location ) {
			$menu      = wp_get_nav_menu_object( $location );
			$nav_items = wp_get_nav_menu_items( $menu->term_id );

			$mega_menu_ids = array();

			foreach ( (array) $nav_items as $nav_item ) {
				if ( 'tm_mega_menu' == $nav_item->object ) {
					$mega_menu_ids[] = $nav_item->object_id;
				}
			}

			if ( ! empty( $mega_menu_ids ) ) {
				$post_custom_css_array       = array();
				$shortcodes_custom_css_array = array();

				foreach ( $mega_menu_ids as $mega_menu_id ) {
					$post_custom_css = get_post_meta( $mega_menu_id, '_wpb_post_custom_css', true );
					if ( ! empty( $post_custom_css ) ) {
						$post_custom_css_array[] = $post_custom_css;
					}

					$shortcodes_custom_css = get_post_meta( $mega_menu_id, '_wpb_shortcodes_custom_css', true );
					if ( ! empty( $shortcodes_custom_css ) ) {
						$shortcodes_custom_css_array[] = $shortcodes_custom_css;
					}
				}

				if ( ! empty( $post_custom_css_array ) ) {
					echo '<style type="text/css" data-type="vc_custom-css">';
					echo implode( '', $shortcodes_custom_css_array );
					echo '</style>';
				}

				if ( ! empty( $shortcodes_custom_css_array ) ) {
					echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
					echo implode( '', $shortcodes_custom_css_array );
					echo '</style>';
				}
			}
		}
	}
}

new ThemeMove_Mega_Menu();