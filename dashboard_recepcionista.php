<?php 

add_action('admin_menu', 'custom_menu_recepcionista');
function custom_menu_recepcionista() { 
	add_menu_page( 
		'opções do recepcionista', 
		'Área do recepcionista', 
		'nivel_de_acesso_recepcionista', 
		'menu_slug_recepcionista', 
		'page_callback_function_recepcionista', 
		'dashicons-media-spreadsheet',
		'2'
	);
}

function page_callback_function_recepcionista(){
	require_once("dashboard_list_agendamentos_consultas.php"); 
	require_once("dashboard_form_consulta.php");
} /* fim page_callback_function_recepcionista() */
?>