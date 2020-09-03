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
?>
	<h1>RECEPCIONISTA</h1>
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