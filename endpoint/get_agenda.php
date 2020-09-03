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
	register_rest_route('v1', '/agendamentos/(?P<mes>\d+)/(?P<ano>\d+)', array(
		'methods' => 'GET',
		'callback' => 'pegaAgendamentos',
	));

	function pegaAgendamentos(WP_REST_Request $request)
	{
		$parametros = $request->get_params();
		$mes = $parametros['mes'];
		$ano = $parametros['ano'];

		$args = [
			'post_type' => 'event',
			'posts_per_page' => -1,
			'meta_query' => [
				[
					'key' => 'mes',
					'value' => $mes,
					'compare' => 'LIKE'
				],
				[
					'key' => 'ano',
					'value' => $ano,
					'compare' => 'LIKE'
				]
			]
		];

		$query = new WP_Query($args);
		echo json_encode($query->get_posts());
	}
	/******************************************/
});

/*****************************************
 **										**
 ** 	FIM DAS FUNÇÕES DA API REST 	**
 **										**
 *****************************************/


 ?>