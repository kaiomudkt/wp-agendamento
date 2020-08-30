<?php 
/* 	
	carrega os arquivos css do tema pai, 
	pois pode acontecer de nao pegar automaticamente
*/
function carrega_estilos(){
    wp_enqueue_style('estilo-pai', get_template_directory_uri() . '/style.css');
}
/*
	gancho/hook que vai chamar a funcao a função carrega_estilos()
*/
add_action('wp_enqueue_scripts' , 'carrega_estilos');


/*
	caminho do tema do diretorio filho
*/
$diretorio_filho = get_stylesheet_directory();


/**/
require_once($diretorio_filho . '/cpt_consulta.php');

/*meta box para dados do agendamento*/
require_once($diretorio_filho . '/meta_box_agendamento.php');

/* arquivo responsavel por inseir meta dados no usuario especialista*/
require_once($diretorio_filho . '/cpt_calendario.php');

/**/
require_once($diretorio_filho . '/dashboard_paciente.php');

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