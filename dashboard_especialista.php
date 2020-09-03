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
		'1'
	);
}

function page_callback_function_especialista(){
?>

<div>
	<h1>ESPECIALISTA</h1>
	<h1>Lista de todas as consultas agendadas</h1>
	<h1>Lista de todas as consultas realizadas</h1>
	<h1>Lista de todas as áreas de atendimento </h1>
	<h1>Lista de todos os especialista por área</h1>
	<button>Marcar consulta</button>
	<br>
	<?php  
	$user = wp_get_current_user();
	$roles = ( array ) $user->roles; ; 
	var_dump($roles);
	?>
</div>
<?php } ?>