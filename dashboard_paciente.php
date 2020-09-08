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

	/*se tiver consulta selecionada deste paciente mostrar o form, somente para apresentar os dados para o paciente*/
	require_once("form_consulta.php");
	?>
	<form method="POST">
		<input class="subput round" type="submit" name="submit" value="Solicitar agendamento de consulta"/>
	</form>
	<?php
}