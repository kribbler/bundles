<?php
/**
 * Title: Options customizer
 *
 * Description: Defines option fields for theme customizer.
 *
 */

// create the admin menu for the theme options page
function responsive_admin_add_customizer_page() {

	// add the Customize link to the admin menu
	add_theme_page( __( 'Customize', 'responsive' ), __( 'Customize', 'responsive' ), 'edit_theme_options', 'customize.php' );

}

// check if version is less than 3.6
if( get_bloginfo( 'version' ) < 3.6 ) {
	add_action( 'admin_menu', 'responsive_admin_add_customizer_page' );
}

// Adding theme options to the customizer.
function responsive_customize_register( $wp_customize ) {

	/**
	 * Class Responsive_Pro_Form
	 *
	 * Creates a form input type with the option to add description and placeholders
	 *
	 */
	class Responsive_Pro_Form extends WP_Customize_Control {

		public $description = '';
		public $placeholder = '';

		public function render_content() {
			switch( $this->type ) {
				case 'text':
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<input type="text" <?php if( $this->placeholder != '' ): ?> placeholder="<?php echo esc_attr( $this->placeholder ); ?>"<?php endif; ?>
							   value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
						<?php if( $this->description != '' ) : ?>
							<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
						<?php endif; ?>
					</label>
					<?php
					break;
				case 'textarea':
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<textarea <?php if( $this->placeholder != '' ): ?> placeholder="<?php echo esc_attr( $this->placeholder ); ?>"<?php endif; ?>
							value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> style="width: 97%; height: 200px;"></textarea>
						<?php if( $this->description != '' ) : ?>
							<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
						<?php endif; ?>
					</label>
					<?php
					break;
			}
		}
	}

	/**
	 * Class Cyberchimps_skin_selector
	 *
	 * Creates and image selector
	 *
	 */
	class Responsive_Pro_Skin_Selector extends WP_Customize_Control {

		public function render_content() {
			?>
			<style>
				.images-skin-subcontainer {
					display: inline;
				}

				.images-skin-subcontainer img {
					margin-top: 5px;
					padding: 2px;
					border: 5px solid #eee;
					height: 44px;
				}

				.images-skin-subcontainer img.of-radio-img-selected {
					border: 5px solid #5DA7F2;
				}

				.images-skin-subcontainer img:hover {
					cursor: pointer;
					border: 5px solid #5DA7F2;
				}
			</style>
			<script>
				jQuery(function ($) {
					$('.of-radio-img-img').click(function () {
						$(this).parent().parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
						$(this).addClass('of-radio-img-selected');
					});
				});

				/**
				 * Typography script piggy backing in the Skin selector class
				 */
//          TODO Rewrite the script into it's own class extension of the select opitions
				jQuery(document).ready(function ($) {

					// Script to hide show the Google Heading Font input depending on value of the Heading select
					var font = $('#customize-control-font_heading select').val();
					if (font != 'google') {
						$('#customize-control-google_font_heading').hide();
					}
					else {
						$('#customize-control-google_font_heading').show();
					}
					$('#customize-control-font_heading select').change(function () {
						var font_change = $(this).val();
						if (font_change != 'google') {
							$('#customize-control-google_font_heading').hide();
						}
						else {
							$('#customize-control-google_font_heading').show();
						}
					});

					// Script to show hide the Google Text Font input depending on the value of the Text select
					var text = $('#customize-control-font_text select').val();
					if (text != 'google') {
						$('#customize-control-google_font_text').hide();
					}
					else {
						$('#customize-control-google_font_text').show();
					}
					$('#customize-control-font_text select').change(function () {
						var text_change = $(this).val();
						if (text_change != 'google') {
							$('#customize-control-google_font_text').hide();
						}
						else {
							$('#customize-control-google_font_text').show();
						}
					});
				});

				/*  Hide/show WP frontpage option when custom front page toggle is on/off */
				jQuery(document).ready(function ($) {

					var custom_page = $('#customize-control-home_headline, #customize-control-home_subheadline, #customize-control-home_content_area, #customize-control-cta_url, #customize-control-cta_text, #customize-control-featured_content');
					// On load: Hide the below option is toggle is on.
					if ($('#customize-control-front_page input').val() == 1) {
						$('#customize-control-show_on_front').hide();
					}
					else {
						custom_page.hide();
					}

					// Hide and show on change.
					$('#customize-control-front_page input').click(function () {
						if ($('#customize-control-show_on_front').css('display') == 'none') {
							$('#customize-control-show_on_front').show();
							custom_page.hide();
						}
						else {
							$('#customize-control-show_on_front').hide();
							custom_page.show();
						}
					});
				});
			</script>

			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php
			foreach( $this->choices as $value => $label ) :

				$test_skin = $this->value();
				$name      = '_customize-radio-' . $this->id;
				$selected  = ( $test_skin == $value ) ? 'of-radio-img-selected' : '';
				$file      = get_template_directory_uri() . '/pro/lib/css/skins/images/' . $value . '.png';
				?>
				<div class="images-skin-subcontainer">
					<label>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link();
						checked( $test_skin, $value ); ?> style="display:none;"/>
						<img src="<?php echo esc_html( $file ); ?>" class="of-radio-img-img <?php echo esc_attr( $selected ); ?>"/>
					</label>
				</div>
			<?php
			endforeach;
		}
	}

	/**
	 * LOGO UPLOAD
	 */
	$wp_customize->add_section( 'responsive_logo_section', array(
		'title'    => __( 'Logo Upload', 'responsive' ),
		'type'     => 'theme_mod',
		'priority' => 34
	) );

	$wp_customize->add_setting( 'header_image' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array(
		'label'    => __( 'Logo Upload', 'responsive' ),
		'section'  => 'responsive_logo_section',
		'settings' => 'header_image'
	) ) );

	/**
	 * DEFAULT LAYOUTS
	 */
	$wp_customize->add_section( 'responsive_default_layouts', array(
		'title'    => __( 'Default Layouts', 'responsive' ),
		'priority' => 37
	) );

	// Default Static Page Layout
	$wp_customize->add_setting( 'responsive_theme_options[static_page_layout_default]', array(
		'default'           => 'content-sidebar-page',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_default_layout_validate'
	) );

	$wp_customize->add_control( 'static_page_layout_default', array(
		'label'    => __( 'Default Static Page Layout', 'responsive' ),
		'section'  => 'responsive_default_layouts',
		'settings' => 'responsive_theme_options[static_page_layout_default]',
		'type'     => 'select',
		'choices'  => array(
			'content-sidebar-page'      => __( 'Content/Sidebar', 'responsive' ),
			'sidebar-content-page'      => __( 'Sidebar/Content', 'responsive' ),
			'content-sidebar-half-page' => __( 'Content/Sidebar Half Page', 'responsive' ),
			'sidebar-content-half-page' => __( 'Sidebar/Content Half Page', 'responsive' ),
			'full-width-page'           => __( 'Full Width Page (no sidebar)', 'responsive' )
		)
	) );

	// Default Single Blog Post Layout
	$wp_customize->add_setting( 'responsive_theme_options[single_post_layout_default]', array(
		'default'           => 'content-sidebar-page',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_default_layout_validate'
	) );

	$wp_customize->add_control( 'single_post_layout_default', array(
		'label'    => __( 'Default Single Blog Post Layout', 'responsive' ),
		'section'  => 'responsive_default_layouts',
		'settings' => 'responsive_theme_options[single_post_layout_default]',
		'type'     => 'select',
		'choices'  => array(
			'content-sidebar-page'      => __( 'Content/Sidebar', 'responsive' ),
			'sidebar-content-page'      => __( 'Sidebar/Content', 'responsive' ),
			'content-sidebar-half-page' => __( 'Content/Sidebar Half Page', 'responsive' ),
			'sidebar-content-half-page' => __( 'Sidebar/Content Half Page', 'responsive' ),
			'full-width-page'           => __( 'Full Width Page (no sidebar)', 'responsive' )
		)
	) );

	// Default Blog Posts Index Layout
	$wp_customize->add_setting( 'responsive_theme_options[blog_posts_index_layout_default]', array(
		'default'           => 'content-sidebar-page',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_default_layout_validate'
	) );

	$wp_customize->add_control( 'blog_posts_index_layout_default', array(
		'label'    => __( 'Default Blog Posts Index Layout', 'responsive' ),
		'section'  => 'responsive_default_layouts',
		'settings' => 'responsive_theme_options[blog_posts_index_layout_default]',
		'type'     => 'select',
		'choices'  => array(
			'content-sidebar-page'      => __( 'Content/Sidebar', 'responsive' ),
			'sidebar-content-page'      => __( 'Sidebar/Content', 'responsive' ),
			'content-sidebar-half-page' => __( 'Content/Sidebar Half Page', 'responsive' ),
			'sidebar-content-half-page' => __( 'Sidebar/Content Half Page', 'responsive' ),
			'full-width-page'           => __( 'Full Width Page (no sidebar)', 'responsive' )
		)
	) );

	/**
	 * SKINS
	 */
	$wp_customize->add_section( 'responsive_skin', array(
		'title'    => __( 'Skins', 'responsive' ),
		'priority' => 38
	) );
	$wp_customize->add_setting( 'responsive_skin', array(
		'default'           => 'default',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'responsive_pro_skin_validate'
	) );
	$wp_customize->add_control( new Responsive_Pro_Skin_Selector( $wp_customize, 'skin', array(
		'label'    => __( 'Skin Color', 'responsive' ),
		'section'  => 'responsive_skin',
		'settings' => 'responsive_skin',
		'type'     => 'radio',
		'choices'  => array(
			'default'  => 'Default',
			'blue'     => 'Blue',
			'darkblue' => 'Dark Blue',
			'black'    => 'Black',
			'green'    => 'Green',
			'orange'   => 'Orange',
			'pink'     => 'Pink',
			'red'      => 'Red',
			'purple'   => 'Purple',
			'yellow'   => 'Yellow',
			'rust'     => 'Rust',
			'teal'     => 'Teal'
		)
	) ) );

	/**
	 * TYPOGRAPHY
	 */
	$wp_customize->add_section( 'responsive_typography', array(
		'title'    => __( 'Typography', 'responsive' ),
		'priority' => 39
	) );

	// Heading font selection
	$wp_customize->add_setting( 'responsive_font_heading', array(
		'default' => 'Arial, Helvetica, sans-serif',
		'type'    => 'theme_mod',
		//'sanitize_callback' => 'responsive_pro_text_sanitize'
	) );

	// Heading font selection
	$wp_customize->add_control( 'font_heading', array(
		'label'    => __( 'Heading Font', 'responsive' ),
		'section'  => 'responsive_typography',
		'settings' => 'responsive_font_heading',
		'type'     => 'select',
		'choices'  => responsive_pro_fonts(),
		'priority' => 1
	) );

	// Google heading font
	$wp_customize->add_setting( 'responsive_google_font_heading', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'responsive_pro_text_sanitize'
	) );

	// Google heading font
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'google_font_heading', array(
		'label'       => __( 'Google Heading Font', 'responsive' ),
		'section'     => 'responsive_typography',
		'settings'    => 'responsive_google_font_heading',
		'type'        => 'text',
		'description' => __( 'Enter the Google Font name', 'responsive' ),
		'priority'    => 2
	) ) );

	// Text font selection
	$wp_customize->add_setting( 'responsive_font_text', array(
		'default'           => 'Arial, Helvetica, sans-serif',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'responsive_pro_text_sanitize'
	) );

	// Text font selection
	$wp_customize->add_control( 'font_text', array(
		'label'    => __( 'Text Font', 'responsive' ),
		'section'  => 'responsive_typography',
		'settings' => 'responsive_font_text',
		'type'     => 'select',
		'choices'  => responsive_pro_fonts(),
		'priority' => 3
	) );

	// Google text font
	$wp_customize->add_setting( 'responsive_google_font_text', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'responsive_pro_text_sanitize'
	) );

	// Google text font
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'google_font_text', array(
		'label'       => __( 'Google Text Font', 'responsive' ),
		'section'     => 'responsive_typography',
		'settings'    => 'responsive_google_font_text',
		'type'        => 'text',
		'description' => __( 'Enter the Google Font name', 'responsive' ),
		'priority'    => 4
	) ) );

	// Font size
	$wp_customize->add_setting( 'responsive_font_size', array(
		'default'           => '14',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'responsive_pro_text_sanitize'
	) );

	// Google Font
	$wp_customize->add_control( 'font_size', array(
		'label'    => __( 'Font Size', 'responsive' ),
		'section'  => 'responsive_typography',
		'settings' => 'responsive_font_size',
		'type'     => 'select',
		'choices'  => array(
			'8'  => '8px',
			'10' => '10px',
			'11' => '11px',
			'12' => '12px',
			'13' => '13px',
			'14' => '14px',
			'15' => '15px',
			'16' => '16px',
			'17' => '17px',
			'18' => '18px',
			'19' => '19px',
			'20' => '20px',
			'21' => '21px',
			'22' => '22px',
			'23' => '23px',
			'24' => '24px'
		),
		'priority' => 5
	) );

	/**
	 * COLORS
	 */
	// Headings color
	$wp_customize->add_setting( 'responsive_heading_colorpicker', array(
		'default' => '',
		'type'    => 'theme_mod'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_colorpicker', array(
		'label'    => __( 'Headings Color', 'responsive' ),
		'section'  => 'colors',
		'settings' => 'responsive_heading_colorpicker'
	) ) );

	// Text color
	$wp_customize->add_setting( 'responsive_text_colorpicker', array(
		'default' => '',
		'type'    => 'theme_mod'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_colorpicker', array(
		'label'    => __( 'Text Color', 'responsive' ),
		'section'  => 'colors',
		'settings' => 'responsive_text_colorpicker'
	) ) );

	// link color
	$wp_customize->add_setting( 'responsive_link_colorpicker', array(
		'default' => '',
		'type'    => 'theme_mod'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_colorpicker', array(
		'label'    => __( 'Link Color', 'responsive' ),
		'section'  => 'colors',
		'settings' => 'responsive_link_colorpicker'
	) ) );

	// link hover color
	$wp_customize->add_setting( 'responsive_link_hover_colorpicker', array(
		'default' => '',
		'type'    => 'theme_mod'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_colorpicker', array(
		'label'    => __( 'Link Hover Color', 'responsive' ),
		'section'  => 'colors',
		'settings' => 'responsive_link_hover_colorpicker'
	) ) );

	/**
	 * CUSTOM FRONT PAGE
	 */
	$wp_customize->add_setting( 'responsive_theme_options[front_page]', array(
		'default'           => 'true',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_checkbox_validate'
	) );

	$wp_customize->add_control( 'front_page', array(
		'label'    => __( 'Enable custom front page', 'responsive' ),
		'section'  => 'static_front_page',
		'settings' => 'responsive_theme_options[front_page]',
		'type'     => 'checkbox',
		'priority' => 10
	) );

	// Headline
	$wp_customize->add_setting( 'responsive_theme_options[home_headline]', array(
		'default'           => '',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_html_sanitize'
	) );

	// Headline
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'home_headline', array(
		'label'       => __( 'Headline', 'responsive' ),
		'section'     => 'static_front_page',
		'settings'    => 'responsive_theme_options[home_headline]',
		'type'        => 'text',
		'placeholder' => __( 'Hello, World!', 'responsive' ),
		'priority'    => 11
	) ) );

	// Sub headline
	$wp_customize->add_setting( 'responsive_theme_options[home_subheadline]', array(
		'default'           => '',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_html_sanitize'
	) );

	// Sub headline
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'home_subheadline', array(
		'label'       => __( 'Subheadline', 'responsive' ),
		'section'     => 'static_front_page',
		'settings'    => 'responsive_theme_options[home_subheadline]',
		'type'        => 'text',
		'placeholder' => __( 'Your H2 subheadline here', 'responsive' ),
		'priority'    => 12
	) ) );

	// Content area
	$wp_customize->add_setting( 'responsive_theme_options[home_content_area]', array(
		'default'           => '',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_html_sanitize'
	) );

	// Content area
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'home_content_area', array(
		'label'       => __( 'Content', 'responsive' ),
		'section'     => 'static_front_page',
		'settings'    => 'responsive_theme_options[home_content_area]',
		'type'        => 'textarea',
		'placeholder' => __( 'Your title, subtitle and this very content is editable from Theme Option. Call to Action button and its destination link as well. Image on your right can be an image or even YouTube video if you like.', 'responsive' ),
		'priority'    => 13
	) ) );

	// Call to action URL
	$wp_customize->add_setting( 'responsive_theme_options[cta_url]', array(
		'default'           => '',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_url_sanitize'
	) );

	// Call to action URL
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'cta_url', array(
		'label'       => __( 'Call to Action (URL)', 'responsive' ),
		'section'     => 'static_front_page',
		'settings'    => 'responsive_theme_options[cta_url]',
		'type'        => 'text',
		'placeholder' => __( 'Enter your call to action URL', 'responsive' ),
		'priority'    => 14
	) ) );

	// Call to action text
	$wp_customize->add_setting( 'responsive_theme_options[cta_text]', array(
		'default'           => '',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_text_sanitize'
	) );

	// Call to action text
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'cta_text', array(
		'label'       => __( 'Call to Action (Text)', 'responsive' ),
		'section'     => 'static_front_page',
		'settings'    => 'responsive_theme_options[cta_text]',
		'type'        => 'text',
		'placeholder' => __( 'Enter your call to action text', 'responsive' ),
		'priority'    => 15
	) ) );

	// Featured content
	$wp_customize->add_setting( 'responsive_theme_options[featured_content]', array(
		'default'           => '',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_code_sanitize'
	) );

	// Content area
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'featured_content', array(
		'label'       => __( 'Featured Content', 'responsive' ),
		'section'     => 'static_front_page',
		'settings'    => 'responsive_theme_options[featured_content]',
		'type'        => 'textarea',
		'description' => __( 'Paste your shortcode, video or image source', 'responsive' ),
		'placeholder' => '<img class="aligncenter" src="<?php get_template_directory_uri(); ?>/core/images/featured-image.png" width="440" height="300" alt="" />',
		'priority'    => 16
	) ) );

	/**
	 * CUSTOM CSS
	 */
	$wp_customize->add_section( 'responsive_custom_css', array(
		'title'    => __( 'Custom Css', 'responsive' ),
		'priority' => 37
	) );
	$wp_customize->add_setting( 'responsive_theme_options[responsive_inline_css]', array(
		'default'           => '',
		'type'              => 'option',
		'sanitize_callback' => 'responsive_pro_code_sanitize'
	) );

	// Content area
	$wp_customize->add_control( new Responsive_Pro_Form( $wp_customize, 'responsive_inline_css', array(
		'label'    => __( 'Custom Css', 'responsive' ),
		'section'  => 'responsive_custom_css',
		'settings' => 'responsive_theme_options[responsive_inline_css]',
		'type'     => 'textarea'
	) ) );
}

