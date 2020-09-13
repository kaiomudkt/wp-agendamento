<?php

/*************************************************************
 **															**
 ** 				@author Mateus Ragazzi					**
 ** 	Funções da API REST para busca dos agendamentos 	**
 **															**
 *************************************************************/

add_action('rest_api_init', function () {

	/** 
	 * Função da API para pegar os agendamentos
	 * ROTA: /wp-json/v1/agendamentos/{mes}/{ano}
	 */
	register_rest_route('v1', '/agendamentos', array(
		'methods' => 'GET',
		'callback' => 'pegaAgendamentos',
	));

	function pegaAgendamentos(WP_REST_Request $request)
	{
		$parametros = $request->get_params();
		$mes = $parametros['mes'];
		$ano = $parametros['ano'];
		$especialista = $parametros['especialista'];

		$args = [
			'post_type' => 'consulta',
			'posts_per_page' => -1,
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => 'data',
					'value' => $ano . '-' .  $mes . '-01',
					'compare' => '>=',
					'type' => 'date'
				],
				[
					'key' => 'data',
					'value' => $ano . '-' .  $mes . '-31',
					'compare' => '<=',
					'type' => 'date'
				],
				[
					'key' => 'especialista_id',
					'value' => $especialista,
					'compare' => '='
				]
			]
		];

		$query = new WP_Query($args);
		$agendamentos = [];
		while ($query->have_posts()) {
			$query->the_post();
			$custom = get_post_meta(get_the_ID());
			$agendamentos[] = [
				'title' => 'Agendamento ' . get_the_ID(),
				'start' => $custom['data'][0] . 'T' . $custom['hora_inicio'][0],
				'end' => $custom['data'][0] . 'T' . $custom['hora_termino'][0],
				'display' => 'list-item'
			];
		}
		echo json_encode($agendamentos);
	}
	/******************************************/
});

/*****************************************
 **										**
 ** 	FIM DAS FUNÇÕES DA API REST 	**
 **										**
 *****************************************/
