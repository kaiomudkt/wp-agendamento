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

					<div>logue em sua conta</div>

					customizar tela de login
				
function custom_login_css() {
echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/style.css"/>';
}
add_action('login_head', 'custom_login_css');

		<br>
		<br>
		<div>
			<?php 
	global $current_user;
	echo 'global $current_user:';
	var_dump($current_user->roles[0] );
	?>
	<br><br><br><br>
			<?php  
	$user = wp_get_current_user();
	$roles = ( array ) $user->roles;
	echo '$user = wp_get_current_user();
	$roles = ( array ) $user->roles;'; 
	var_dump('role:' , $roles);

	?>
	<br><br><br><br><br><br><br>
	<?php  
	$admin_role_set = get_role( 'administrator' )->capabilities;
	var_dump($admin_role_set);
	?>
	<br><br><br><br><br><br>
	<?php  
	$admin_role_set = get_role( 'paciente' )->capabilities;
	var_dump($admin_role_set);
	?>
	<br><br><br><br><br><br><br>
	<br>
	<?php  
	$admin_role_set = get_role( 'especialista' )->capabilities;
	var_dump($admin_role_set);
	?>
	<br><br><br><br><br><br><br>
	<br>
	<?php  
	$admin_role_set = get_role( 'recepcionista' )->capabilities;
	var_dump($admin_role_set);
	?>
	<br><br><br><br><br><br><br>


		</div>
				</main><!-- #main -->
			</div><!-- #primary -->

            <?php if ( $layout != 'no-sidebar' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>

		</div><!--#content-inside -->
	</div><!-- #content -->

<?php get_footer(); ?>