add_action( 'customize_register', 'responsive_customize_register' );

/**
 * Create an array of font options
 *
 * @return array
 */
function responsive_pro_fonts() {
	// Create an array of fonts
	$fonts = array(
		'google'                                           => 'Google Font',
		'Arial, Helvetica, sans-serif'                     => 'Arial',
		'Arial Black, Gadget, sans-serif'                  => 'Arial Black',
		'Comic Sans MS, cursive'                           => 'Comic Sans MS',
		'Courier New, monospace'                           => 'Courier New',
		'Georgia, serif'                                   => 'Georgia',
		'Impact, Charcoal, sans-serif'                     => 'Impact',
		'Lucida Console, Monaco, monospace'                => 'Lucida Console',
		'Lucida Sans Unicode, Lucida Grande, sans-serif'   => 'Lucida Sans Unicode',
		'"Open Sans", sans-serif'                          => 'Open Sans',
		'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype',
		'Tahoma, Geneva, sans-serif'                       => 'Tahoma',
		'Times New Roman, Times, serif'                    => 'Times New Roman',
		'Trebuchet MS, sans-serif'                         => 'Trebuchet MS',
		'Verdana, Geneva, sans-serif'                      => 'Verdana',
		'MS Sans Serif, Geneva, sans-serif'                => 'MS Sans Serif',
		'MS Serif, New York, serif'                        => 'MS Serif'
	);

	return $fonts;
}

