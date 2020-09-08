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
	require_once("lista_agendamentos_consultas.php"); 
	require_once("form_consulta.php");
}

function fill_form($cpt_consulta_id){
	return get_post($cpt_consulta_id);

}
 ?>
