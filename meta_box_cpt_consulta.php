<?php 
/*
	este arquivo é responsável por inserir meta dados no consulta

dados a ser armazenados:
	identificador do paciente,
	identificador do especialista,
	duração do atendimento,
	local do atendimento,
	notas do especialista sobre o paciente,
	solicitação de remedios,
	horário de inicio,
	horário de termino,
	(acho legal colocar dados dinamicos) 

*/
// https://css-tricks.com/snippets/wordpress/custom-loop-based-on-custom-fields/


/**
 * Register meta boxes.
 */
function registrar_meta_boxes_consulta() {
    add_meta_box( 
        'id_meta_box_consulta',
        'dados do consulta', 
        'consulta_display_callback', 
        'consulta', 
        'normal', 
        'high' 
    );
}
add_action( 'add_meta_boxes', 'registrar_meta_boxes_consulta' );


/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function consulta_display_callback( $post ) {
    require_once("cpt_consulta_form.php");
}


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function salva_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields_consulta = [
        'lista_de_remedios',
        'especialista',
        'paciente',
        'motivo_da_consulta',
        'marcar_volta',
    ];
    /*
    'foreach percorre o vetor 'fields_consulta'
    sendo que cada item do vetor é um parametro/field */
    foreach ( $fields_consulta as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {/*existe esse elemento no na estrutura de dados (array) ? */
            /* salva no post deste '$post_id',
            chave: valor */
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }else{
            // echo 'nao exite esse parameto' . $field;
        }
    }
}
add_action( 'save_post', 'salva_meta_box' );


?>
<?php

/*tentando remover  a meta box 'discussao', mais ainda nao consegui*/
add_action( 'default_hidden_meta_boxes', 'acme_remove_meta_boxes', 10, 2 );
/**
 * Removes the category, author, post excerpt, and slug meta boxes.
 *
 * @since    1.0.0
 *
 * @param    array    $hidden    The array of meta boxes that should be hidden for Acme Post Types
 * @param    object   $screen    The current screen object that's being displayed on the screen
 * @return   array    $hidden    The updated array that removes other meta boxes
 */
function acme_remove_meta_boxes( $hidden, $screen ) {
    if ( 'acme_post_type' == $screen->id ) {
        $hidden = array(
            'acme_post_type_categorydiv',
            'discussion',
            'postexcerpt',
            'commentstatusdiv'
            );

    }
    return $hidden;    
}