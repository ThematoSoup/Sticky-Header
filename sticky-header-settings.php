<?php
/**
 * Handles Customizer options.
 *
 * @package   Sticky_Header
 * @author    ThematoSoup <contact@thematosoup.com>
 * @license   GPL-2.0+
 * @link      http://thematosoup.com
 * @copyright 2013 ThematoSoup
 */

add_action( 'customize_register', 'thsp_sticky_header_customize_register' );
/**
 * Registers all Customizer options.
 *
 * @since     1.0.0
 */
function thsp_sticky_header_customize_register( $wp_customize ) {
	$thsp_plugin_slug = 'thsp-sticky-header';

	// Define Number custom control
	if ( class_exists( 'WP_Customize_Control') ) :
		class Sticky_Header_Number_Control extends WP_Customize_Control {
			public $type = 'number';
			
			public function render_content() { ?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<input class="small-text" type="number" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
				</label>
			<?php }
		}
	endif;

	$wp_customize->add_section(
		'thsp_sticky_header',
		array(
			'title'			=> __( 'Sticky Header by ThematoSoup', $thsp_plugin_slug ),
			'priority'		=> 1
		) 
	);

	// Upload Sticky Header logo
	$wp_customize->add_setting(
		'thsp_sticky_header[logo]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'esc_url_raw',
			'type'				=> 'option',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'thsp_sticky_header[logo]',
			array(
				'label'		=> __( 'Logo (image height should be 30px)', $thsp_plugin_slug ),
				'section'	=> 'thsp_sticky_header',
				'settings'	=> 'thsp_sticky_header[logo]',
			)
		)
	);

	// Sticky Header menu
	$menus = wp_get_nav_menus();
	if ( $menus ) :
		$choices = array( 0 => __( '&mdash; Select a menu &mdash;' ) );
		foreach ( $menus as $menu ) :
			$choices[ $menu->term_id ] = wp_html_excerpt( $menu->name, 40, '&hellip;' );
		endforeach;

		$wp_customize->add_setting(
			'thsp_sticky_header[menu]',
			array(
				'sanitize_callback' => 'absint',
				'theme_supports'    => 'menus',
				'type'				=> 'option',
				'capability'		=> 'edit_theme_options',
			)
		);
		$wp_customize->add_control(
			'thsp_sticky_header[menu]',
				array(
				'label'   	=> __( 'Menu', $thsp_plugin_slug ),
				'section' 	=> 'thsp_sticky_header',
				'type'    	=> 'select',
				'choices' 	=> $choices,
				'priority'	=> 10
			)
		);
	endif;
	
	// Sticky Header background color
	$wp_customize->add_setting(
		'thsp_sticky_header[background_color]',
		array(
			'default'			=> '#181818',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'type'				=> 'option',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'thsp_sticky_header[background_color]',
			array(
				'label'		=> __( 'Background color', $thsp_plugin_slug ),
				'section'	=> 'thsp_sticky_header',
				'settings'	=> 'thsp_sticky_header[background_color]',
				'priority'	=> 20
			) 
		) 
	);

	// Sticky Header text color
	$wp_customize->add_setting(
		'thsp_sticky_header[text_color]',
		array(
			'default'			=> '#f9f9f9',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'type'				=> 'option',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'thsp_sticky_header[text_color]',
			array(
				'label'		=> __( 'Text color', $thsp_plugin_slug ),
				'section'	=> 'thsp_sticky_header',
				'settings'	=> 'thsp_sticky_header[text_color]',
				'priority'	=> 30
			) 
		) 
	);

	// Sticky Header inner width
	$wp_customize->add_setting(
		'thsp_sticky_header[inner_width]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'type'				=> 'option',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		new Sticky_Header_Number_Control(
			$wp_customize,
			'thsp_sticky_header[inner_width]',
			array(
				'label'		=> __( 'Sticky Header max width (in pixels)', $thsp_plugin_slug ),
				'section'	=> 'thsp_sticky_header',
				'settings'	=> 'thsp_sticky_header[inner_width]',
				'priority'	=> 40
			) 
		) 
	);

	// Sticky Header show at
	$wp_customize->add_setting(
		'thsp_sticky_header[show_at]',
		array(
			'default'			=> '200',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'type'				=> 'option',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		new Sticky_Header_Number_Control(
			$wp_customize,
			'thsp_sticky_header[show_at]',
			array(
				'label'		=> __( 'Make visible when scrolled to (in pixels)', $thsp_plugin_slug ),
				'section'	=> 'thsp_sticky_header',
				'settings'	=> 'thsp_sticky_header[show_at]',
				'priority'	=> 50
			) 
		) 
	);

	// Sticky Header hide if narrower than
	$wp_customize->add_setting(
		'thsp_sticky_header[hide_if_narrower]',
		array(
			'default'			=> '600',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'type'				=> 'option',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		new Sticky_Header_Number_Control(
			$wp_customize,
			'thsp_sticky_header[hide_if_narrower]',
			array(
				'label'		=> __( 'Hide if screen is narrower than (in pixels)', $thsp_plugin_slug ),
				'section'	=> 'thsp_sticky_header',
				'settings'	=> 'thsp_sticky_header[hide_if_narrower]',
				'priority'	=> 60
			) 
		) 
	);
}

/**
 * Returns plugin settings.
 *
 * @since     1.0.0
 *
 * @return    array    Merged array of plugin settings and plugin defaults.
 */
function thsp_sticky_header_get_settings() {
	$plugin_defaults = array(
		'background_color'		=> '#181818',
		'text_color'			=> '#f9f9f9',
		'show_at'				=> '200',
		'hide_if_narrower'		=> '600'
	);
	$plugin_settings = get_option( 'thsp_sticky_header' );

	return wp_parse_args( $plugin_settings, $plugin_defaults );
}