<?php 

add_action('admin_menu', 'custom_menu_especialista');
function custom_menu_especialista() { 
	add_menu_page( 
		'opções do especialista', 
		'Área do especialista', 
		'nivel_de_acesso_especialista', 
		'menu_slug_especialista', 
		'page_callback_function_especialista', 
		'dashicons-media-spreadsheet',
		'2'
	);
}

function page_callback_function_especialista(){
?>
	<?php 
	 ?>
	<div class="especialista">
		<h1>ESPECIALISTA: <?php echo get_current_user_id(); ?></h1>
		<div>
			<h3>Lista de todas as consultas agendadas</h3>
			<form action="">
				<ul>
					<?php
					//echo get_current_user_id();
					$consultas_agendadas = list_all_consulta(get_current_user_id());
					foreach ($consultas_agendadas as $consulta) {
						$paciente = esc_attr( get_post_meta( $consulta->ID, 'paciente', true));
					 	echo '<li>Consulta Nº: '.$consulta->ID.' | Paciente:'.$paciente.' <button>Preencher</button></li>';
					}
				    ?>
				</ul>
			</form>
		</div>
		<div>
			<h3>Lista de todas as consultas realizadas</h3>
			<ul>
				<li><a>consulta 1</a></li>
				<li><a>consulta 2</a></li>
				<li><a>consulta 3</a></li>
				<li><a>consulta 4</a></li>
				<li><a>consulta 5</a></li>
			</ul>
		</div>
	


		<br>
		<br><br>
		<br><br>


		<?php $cpt_consulta_id = 22 ?>
		<?php $dados_cpt_consulta = fill_form($cpt_consulta_id); ?>
		<?php //var_dump($dados_cpt_consulta); ?>
		<?php if ($dados_cpt_consulta): ?>
			<?php 
				$paciente = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'paciente', true));
				$marcar_volta = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'marcar_volta', true));
				$lista_de_remedios = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'lista_de_remedios', true));
				$especialista = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'especialista', true));
				$motivo_da_consulta = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'motivo_da_consulta', true));
		 		?>
				<div class="consulta">
					<h1>Consulta nº: <?php echo esc_attr($dados_cpt_consulta->ID); ?></h1>
					<div class="relatorio">
						<div class="meta-options campos">
					        <label for="relatorio">Relatório do atendimento</label>
					        <textarea type="text" name="relatorio">
					        	<?php echo esc_attr( $dados_cpt_consulta->post_content ); ?>
					    	</textarea>
					    </div>
					</div>

					<div class="informacoes">
						<?php require_once("cpt_consulta_form.php"); ?>
					</div>

					<div class="comentarios">
					</div>
					<button>salvar</button>
				</div><!-- fim consulta -->
		<?php endif ?>

	</div>
<?php } ?>

<?php 
function get_consulta_by_slug($slug){
	$args=array(
	    'name'           => $slug,
	    'post_type'      => 'consulta',
	    'post_status'    => 'publish',
	    'posts_per_page' => 1
	);
	$my_posts = get_posts( $args );
	 
	if ( $my_posts ) {
	   // printf( __( 'ID on the first post found %s', 'textdomain' ), esc_html( $my_posts[0]->ID ) );
	}
}
?>


<?php 
/* 
	Lista de todas as consultas agendadas que vão acontecer, do usuario corrente,
	percorrer a lista de cpt_consultas agendadas,
	retornar todas as consultas que são deste usuario e que ainda não foram realizadas

	'user'  	=> 1 						deste user
	'post_type' => 'consulta', 				deste cpt
	'meta_key'  => 'consulta_realizada',	consulta_realizada == true
	'meta_value'=> 'false',
 */
	//depois que especialista fazer atendimento, marcar como true 'consulta_realizada'
function list_all_consulta($usuario){
	$query_consultas = new WP_Query(
		[
			//'posts_per_page' => 1, 
			'post_type' 	=> 'consulta', 
			//'meta_key' 		=> 'consulta_realizada',
			//'meta_value' 	=> 'false',
			//'meta_key'	=>	'especialista',
			//'meta_value' => $usuario,

		]
	);
	return $query_consultas->get_posts();
}

function fill_form($cpt_consulta_id){
	return get_post($cpt_consulta_id);

}
 ?>
