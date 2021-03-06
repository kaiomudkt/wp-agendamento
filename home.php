<?php
/**
 * The front page template file.
 *
 * The front-page.php template file is used to render your site’s front page,
 * whether the front page displays the blog posts index (mentioned above) or a static page.
 * The front page template takes precedence over the blog posts index (home.php) template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package OnePress
 */

get_header();

$layout = onepress_get_layout();

    
    ?>
	<div id="content" class="site-content">
        <?php onepress_breadcrumb(); ?>
        <div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php echo '<h1><a href="'.wp_login_url().'">Logue</a></h1>'; ?>
				</main><!-- #main -->
			</div><!-- #primary -->
            <?php if ( $layout != 'no-sidebar' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
		</div><!--#content-inside -->
	</div><!-- #content -->

<?php get_footer(); ?>