/************************************************************************************************************/
/********************************************* VALIDATION ***************************************************/
/************************************************************************************************************/

/**
 * Validates the Default Layout
 *
 * @param $input select
 *
 * @return string
 */
function responsive_pro_default_layout_validate( $input ) {
	// An array of valid results
	$valid = responsive_get_valid_layouts();

	if( array_key_exists( $input, $valid ) ) {
		return $input;
	}
	else {
		return '';
	}
}

/**
 * Validates the Skins
 *
 * @param $input select
 *
 * @return string
 */
function responsive_pro_skin_validate( $input ) {
	// An array of valid results
	$valid = array(
		'default'  => 'Default',
		'blue'     => 'Blue',
		'darkblue' => 'Dark Blue',
		'black'    => 'Black',
		'green'    => 'Green',
		'orange'   => 'Orange',
		'pink'     => 'Pink',
		'red'      => 'Red',
		'purple'   => 'Purple',
		'yellow'   => 'Yellow',
		'rust'     => 'Rust',
		'teal'     => 'Teal'
	);

	if( array_key_exists( $input, $valid ) ) {
		return $input;
	}
	else {
		return '';
	}
}

/**
 * Sanitizes the url input
 *
 * @param $input url
 *
 * @return string
 */
function responsive_pro_url_sanitize( $input ) {

	$input = esc_url( $input );

	return $input;
}

/**
 * Strips tags and html from input
 *
 * @param $input text
 *
 * @return string
 */
function responsive_pro_text_sanitize( $input ) {

	// Remove tags etc
	$input = sanitize_text_field( $input );

	return $input;
}

/**
 * Sanitizes to allow basic html through, same as WP posts
 *
 * @param $input html
 *
 * @return string
 */
function responsive_pro_html_sanitize( $input ) {

	// Strips disallowed tags and balances them in case any have been left off
	$input = wp_kses_post( force_balance_tags( $input ) );

	return $input;
}

/**
 * Sanitizes iframe code etc by stripping slashes
 *
 * @param $input code e.g. iframe
 *
 * @return string
 */
function responsive_pro_code_sanitize( $input ) {

	$input = wp_kses_stripslashes( $input );

	return $input;
}

/**
 * Validates checkbox inputs.
 *
 * @param $input checkbox
 *
 * @return 1 or 0
 */
function responsive_pro_checkbox_validate( $input ) {

	$input = ( $input == 1 ? 1 : 0 );

	return $input;
}