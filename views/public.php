<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   Sticky_Header
 * @author    ThematoSoup <contact@thematosoup.com>
 * @license   GPL-2.0+
 * @link      http://thematosoup.com
 * @copyright 2013 ThematoSoup
 */

// Get Sticky Header options
$thsp_sticky_header_settings = get_option( 'thsp_sticky_header' );

// Check if there is a logo image
if ( '' != $thsp_sticky_header_settings['logo'] ) :
	$thsp_sticky_header_title = '<img src="' . esc_attr( $thsp_sticky_header_settings['logo'] ) . '" alt="' . esc_attr( get_bloginfo( 'description' ) ) . '" />';
else :
	$thsp_sticky_header_title = get_bloginfo( 'name' );
endif;
?>

<div id="thsp-sticky-header">
	<div id="thsp-sticky-header-inner">
		<div id="thsp-sticky-header-title">
			<a href="<?php echo bloginfo( 'url' ); ?>" title="<?php bloginfo( 'description' ); ?>"><?php echo $thsp_sticky_header_title; ?></a>
		</div>
		
		<?php if ( isset( $thsp_sticky_header_settings['menu' ] ) ) :
			$menu_args = array(
				'menu'			=> $thsp_sticky_header_settings['menu' ],
				'depth'			=> 1,
				'menu_id'		=> 'thsp-sticky-header-menu',
				'container'		=> '',
				'fallback_cb'	=> ''
			);
			wp_nav_menu( $menu_args );
		endif; ?>
	</div><!-- #thsp-sticky-header-inner -->
</div><!-- #thsp-sticky-header -->