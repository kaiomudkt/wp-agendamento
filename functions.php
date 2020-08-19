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
require_once($diretorio_filho . '/cpt-agendamento.php');
 ?>