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

	require_once("dashboard_list_agendamentos_consultas.php"); 
	?>
	<div>
		<h3>Lista de horários disponíveis para atender</h3>
	</div>
	<?php
	require_once("dashboard_form_consulta.php");
	
}
 ?>
