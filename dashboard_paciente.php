<?php 

add_action('admin_menu', 'custom_menu_paciente');
function custom_menu_paciente() { 
	add_menu_page( 
		'opções do cliente', 
		'Área do cliente', 
		'nivel_de_acesso_paciente', 
		'menu_cliente', 
		'page_callback_function_paciente', 
		'dashicons-media-spreadsheet',
		'1'
	);
}


function page_callback_function_paciente(){
?>
	<h1>PACIENTE</h1>
	<h1>Lista de todas as consultas agendadas</h1>
	<h1>Lista de todas as consultas realizadas</h1>
	<h1>Lista de todas as áreas de atendimento </h1>
	<h1>Lista de todos os especialista por área</h1>
	<button>Marcar consulta</button>

	<br>
	<?php echo 'sobre a role: ' ; ?>
	<br>
	<?php var_dump(get_role('administrator')); ?>

<?php } ?>