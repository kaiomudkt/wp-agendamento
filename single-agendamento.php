<?php
/*
	Este arquivo é especialmente para mostrar um unico poste do tipo Agendamento,
*/
get_header();
$layout = onepress_get_layout();
/**
 * @since 2.0.0
 * @see onepress_display_page_title
 */
do_action( 'onepress_page_before_content' );

$campus = esc_attr( get_post_meta( get_the_ID(), 'campus', true));

?>

<div id="content" class="site-content">
	<?php onepress_breadcrumb(); ?>
	<div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<header class="entry-header">
					<?php if ( has_post_thumbnail() ) { ?>
				        <div class="entry-thumbnail">
				            <?php
				            $layout = onepress_get_layout();
				            $size = 'thumbnail';
				            the_post_thumbnail( $size );
				            ?>
				        </div><!-- .entry-footer -->
				    <?php } ?>
				    <?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			        <?php if ( get_theme_mod( 'single_meta', 1 ) ) : ?>
						<div class="entry-meta">
				        	<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Categorias: <?php the_category(', ') ?></p>
							<?php onepress_posted_on(); ?>
							<?php the_author(); ?>
							<?php echo 'yyyyy' ?>
				        	<p><?php edit_post_link('Edit'); ?></p>
						</div><!-- .entry-meta -->
			        <?php endif; ?>
			        
				</header><!-- .entry-header -->

				<?php if (has_excerpt()) : ?>
					<h2>descrição: </h2>
					<?php the_excerpt(); ?>
				<?php endif; ?>

				<?php if( $instituicao_pertencente) : ?>
					<p>Instituição: <?php echo $instituicao_pertencente; ?></p>
				<?php endif; ?>
				
				<?php if( $tutor): ?>
					<p class="">Tutor: <?php echo $tutor; ?></p>
				<?php endif; ?>			
				
				<?php if( $qtd_integrantes ): ?>
					<p >Quantidade de Membros: <?php echo $qtd_integrantes; ?> petianos</p>
				<?php endif; ?>

				<p>
					<?php if( $cidade  ): ?>
						<?php echo $cidade . ' - '; ?>
					<?php endif; ?>
					<?php if ($estado): ?>
						<?php echo $estado; ?>
					<?php endif; ?>
				</p>

				<?php if ($campus): ?>
					<p><?php echo 'campus: '.$campus; ?></p>
				<?php endif; ?>

				<?php if( $link_site ): ?>
					<p class="">
						<a class="btn btn-primary" href="<?php echo $link_site; ?>" role="button" >
						Venha conferir nosso site
						</a>
			 		</p>
				<?php endif; ?>

				<h3>Sobre: </h3>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'onepress' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
				<?php endwhile; // End of the loop. ?>

				<?php 
				// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				 ?>

				<?php 
				if ($localizacao) {
					echo '<iframe src="$localizacao"></iframe>';
				}
				?>
			</main><!-- #main -->
		</div><!-- #primary -->

        <?php if ( $layout != 'no-sidebar' ) { ?>
            <?php get_sidebar(); ?>
        <?php } ?>
	</div><!--#content-inside -->
</div><!-- #content -->
<?php get_footer();?>