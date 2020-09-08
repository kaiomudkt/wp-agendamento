	<!-- formulario do cpt_consulta para todos os usuarios -->
	<div>
		<form method="POST">
			<div class="hcf_box">
				<?php //$cpt_consulta_id = 64; ?>
				<?php $cpt_consulta_id = 0; ?>
				<?php $dados_cpt_consulta = null; ?>
				<?php 
				if (isset($_POST['editar_form'])) {
					if (isset($_POST['consulta_id'])) {
						echo 'existe isso _POST[consulta_id] ';
						var_dump($_POST['consulta_id']);
						$cpt_consulta_id = $_POST['consulta_id'];
						$dados_cpt_consulta = get_post($cpt_consulta_id); 
					}
				}
				?>
				<?php if (isset($dados_cpt_consulta) && isset($dados_cpt_consulta->ID)): ?>
					<h1>Consulta nº: <?php echo esc_attr($dados_cpt_consulta->ID); ?></h1>
				<?php else: ?>			
					<h1>Agendar nova Consulta</h1>
				<?php endif; ?>

				<div class="meta-options campos">
			        <label for="paciente">Paciente (ID)</label>
			        <input id="paciente" required type="number" name="paciente_id"
			        <?php
			        if ($dados_cpt_consulta) :
		        		//echo 'readonly="true"';
			        	$paciente =  esc_attr(get_post_meta( $dados_cpt_consulta->ID, 'paciente_id', true ) ); 
				        if ($paciente) :
				        	echo 'value="'.$paciente.'"';
			        	endif;
			        endif;
			        if(!(role_logada() == 'recepcionista') && !(role_logada() == 'administrator'))  {
		        		echo 'readonly';
	        		}
			        ?>
			        ><!-- fecha input -->
			    </div>

			    <div class="meta-options campos">
			        <label for="especialista">Especialista (ID)</label>
			        <input id="especialista"  required type="number" name="especialista_id"
			            <?php
			        if ($dados_cpt_consulta) :
		        		//echo 'readonly="true"';
			        	$especialista =  esc_attr(get_post_meta( $dados_cpt_consulta->ID, 'especialista_id', true ) ); 
				        if ($especialista) :
				        	echo 'value="'.$especialista.'"';
			        	endif;
			        endif;
		        	if(!(role_logada() == 'recepcionista') && !(role_logada() == 'administrator'))  {
		        		echo 'readonly';
	        		}
			        ?>
			        ><!-- fecha input -->
			    </div>

			    <div>
					<label>Recepcionista (ID)</label>
					<input type="number" name="recepcionista_id" readonly required
					<?php if ($dados_cpt_consulta): ?>
						<?php if ($dados_cpt_consulta->post_author): ?>
							<?php echo 'value="'.$dados_cpt_consulta->post_author.'"'; ?>
						<?php endif; ?>
					<?php else: ?>
						<?php echo 'value="'.id_usuario_logado().'"'; ?>
					<?php endif; ?>
					
					><!--fim input-->
				</div>

				<div>
					<label>Data</label>
					<input type="date" name="data" required
					<?php 
						if ($dados_cpt_consulta) {
							$data =  esc_attr(get_post_meta( $dados_cpt_consulta->ID, 'data', true ) ); 
							if ($data) {
								echo 'value="'.$data.'"';
							}
						}
					 ?>
					 <?php if(!(role_logada() == 'recepcionista') && !(role_logada() == 'administrator'))  {
		        		echo 'readonly';
	        		} ?>
					><!-- fim input-->
				</div>

				<div>
					<label>Horário de início</label>
					<input type="time" name="hora_inicio" min="07:00" max="17:00" required
     				  	<?php if($dados_cpt_consulta): ?>
     				  		<?php $hora_inicio =  esc_attr(get_post_meta( $dados_cpt_consulta->ID, 'hora_inicio', true ) ); ?>
     				  		<?php if ($hora_inicio): ?>
     				  			value="<?php echo $hora_inicio; ?>"
     				  		<?php endif ?>
 				  		<?php endif; ?>
 				  		<?php if(!(role_logada() == 'recepcionista') && !(role_logada() == 'administrator'))  {
		        		echo 'readonly';
	        		} ?>
     				  ><!-- fi input-->
				</div>

				<div>
					<label>Horário de término</label>
					<input type="time" name="hora_termino" min="07:00" max="17:00" required
     				  	<?php if($dados_cpt_consulta): ?>
     				  		<?php $hora_termino =  esc_attr(get_post_meta( $dados_cpt_consulta->ID, 'hora_termino', true ) ); ?>
     				  		<?php if ($hora_termino): ?>
     				  			value="<?php echo $hora_termino; ?>"
     				  		<?php endif ?>
 				  		<?php endif; ?>
 				  		<?php if(!(role_logada() == 'recepcionista') && !(role_logada() == 'administrator'))  {
		        		echo 'readonly';
	        		} ?>
     				  ><!-- fi input-->
				</div>

				<div class="meta-options campos">
			        <label for="relatorio">Relatório do atendimento</label>
			        <textarea type="text" name="relatorio" 
			        <?php 
			        if(!(role_logada() == 'especialista') && !(role_logada() == 'administrator'))  {
		        		echo 'readonly';
	        		} ?>
	        		>
			        	<?php if ($dados_cpt_consulta && $dados_cpt_consulta->post_content): ?>
			        		<?php echo esc_attr( $dados_cpt_consulta->post_content ); ?>
			        	<?php endif; ?>
			    	</textarea>
			    </div>

		    	<div class="meta-options campos">
			        <label for="lista_de_remedios">Lista de remedios</label>
			        <input id="lista_de_remedios"
			        type="text"
			        name="lista_de_remedios"
			        <?php if ($dados_cpt_consulta): ?>
			        	<?php $lista_de_remedios = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'lista_de_remedios', true ) ); ?>
			        	<?php if ($lista_de_remedios): ?>
				        	value="<?php echo $lista_de_remedios; ?>"
			        	<?php endif; ?>
		            <?php endif; ?>
			        <?php if(!(role_logada() == 'especialista') && !(role_logada() == 'administrator'))  {
			         	echo 'readonly="true"';
			        }?>
			        ><!-- fim input-->
		    	</div>

			    <div class="meta-options campos">
			        <label for="motivo_da_consulta">Motivo da consulta</label>
			        <input id="motivo_da_consulta"
			        type="text"
			        name="motivo_da_consulta"
			        <?php if ($dados_cpt_consulta): ?>
			        	<?php $motivo = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'motivo_da_consulta', true ) ); ?>
			        	<?php if ($motivo): ?>
					        value="<?php echo $motivo; ?>"
			        	<?php endif; ?>
			        <?php endif; ?>
			        <?php if(!(role_logada() == 'recepcionista') && !(role_logada() == 'administrator'))  {
			         	echo 'readonly="true"';
			        }?>
			         ><!-- fim input-->
			    </div>

			    <div class="meta-options campos">
			        <label for="marcar_volta">Marcar volta</label>
			        <input 
			        type="datetime-local"
			        name="marcar_volta"
			        <?php if ($dados_cpt_consulta): ?>
			        	<?php $voltar = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'marcar_volta', true ) ); ?>
			        		<?php if ($voltar): ?>
			        			value="<?php echo $voltar; ?>"
			        		<?php endif ?>
			        <?php endif ?>
			        <?php if(!(role_logada() == 'recepcionista') && !(role_logada() == 'administrator'))  {
			         	echo 'readonly="true"';
			        }?>
			        ><!-- fim input-->
			    </div>

			    <!-- 
			    	(essa consulta ja foi realizada) ? true : false
					essa campo vai ajudar a listar consultar a ser realizada
			     -->
		        <div>
		        	<label for="consulta_realizada">consulta já foi realizada?</label>
		        	<input type="text" name="consulta_realizada"
				    <?php if ($dados_cpt_consulta): ?>
				    	<?php $consulta_realizada = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'consulta_realizada', true ) ); ?>
				    		<?php if (isset($consulta_realizada)): ?>
				    			value="<?php echo $consulta_realizada; ?>"
				    		<?php endif; ?>
		    		<?php else: ?>
		    			value="false"
				    <?php endif; ?>
				   <?php if(!(role_logada() == 'especialista') && !(role_logada() == 'administrator'))  {
		        		echo 'readonly';
	        		} ?>
			        ><!-- fim input-->
		        </div>

		        <div>
		        	<label for="cancelar">Cancelar agendamento de consulta?</label>
		        	<input type="text" name="cancelar"
				    <?php if ($dados_cpt_consulta): ?>
				        <?php $cancelar = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'cancelar', true ) ); ?>
				    		<?php if (isset($cancelar)): ?>
				    			value="<?php echo $cancelar; ?>"
				    		<?php endif; ?>
		    		<?php else: ?>
		    			value="false"
				    <?php endif; ?>
				    <?php if(!(role_logada() == 'especialista') && !(role_logada() == 'administrator'))  {
		        		echo 'readonly="true"';
	        		} ?>
				        ><!-- fim input-->
		        </div>

		        <div> <!-- categorias -->
		        	 <?php //wp_dropdown_categories('orderby=name&hide_empty=0&exclude=1&hierarchical=1&taxonomy=< taxonomy name >&post_type=< post_type >'); ?>
		        </div>

				<div class="comentarios">
					comentarios
				</div>

				

				<?php if (isset($dados_cpt_consulta)): ?>
					<?php if ($dados_cpt_consulta->ID): ?>
						<input type="hidden" name="consulta_id" required
						<?php echo 'value="'.esc_attr($dados_cpt_consulta->ID).'"'; ?>
						><!-- fim input -->
					<?php endif; ?>
				<?php endif; ?>
				
				<?php if(role_logada() != 'paciente') : ?>
					<input class="subput round" type="submit" name="botao_form" value="Salvar consulta"/>
				<?php endif ?>
			</div>
		</form>
	</div>

	<?php 
	/*https://stackoverflow.com/questions/4321914/wp-insert-post-with-a-form*/
	/*recebe dados do formulario*/
	if(isset($_POST['botao_form'])) {

	    $post_title   = 'P: '.$_POST['paciente_id'].' - E'.$_POST['especialista_id'].' '.$_POST['data'] ;
	    $post_content = $_POST['relatorio'];//post_content do post
	    $recepcionista_id = $_POST['recepcionista_id'];
	    if ( isset($_POST['consulta_id']) )  {//id a ser atualizado, se houver
	    	$atualiza_consulta_id = $_POST['consulta_id'];
	    }else{
	    	$atualiza_consulta_id = 0;
	    }


	    //meta dados
	    $campos_input = array('data', 'hora_termino', 'hora_inicio', 'especialista_id', 'paciente_id', 'lista_de_remedios', 'motivo_da_consulta', 'marcar_volta' );
	    // $data      = $_POST['data'];
	    // $hora_termino      = $_POST['hora_termino'];
	    // $hora_inicio      = $_POST['hora_inicio'];
	    // $especialista_id      = $_POST['especialista_id'];
	    // $paciente_id      = $_POST['paciente_id'];
	    // $lista_de_remedios      = $_POST['lista_de_remedios'];
	    // $motivo_da_consulta      = $_POST['motivo_da_consulta'];
	    // $marcar_volta      = $_POST['marcar_volta'];

	    //$post_category = $_POST['cat'];
	    //$image_name=$_FILE['feture_image']['name']; 
	    //$image_url=$_FILE['feture_image']['tmp_name'];

	    $insert_consulta = array(
	          'post_type' => 'consulta', 
	          'post_content' => $post_content, 
	          'post_title' => $post_title,
	          'post_status' => 'publish',
	          'ID' => $atualiza_consulta_id,
	          'post_author' => $recepcionista_id,
	          /*'comment_status' => ,*/
	        );

	    $consulta_id = wp_insert_post($insert_consulta);

	    $post = get_post($consulta_id);// n esta sendo usado

	    // add meta dados a nova cpt_consulta
	    foreach ($campos_input as $campos) {
	    	add_post_meta($consulta_id, $campos, $_POST[$campos]); 
	    }
	    // add_post_meta($consulta_id, 'data', 		 $data);    
	    // add_post_meta($consulta_id, 'especialista_id', 	 $especialista_id);    
	    // add_post_meta($consulta_id, 'paciente_id', 		 $paciente_id);    
	    // add_post_meta($consulta_id, 'lista_de_remedios', $lista_de_remedios);    
	    // add_post_meta($consulta_id, 'motivo_da_consulta',$motivo_da_consulta);    
	    // add_post_meta($consulta_id, 'marcar_volta', 	 $marcar_volta);    

	    //wp_set_object_terms( $consulta_id, array($post_category), '< category_slug_name >' ); 

	    //$upload_dir = wp_upload_dir();
	    //$image_data = file_get_contents($image_url);
	    //$filename = basename($image_url);
	    //if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
	    //else                                    $file = $upload_dir['basedir'] . '/' . $filename;
	    //file_put_contents($file, $image_data);

	    //$wp_filetype = wp_check_filetype($filename, null );
	    // $attachment = array(
	    //     'post_mime_type' => $wp_filetype['type'],
	    //     'post_title' => sanitize_file_name($filename),
	    //     'post_content' => '',
	    //     'post_status' => 'inherit'
	    // );
	    //$attach_id = wp_insert_attachment( $attachment, $file, $consulta_id );
	    //require_once(ABSPATH . 'wp-admin/includes/image.php');
	    //$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	    //$res1= wp_update_attachment_metadata( $attach_id, $attach_data );
	    //$res2= set_post_thumbnail( $consulta_id, $attach_id );
	}      

	
?>      