	<!-- formulario do cpt_consulta para todos os usuarios -->
	<div>
		<form method="POST">
			<h1>Seja bem vindo <?php echo nome_usuario_logado(); ?> | Identificador: <?php echo id_usuario_logado(); ?></h1>
			<h2>Nivel de acesso: <?php echo role_logada(); ?></h2>

			<div class="hcf_box">
			<?php //$cpt_consulta_id = 35; ?>
			<?php $cpt_consulta_id = -1; ?>
			<?php $dados_cpt_consulta = get_post($cpt_consulta_id); ?>
			<?php //var_dump($dados_cpt_consulta); ?>
			
				<?php if ($dados_cpt_consulta && $dados_cpt_consulta->ID): ?>
					<h1>Consulta nº: <?php echo esc_attr($dados_cpt_consulta->ID); ?></h1>
				<?php else: ?>			
					<h1>Agendar nova Consulta</h1>
				<?php endif; ?>

				<div>
					<label>Data e hora da consulta</label>
					<input type="datetime-local" name="data_hora">
				</div>

				<div class="meta-options campos">
			        <label for="relatorio">Relatório do atendimento</label>
			        <textarea type="text" name="relatorio">
			        	<?php if ($dados_cpt_consulta && $dados_cpt_consulta->post_content): ?>
			        		<?php echo esc_attr( $dados_cpt_consulta->post_content ); ?>
			        	<?php else: ?>
			        		insira relatorio...
			        	<?php endif; ?>
			    	</textarea>
			    </div>

			    <div class="meta-options campos">
			        <label for="especialista">Especialista (ID)</label>
			        <input id="especialista" 
			            type="text"
			            name="especialista"
			            <?php
			        if ($dados_cpt_consulta) :
		        		//echo 'readonly="true"';
			        	$especialista =  esc_attr(get_post_meta( $dados_cpt_consulta->ID, 'especialista', true ) ); 
				        if ($especialista) :
				        	echo 'value="$especialista"';
				        else:
			        		echo 'value="consulta sem especialista"';
			        	endif;
		        	else:
		        		echo 'value="id especialista"';
			        endif;
		        	if (!role_logada() == 'recepcionista' || !role_logada() == 'administrator') {
		        		echo 'readonly';
	        		}
			        ?>
			        ><!-- fecha input -->
			    </div>

			    <div class="meta-options campos">
			        <label for="paciente">Paciente (ID)</label>
			        <input id="paciente"
			        type="text"
			        name="paciente"
			        <?php
			        if ($dados_cpt_consulta) :
		        		//echo 'readonly="true"';
			        	$paciente =  esc_attr(get_post_meta( $dados_cpt_consulta->ID, 'paciente', true ) ); 
				        if ($paciente) :
				        	echo 'value="$paciente"';
				        else:
			        		echo 'value="consulta sem paciente"';
			        	endif;
		        	else:
		        		echo 'value="id paciente"';
			        endif;
			        if (!role_logada() == 'recepcionista' || !role_logada() == 'administrator') {
		        		echo 'readonly';
	        		}
			        ?>
			        ><!-- fecha input -->
			    </div>

		    	<div class="meta-options campos">
			        <label for="lista_de_remedios">Lista de remedios</label>
			        <input id="lista_de_remedios"
			        type="text"
			        name="lista_de_remedios"
			        <?php if ($dados_cpt_consulta): ?>
			        	<?php $lista_de_remedios = esc_attr( get_post_meta( get_the_ID(), 'lista_de_remedios', true ) ); ?>
			        	<?php if ($lista_de_remedios): ?>
				        	value="<?php echo $lista_de_remedios; ?>"
			        	<?php endif; ?>
		        	<?php else: ?>
		        		value="lista de remedios"
		            <?php endif; ?>
			        <?php if (role_logada() != 'especialista') {
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
		        	<?php else: ?>
		        		value="Motivo da consulta"
			        <?php endif; ?>
			         ><!-- fim input-->
			    </div>

			    <div class="meta-options campos">
			        <label for="marcar_volta">Marcar volta (dd/mm/yyyy hh:mm)</label>
			        <input 
			        type="datetime-local"
			        name="marcar_volta"
			        <?php if ($dados_cpt_consulta): ?>
			        	<?php $voltar = esc_attr( get_post_meta( $dados_cpt_consulta->ID, 'marcar_volta', true ) ); ?>
			        		<?php if ($voltar): ?>
			        			value="<?php echo $voltar; ?>"
			        		<?php endif ?>
		        	<?php else: ?>
		        			value="dd/mm/yyyy hh:mm"
			        <?php endif ?>
			        ><!-- fim input-->
			    </div>

			    <!-- (essa consulta ja foi realizada) ? true : false
					essa campo vai ajudar a listar consultar a ser realizada
			     -->
		        <div>
		        	<input  readonly="true"
			        type="hidden"
			        name="consulta_realizada"
			    <?php if ($dados_cpt_consulta): ?>
			        value="true"
		        <?php else: ?>
			        value="false"
			    <?php endif; ?>
			        ><!-- fim input-->
		        </div>

		        <div> <!-- categorias -->
		        	 <?php //wp_dropdown_categories('orderby=name&hide_empty=0&exclude=1&hierarchical=1&taxonomy=< taxonomy name >&post_type=< post_type >'); ?>
		        </div>

				<div class="comentarios">
					comentarios
				</div>

				<input class="subput round" type="submit" name="submit" value="Agendar consulta"/>
			</div>
		</form>
	</div>

	<?php 
	/*recebe dados do formulario*/
	if(isset($_POST['submit'])) {

	    $post_title   = $_POST['paciente'].' - '.$_POST['especialista'];
	    $post_content = $_POST['relatorio'];//post_content do post

	    //meta dados
	    $data_hora      = $_POST['data_hora'];
	    $especialista_id      = $_POST['especialista_id'];
	    $paciente_id      = $_POST['paciente_id'];
	    $lista_de_remedios      = $_POST['lista_de_remedios'];
	    $motivo_da_consulta      = $_POST['motivo_da_consulta'];
	    $marcar_volta      = $_POST['marcar_volta'];

	    //$post_category = $_POST['cat'];
	    //$image_name=$_FILE['feture_image']['name']; 
	    //$image_url=$_FILE['feture_image']['tmp_name'];

	    $insert_consulta = array(
	          'post_type' => 'consulta', 
	          'post_content' => $post_content, 
	          'post_title' => $post_title,
	          'post_status' => 'publish'
	        );

	    $consulta_id = wp_insert_post($insert_consulta);

	    $post = get_post($consulta_id);// n esta sendo usado

	    // add meta dados a nova cpt_consulta
	    add_post_meta($consulta_id, 'data_hora', 		 $data_hora);    
	    add_post_meta($consulta_id, 'especialista_id', 	 $especialista_id);    
	    add_post_meta($consulta_id, 'paciente_id', 		 $paciente_id);    
	    add_post_meta($consulta_id, 'lista_de_remedios', $lista_de_remedios);    
	    add_post_meta($consulta_id, 'motivo_da_consulta',$motivo_da_consulta);    
	    add_post_meta($consulta_id, 'marcar_volta', 	 $marcar_volta);    

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
?>      