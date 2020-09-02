
<?php 
/*
    verificar quem esta logado,
    se é um paciente ou especialista,
    se for especialista deixa editar os campos,
    se for o paciente, n pode editar os campos
*/
 ?>
<div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .campos{
            display: contents;
        }
    </style>

    <div class="meta-options campos">
        <label for="lista_de_remedios">Lista de remedios</label>
        <input id="lista_de_remedios"
        type="text"
        name="lista_de_remedios"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lista_de_remedios', true ) ); ?>">
    </div>
    <div class="meta-options campos">
        <label for="especialista">Especialista</label>
        <input id="especialista" disabled
        type="text"
        name="especialista"
        value="<?php echo 'especialista 1'; ?>">
    </div>

    <div class="meta-options campos">
        <label for="paciente">paciente</label>
        <input id="paciente" disabled
        type="text"
        name="paciente"
        value="<?php echo 'paciente 88'; ?>">
    </div>

    <div class="meta-options campos">
        <label for="motivo_da_consulta">motivo_da_consulta</label>
        <input id="motivo_da_consulta"
        type="text"
        name="motivo_da_consulta"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'motivo_da_consulta', true ) ); ?>">
    </div>

    <div class="meta-options campos">
        <label for="marcar_volta">marcar_volta</label>
        <input id="especialista"
        type="text"
        name="marcar_volta"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'marcar_volta', true ) ); ?>">
    </div>

</div>
