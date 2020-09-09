<?php 
	/*
	Lista consultas, ou seja,
	a consulta ja foi realizada.
	*/
	/*
		Lista agendamentos, ou seja,
		consultas que foram marcadas, mas ainda não foram realizadas
	*/
?>
<div class="container">
	<h1>Seja bem vindo <?php echo nome_usuario_logado(); ?> | Identificador(ID): <?php echo id_usuario_logado(); ?></h1>
	<h2>Nivel de acesso: <?php echo role_logada(); ?></h2>
</div>
<div>
	<div>
		<h3>Lista ultimas consultas agendadas</h3>
		<?php 
		$lista_agendadas = list_all_consultas(get_current_user_id(), 'false');
		lista_consultas($lista_agendadas);
		 ?>
	</div>

	<div>
		<h3>Lista de todas as consultas realizadas</h3>
		<?php  					
		$lista_consultas = list_all_consultas(get_current_user_id(), 'true');
		lista_consultas($lista_consultas);
		?>
	</div>
</div>

<?php 
function list_all_consultas($usuario, $consulta_realizada){
	$argumentos = array(
			'posts_per_page' => 10, 
			'post_type' 	=> 'consulta', 
			//'meta_key' 		=> 'consulta_realizada',
			//'meta_value' 	=> $consulta_realizada,
		);

	if (role_logada() == 'especialista') {
		$argumentos['meta_key']	= 'especialista_id';
		$argumentos['meta_value'] = $usuario;
	}elseif (role_logada() == 'paciente') {
		$argumentos['meta_key']	= 'paciente_id';
		$argumentos['meta_value'] = $usuario;
	}
	
	$query_consultas = new WP_Query($argumentos);
	return $query_consultas->get_posts();
}

function lista_consultas($lista_consultas){
	?>
	<ul>
		<?php  	
		foreach ($lista_consultas as $agendada) {

			$data =  esc_attr(get_post_meta( $agendada->ID, 'data', true ) ); 
			$hora_inicio =  esc_attr(get_post_meta( $agendada->ID, 'hora_inicio', true ) ); 
			$hora_termino =  esc_attr(get_post_meta( $agendada->ID, 'hora_termino', true ) ); 
			$paciente = esc_attr( get_post_meta( $agendada->ID, 'paciente_id', true));
			$especialista = esc_attr( get_post_meta( $agendada->ID, 'especialista_id', true));

			
		 	echo '<li>';
			echo '<form method="post">';

		 	echo '<span>agendada Nº: '.$agendada->ID.' | Paciente:'.$paciente.' | Especialista: '.$especialista.'| Data: '.$data.' '.$hora_inicio.' às '.$hora_termino.'</span>';
		 	echo '<input type="hidden" value="'.$agendada->ID.'" name="consulta_id"  readonly>';
		 	echo '<input class="subput round" type="submit" name="editar_form" value="Editar consulta"/>';
		 	echo '</form>';
			echo '</li>';
		}
		?>
	</ul>
	<?php
}

?>