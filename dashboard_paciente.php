<?php 

add_action('admin_menu', 'custom_menu_paciente');
function custom_menu_paciente() { 
	add_menu_page( 
		'opções do paciente', 
		'Área do paciente', 
		'nivel_de_acesso_paciente', 
		'menu_slug_paciente', 
		'page_callback_function_paciente', 
		'dashicons-media-spreadsheet',
		'2'
	);
}


function page_callback_function_paciente(){
	require_once("dashboard_list_agendamentos_consultas.php"); 
	require_once("dashboard_form_consulta.php");
}