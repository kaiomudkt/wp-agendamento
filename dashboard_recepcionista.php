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
	require_once("form_consulta.php");

	?>
	<div>
		<div>
			<h3>Lista de todas as consultas agendadas</h3>
			<form method="post">
					<ul>
						<?php
						//echo get_current_user_id();
						$consultas_agendadas = list_all_consulta(get_current_user_id());
						foreach ($consultas_agendadas as $consulta) {
							$paciente = esc_attr( get_post_meta( $consulta->ID, 'paciente', true));
						 	echo '<li>Consulta Nº: '.$consulta->ID.' | Paciente:'.$paciente.' | Data: dd/mm/yyyy hh:mm <button>Preencher</button></li>';
						}
					    ?>
					</ul>
			</form>
		</div>

		<div>
			<h3>Lista de todas as consultas realizadas</h3>
			<h3>Lista de todas as áreas de atendimento </h3>
			<h3>Lista de todos os especialista por área</h3>
		</div>
	</div>
<?php 
} /* fim page_callback_function_recepcionista() */
?>