<?php 
/*
	este arquivo é responsável por inserir meta dados no consulta
    https://css-tricks.com/snippets/wordpress/custom-loop-based-on-custom-fields/
*/

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
        'foreach' percorre o vetor 'fields_consulta'
        sendo que cada item do vetor é um parametro/field.
        salva no post deste key: '$post_id', chave: valor
    */
    foreach ( $fields_consulta as $field ) {
        if ( array_key_exists($field, $_POST) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post', 'salva_meta_box' );
