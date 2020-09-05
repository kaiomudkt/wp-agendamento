
<?php 
/*
    verificar quem esta logado,
    se é um paciente ou especialista,
    se for especialista deixa editar os campos,
    se for o paciente, n pode editar os campos
*/
 ?>
<div class="hcf_box">
    
    <div class="meta-options campos">
        <label for="especialista">Especialista</label>
        <input id="especialista" readonly="true"
            type="text"
            name="especialista"
            <?php $especialista = esc_attr(get_post_meta($dados_cpt_consulta->ID,'especialista', true ) ); ?>
        <?php if ($especialista):  ?>
            value="<?php echo $especialista; ?>"
        <?php else: ?>
            value="<?php echo esc_attr('paciente escolhe especialista'); ?>"
        <?php endif; ?>
        >
    </div>
            <?php //echo $dados_cpt_consulta->ID; ?>

    <div class="meta-options campos">
        <label for="paciente">Paciente</label>
        <input id="paciente" readonly="true"
        type="text"
        name="paciente"
        value="<?php echo esc_attr(get_post_meta( $dados_cpt_consulta->ID, 'paciente', true ) ); ?>">
    </div>

    <div class="meta-options campos">
        <label for="lista_de_remedios">Lista de remedios</label>
        <input id="lista_de_remedios"
        type="text"
        name="lista_de_remedios"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lista_de_remedios', true ) ); ?>">
    </div>

    <div class="meta-options campos">
        <label for="motivo_da_consulta">Motivo da consulta</label>
        <input id="motivo_da_consulta"
        type="text"
        name="motivo_da_consulta"
        value="<?php echo esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'motivo_da_consulta', true ) ); ?>">
    </div>

    <div class="meta-options campos">
        <label for="marcar_volta">Marcar volta</label>
        <input id="especialista"
        type="text"
        name="marcar_volta"
        value="<?php echo esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'marcar_volta', true ) ); ?>">
    </div>

    <div>
        <input readonly="true"
        type="hidden"
        name="consulta_realizada"
        value="false">
    </div>

</div>
