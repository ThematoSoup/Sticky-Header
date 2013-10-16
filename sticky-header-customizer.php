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
			'title'			=> __( 'Sticky Header', $thsp_plugin_slug ),
			'priority'		=> 1,
			'description'	=> __( 'Lalalala', $thsp_plugin_slug )
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
				'label'		=> __( 'Logo (image height should be 36px)', $thsp_plugin_slug ),
				'section'	=> 'thsp_sticky_header',
				'settings'	=> 'thsp_sticky_header[logo]',
			)
		)
	);

	// Sticky Header menu
	$menus = wp_get_nav_menus();
	if ( $menus ) :
		$choices = array( 0 => __( '&mdash; Select &mdash;' ) );
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
				'label'   => __( 'Menu', $thsp_plugin_slug ),
				'section' => 'thsp_sticky_header',
				'type'    => 'select',
				'choices' => $choices,
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
			) 
		) 
	);

	// Sticky Header text color
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
			) 
		) 
	);
}
