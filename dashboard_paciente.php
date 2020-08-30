<?php 

add_action('admin_menu', 'custom_menu');
	
function custom_menu() { 
 
	add_menu_page( 
		'opções do cliente', 
		'Área do cliente', 
		'edit_posts', /* nivel de acesso do user */
		'menu_cliente', 
		'page_callback_function', 
		'dashicons-media-spreadsheet',
		'1'
	);
}


function page_callback_function(){
?>
	<h1>Lista de todas as consultas agendadas</h1>
	<h1>Lista de todas as consultas realizadas</h1>
	<h1>Lista de todas as áreas de atendimento </h1>
	<h1>Lista de todos os especialista por área</h1>
	<button>Marcar consulta</button>



<?php
}

 ?>