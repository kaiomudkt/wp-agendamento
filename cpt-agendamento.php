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
function agendamento_post_type() {
	$labels = array(
		'name'                  => _x( 'Programa de Educação Tutorial', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'agendamento', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Gerenciador agendamento', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'Lista agendamentos', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'Todos os Agendamentos', 'text_domain' ),
		'add_new_item'          => __( 'Adicionando novo agendamento no sistema', 'text_domain' ),
		'add_new'               => __( 'Adicionar novo agendamento', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Editar Agendamento', 'text_domain' ),
		'update_item'           => __( 'Atualizar Agendamento', 'text_domain' ),
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
		'label'                 =>  array( 'name' => __( 'Agendamento' ),'singular_name' => __( 'Agendamento' )),
		'description'           => __( 'Tipo Agendamento, destinado categorizar Agendamento.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'custom-fields', 'editor', /*'title',*/ 'comments' /*, 'excerpt'*/),
		'taxonomies'            => array('category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_rest'			=> true,
		'rest_base'          	=> 'Agendamentos',
		'menu_position'         => 2,
		'show_in_rest'		 	=> false,
		'rest_base'             => 'agendamento',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'menu_icon'				=> 'dashicons-clipboard',
		'rewrite' => array('slug' => 'programa_educacao_tutorial'),
		'query_var' => true,
	);
	
	register_post_type( 'agendamento', $args );//agendamento é a chave identificadora do Custom Post Type Agendamento

}
add_action( 'init', 'agendamento_post_type');

//esse metodo permite que o CPT-agendamento seja listado por categoria
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'agendamento');
    $query->set('post_type',$post_type);
    return $query;
    }
}
?>
