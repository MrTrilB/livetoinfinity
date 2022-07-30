<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buddyxpro
 */

namespace BuddyxPro\BuddyxPro;

get_template_part( 'amp/header');

buddyxpro()->print_styles( 'buddyxpro-content' );
buddyxpro()->print_styles( 'buddyxpro-sidebar', 'buddyxpro-widgets' );

$default_sidebar = get_theme_mod( 'sidebar_option', buddyx_defaults( 'sidebar-option' ) );

$post_layout = get_theme_mod( 'blog_layout_option', buddyx_defaults( 'blog-layout-option' ) );
$post_per_row = 'col-md-' . get_theme_mod( 'post_per_row', buddyx_defaults( 'post-per-row' ) );

?>

	<div class="site-sub-header">
		<div class="amp-container">
		<?php
		if ( get_post_type() === 'post' || is_single() || is_archive( 'post-type-archive-forum' ) && ( function_exists( 'is_shop' ) && ! is_shop() ) ) {
			get_template_part('template-parts/content/page_header');
			$breadcrumbs = get_theme_mod('site_breadcrumbs', buddyx_defaults('site-breadcrumbs'));
			if (!empty($breadcrumbs)) {
				buddyx_the_breadcrumb();
			}
		}?>
		</div>
	</div>
	
	<div class="amp-container">
    <div class="amp-site-wrapper">
	
	<main id="primary" class="site-main">
		
		<?php
		if ( have_posts() ) {

			$classes = get_body_class();
			if(in_array('blog',$classes) || in_array('archive',$classes) || in_array('search',$classes)){ ?>
			<div class="post-layout row <?php echo esc_attr($post_layout); ?>">
			<div class="grid-sizer <?php echo esc_attr( $post_per_row ); ?>"></div>
			<?php 
				while ( have_posts() ) {
					the_post();
	
					get_template_part( 'template-parts/content/entry', 'layout' );
				} ?>
				</div>
			<?php 
			} else {
				while ( have_posts() ) {
					the_post();
	
					get_template_part( 'template-parts/content/entry', get_post_type() );
				}
			}

			if ( ! is_singular() ) {
				get_template_part( 'template-parts/content/pagination' );
			}
		} else {
			get_template_part( 'template-parts/content/error' );
		}
		?>

	</main><!-- #primary -->

	</div>
	</div>
<?php
get_template_part( 'amp/footer');