<?php
/*
	Este arquivo é responsável por juntar os dados do atendimento em sí,
	como relacionar os usuários: paciente e atendente, e outros dados como data, tipo de atendimento, especialidade, duração do atendimento
*/
/*
dados a ser armazenados:
identificador paciente,
identificador especialista,
duração do atendimento,
local do atendimento,
notas do especialista sobre o paciente,
solicitação de remedios,
(acho legal colocar dados dinamicos) 
*/
function consulta_post_type() {
	$labels = array(
		'name'                  => _x( 'consulta', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'consulta', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Gerenciador consulta', 'text_domain' ),
		'name_admin_bar'        => __( 'consulta', 'text_domain' ),
		'archives'              => __( 'Lista consultas', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'Todos os consultas', 'text_domain' ),
		'add_new_item'          => __( 'Agendando nova consulta no sistema', 'text_domain' ),
		'add_new'               => __( 'Agendando nova consulta', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Atualizando dados da consulta', 'text_domain' ),
		'update_item'           => __( 'Atualizando dados da consulta', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);

	$args = array(
		'label'                 =>  array( 'name' => __( 'consulta' ),'singular_name' => __( 'consulta' )),
		'description'           => __( 'Tipo consulta, destinado categorizar consulta.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array(/* 'custom-fields', */'editor', /*'title',*/ 'comments' , 'excerpt'),
		'taxonomies'            => array('category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_rest'			=> true,
		'rest_base'          	=> 'consultas',
		'menu_position'         => 2,
		'show_in_rest'		 	=> false,
		'rest_base'             => 'consulta',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'menu_icon'				=> 'dashicons-clipboard',
		'rewrite' 				=> array('slug' => 'consulta'),
		'query_var'				=> true,
		/*'capability_type'     => 'post',*//*nivel de acesso post como padrao*/
		/*'capability_type'     => 'nivel_de_acesso_consulta',*//*role custom*/
        'map_meta_cap'        	=> true,/*É importante observar que fazer isso remove a capacidade dos administradores ou editores de editar esse tipo de postagem personalizada até que especificamente concedamos a eles permissão.*/
        'capabilities' 			=> array(
							        'edit_post' => 'edit_consulta',
							        'edit_posts' => 'edit_consultas',
							        'edit_others_posts' => 'edit_other_consultas',
							        'publish_posts' => 'publish_consultas',
							        'read_post' => 'read_consulta',
							        'read_private_posts' => 'read_private_consultas',
							        'delete_post' => 'delete_consulta'
								),
	);
	
	register_post_type( 'consulta', $args );//consulta é a chave identificadora do Custom Post Type consulta

}
//add_action( 'init', 'consulta_post_type');
add_action( 'after_setup_theme', 'consulta_post_type');

//esse metodo permite que o CPT-consulta seja listado por categoria
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'consulta');
    $query->set('post_type',$post_type);
    return $query;
    }
}


/*
https://3.7designs.co/blog/2014/08/restricting-access-to-custom-post-types-using-roles-in-wordpress/
*/

