<?php

/** Template Name: Calendário */
get_header();
$layout = onepress_get_layout();
wp_enqueue_script('full-calendar', get_stylesheet_directory_uri() . '/assets/fullcalendar/lib/main.js');
wp_enqueue_style('calendario-style', get_stylesheet_directory_uri() . '/assets/fullcalendar/lib/main.css');
wp_enqueue_script('calendario-script', get_stylesheet_directory_uri() . '/assets/calendario.js');
?>

<div id="content" class="site-content">
    <?php onepress_breadcrumb(); ?>
    <div id="content-inside" class="container <?php echo esc_attr($layout); ?>">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div id="calendar"></div>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php if ($layout != 'no-sidebar') { ?>
            <?php get_sidebar(); ?>
        <?php } ?>
    </div>
    <!--#content-inside -->
</div><!-- #content -->
<?php get_footer(); ?>