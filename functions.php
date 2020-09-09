<?php 
/* 	
	carrega os arquivos css do tema pai, 
	pois pode acontecer de nao pegar automaticamente
*/
function carrega_estilos(){
	$parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );

    // wp_enqueue_style('estilos-pai', get_template_directory_uri() . '/style.css');
    // wp_enqueue_style('estilo_filho_1', get_stylesheet_directory_uri() . '/style.css');

    // wp_enqueue_style('estilo_pai', get_template_directory_uri() . '/style.css');
    // //wp_enqueue_style('estilo_filho', get_stylesheet_directory_uri() . '/style.css');
    // wp_enqueue_style('estilo_filho', get_stylesheet_directory() . '/style.css');
    
}
/*
	gancho/hook que vai chamar a funcao a função carrega_estilos()
*/
add_action('wp_enqueue_scripts' , 'carrega_estilos');


/*
	caminho do tema do diretorio filho
*/
$diretorio_filho = get_stylesheet_directory();


/* removendo funções padroes do wp, adiciona função(nivel de acesso) paciente, especialista e recepcionista */
require_once($diretorio_filho . '/manager_roles.php');

/* cria o custom post type 'cpt_consulta' */
require_once($diretorio_filho . '/cpt_consulta.php');

/*meta box de dados para o 'cpt_consulta' */
require_once($diretorio_filho . '/cpt_consulta_meta_box.php');

/* arquivo responsavel por inseir meta dados no usuario especialista*/
require_once($diretorio_filho . '/cpt_calendario.php');

/*tela com funcionalidades do paciente*/
require_once($diretorio_filho . '/dashboard_paciente.php');

/*tela com funcionalidades do especialista*/
require_once($diretorio_filho . '/dashboard_especialista.php');

/*tela com funcionalidades do recepcionista*/
require_once($diretorio_filho . '/dashboard_recepcionista.php');

/* API GET event */
require_once($diretorio_filho . '/endpoint/get_event.php');



/* funções no escopo do tema, ou seja, acessivel dentro do tema */
/* 
    retorna a role do usuario logado: administrator, especialista, paciente, recepcionista 
*/
function role_logada(){
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;
    return $roles[0];
}

function nome_usuario_logado(){
    $user = wp_get_current_user();
    $name = ( array ) $user->display_name;
    return implode(' ', $name);//converte array para string
}

function id_usuario_logado(){
    $user = wp_get_current_user();
    $user_id = ( array ) $user->ID;
    return implode(' ', $user_id);//converte array para string
}
