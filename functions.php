<?php


function theme_scripts() {

	// Enqueue Styles
	wp_register_style( 'Bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
	wp_enqueue_style( 'Bootstrap' );
	wp_enqueue_style( 'theme_style', get_stylesheet_uri() );

	// Enqueue Scripts
	wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-3.4.1.js', null, null, true);
	wp_enqueue_script( 'jQuery' );
	wp_register_script( 'Bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', null, null, true);
	wp_enqueue_script( 'Bootstrap' );
	wp_register_script( 'FontAwesome', 'https://use.fontawesome.com/releases/v5.10.0/js/all.js', null, null, true);
	wp_enqueue_script( 'FontAwesome' );
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );


function custom_header_setup() {

	/**
	 * Filter custom-header support arguments.
	 *
	 * @since My Theme 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-image          Default image of the header.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
	 *     @type string $flex-height            Flex support for height of header.
	 *     @type string $video                  Video support for header.
	 *     @type string $wp-head-callback       Callback function used to styles the header image and text
	 *                                          displayed on the blog.
	 * }
	 */
	add_theme_support(
		'custom-header',
		apply_filters(
			'custom_header_args',
			array(
				'default-image'    => get_parent_theme_file_uri( '/assets/img/header.jpg' ),
				'width'            => 2000,
				'height'           => 1200,
				'flex-height'      => true,
				'video'            => true,
				'wp-head-callback' => 'mytheme_header_style',
			)
		)
	);

	register_default_headers(
		array(
			'default-image' => array(
				'url'           => '%s/assets/img/header.jpg',
				'thumbnail_url' => '%s/assets/img/header.jpg',
				'description'   => __( 'Default Header Image', 'mytheme' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'custom_header_setup' );

if ( ! function_exists( 'mytheme_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see mytheme_custom_header_setup().
	 */
	function mytheme_header_style() {
		$header_text_color = get_header_textcolor();

		// If no custom options for text are set, let's bail.
		// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style id="mytheme-custom-header-styles" type="text/css">
		<?php
		// Has the text been hidden ?
		if ( 'blank' === $header_text_color ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user ha set a custom color for the text use that
		else :
			?>
			.site-title a,
			.colors-dark .site-title a,
			.colors-custom .site-title a,
			body.has-header-image .site-title a,
			body.has-header-video .site-title a,
			body.has-header-image.colors-dark .site-title a,
			body.has-header-video.colors-dark .site-title a,
			body.has-header-image.colors-custom .site-title a,
			body.has-header-video.colors-custom .site-title a,
			.site-description,
			.colors-dark .site-description,
			.colors-custom .site-description,
			body.has-header-image .site-description,
			body.has-header-video .site-description,
			body.has-header-image.colors-dark .site-description,
			body.has-header-video.colors-dark .site-description,
			body.has-header-image.colors-custom .site-description,
			body.has-header-video.colors-custom .site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>

		<?php
	}
endif;

/*
 * Enable support for custom logo.
 *
 *  @since Twenty Sixteen 1.2
 */
add_theme_support(
	'custom-logo',
	array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	)
);


if ( ! function_exists( 'mytheme_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since Twenty Sixteen 1.2
	 */
	function mytheme_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;




/**
 * Checks to see if we're on the front page or not.
 */
function mytheme_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}
