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
	require_once("form_consulta.php");
} 

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
