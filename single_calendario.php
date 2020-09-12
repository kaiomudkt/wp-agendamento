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
                <form action="" class="mb-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="data"><b>Data</b></label>
                            <input id="date" class="form-control datepicker" type="text" value="<?= date('d/m/Y') ?>" readonly title="O formato é puxado das configurações do WordPress.">
                        </div>
                        <div class="col-lg-3">
                            <label for="data"><b>Especialista</b></label>
                            <select class="form-control" name="especialista" id="especialista">
                                <?php
                                $especialistas = list_especialistas();
                                foreach ($especialistas as $especialista) {
                                    echo '<option value="' . $especialista->ID . '">' . $especialista->display_name . ' ID: ' . $especialista->ID . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 mt-4 pt-2">
                            <button id="send-form" class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                            <button class="btn btn-outline-primary" type="reset">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    </div>
                </form>
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