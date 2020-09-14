
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
        <label for="especialista">especialista</label>
        <?php ?>
        <select name="especialista_id" required
        ><!--fim <select>-->
            <?php 
                $especialista_id =  esc_attr(get_post_meta( get_the_ID(), 'especialista_id', true ) );
                if ($especialista_id) {
                    $especialista = get_user_by('id', $especialista_id);
                    echo '<option value="'.$especialista->ID.'"selected >'.$especialista->display_name.' ID: '.$especialista->ID.'</option>';
                }else{
                    $especialistas = list_especialistas(); 
                    foreach ($especialistas as $especialista) {
                        echo '<option value="'.$especialista->ID.'">'.$especialista->display_name.' ID: '.$especialista->ID.'</option>';
                    }
                } ?>
        </select>
    </div>

    <div class="meta-options campos">
        <label for="paciente">Paciente</label>
        <?php //var_dump(list_pacientes()); ?>
        <?php ?>
        <select name="paciente_id" required
        <?php if(!(role_logada() == 'recepcionista') && !(role_logada() == 'administrator'))  {
            echo 'disabled';
        } ?>
        ><!--fim <select>-->
            <?php 
                $paciente_id =  esc_attr(get_post_meta( get_the_ID(), 'paciente_id', true ) );
                if ($paciente_id) {
                    $paciente = get_user_by('id', $paciente_id);
                    echo '<option value="'.$paciente->ID.'"selected >'.$paciente->display_name.' ID: '.$paciente->ID.'</option>';
                }else{
                    $pacientes = list_pacientes(); 
                    foreach ($pacientes as $paciente) {
                        echo '<option value="'.$paciente->ID.'">'.$paciente->display_name.' ID: '.$paciente->ID.'</option>';
                    }
                } ?>
        </select>
    </div>

    <div>
        <label>Recepcionista</label>
        <input type="number" name="recepcionista_id" readonly required
        <?php $recepcionista_id =  esc_attr(get_post_meta( get_the_ID(), 'recepcionista_id', true ) ); ?>
        <?php if ($recepcionista_id): ?>
            <?php $recepcionista = get_user_by('id', $recepcionista_id); ?>
            <?php echo 'value="'.$recepcionista->ID.'"'; ?>
        <?php else: ?>
            <?php echo 'value="'.id_usuario_logado().'"'; ?>
        <?php endif; ?>
        ><!--fim input-->
    </div>

    <div>
        <label>Horário de início</label>
        <input type="time" name="hora_inicio" min="07:00" max="17:00" required
            <?php $hora_inicio =  esc_attr(get_post_meta( get_the_ID(), 'hora_inicio', true ) ); ?>
            <?php if ($hora_inicio): ?>
                value="<?php echo $hora_inicio; ?>"
            <?php endif; ?>
          ><!-- fi input-->
    </div>
    <div>
        <label>Horário de término</label>
        <input type="time" name="hora_termino" min="07:00" max="17:00" required
            <?php $hora_termino =  esc_attr(get_post_meta( get_the_ID(), 'hora_termino', true ) ); ?>
            <?php if ($hora_termino): ?>
                value="<?php echo $hora_termino; ?>"
            <?php endif; ?>
          ><!-- fi input-->
    </div>

    <div class="meta-options campos">
        <label for="lista_de_remedios">Lista de remedios</label>
        <input id="lista_de_remedios"
        type="text"
        name="lista_de_remedios"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lista_de_remedios', true ) ); ?>">
    </div>

    <div class="meta-options campos">
        <label for="marcar_volta">Marcar volta</label>
        <input 
        type="datetime-local"
        name="marcar_volta"
            <?php $voltar = esc_attr( get_post_meta( get_the_ID(), 'marcar_volta', true ) ); ?>
            <?php if ($voltar): ?>
                value="<?php echo $voltar; ?>"
            <?php endif ?>
        ><!-- fim input-->
    </div>

    <div class="meta-options campos">
        <label for="motivo_da_consulta">Motivo da consulta</label>
        <input id="motivo_da_consulta"
            type="text"
            name="motivo_da_consulta"
            <?php $motivo = esc_attr( get_post_meta( get_the_ID(), 'motivo_da_consulta', true ) ); ?>
            <?php if ($motivo): ?>
                value="<?php echo $motivo; ?>"
            <?php endif; ?>
        ><!-- fim input-->
    </div>

    <div>
        <label for="consulta_realizada">Consulta já foi realizada?</label>
        <input type="checkbox" name="consulta_realizada"
            <?php $consulta_realizada = esc_attr( get_post_meta( get_the_ID(), 'consulta_realizada', true ) ); ?>
            <?php if ($consulta_realizada == 'on'): ?>
                checked
            <?php endif; ?>
        ><!-- fim input-->
    </div>

    <div>
        <label for="cancelar">Cancelar/excluir agendamento de consulta?</label>
        <input type="checkbox" name="cancelar"
        <?php $cancelar = esc_attr( get_post_meta( get_the_ID(), 'cancelar', true ) ); ?>
            <?php if ($cancelar == 'on'): ?>
                checked
            <?php endif; ?>
        ><!-- fim input-->
    </div>

    <div>
        <input readonly="true"
        type="hidden"
        name="consulta_realizada"
        value="false">
    </div>

</div>
