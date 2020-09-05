<?php 

add_action('admin_menu', 'custom_menu_paciente');
function custom_menu_paciente() { 
	add_menu_page( 
		'opções do paciente', 
		'Área do paciente', 
		'nivel_de_acesso_paciente', 
		'menu_slug_paciente', 
		'page_callback_function_paciente', 
		'dashicons-media-spreadsheet',
		'2'
	);
}


function page_callback_function_paciente(){
?>
	<h1>PACIENTE</h1>
	<h3>Lista de todas as consultas agendadas</h3>
		<ul>
			<li><a>consulta 1</a></li>
			<li><a>consulta 2</a></li>
			<li><a>consulta 3</a></li>
			<li><a>consulta 4</a></li>
			<li><a>consulta 5</a></li>
		</ul>
	<h3>Lista de todas as consultas realizadas</h3>
		<ul>
			<li><a>consulta 1</a></li>
			<li><a>consulta 2</a></li>
			<li><a>consulta 3</a></li>
			<li><a>consulta 4</a></li>
			<li><a>consulta 5</a></li>
		</ul>
	<h3>Lista de todas as áreas de atendimento </h3>
		<ul>
			<li><a>especialidade 1</a></li>
			<li><a>especialidade 2</a></li>
			<li><a>especialidade 3</a></li>
			<li><a>especialidade 4</a></li>
		</ul>

	<h3>Lista de todos os especialista por área</h3>
		<ul>
			<li><a>Especialista 1</a></li>
			<li><a>Especialista 2</a></li>
			<li><a>Especialista 3</a></li>
			<li><a>Especialista 4</a></li>
			<li><a>Especialista 5</a></li>
		</ul>

	<h3>Lista de todos os especialista por área</h3>
		<ul>
			<li><a>horarios disponiveis para este especialista 1</a></li>
			<li><a>horarios disponiveis para este especialista 2</a></li>
			<li><a>horarios disponiveis para este especialista 3</a></li>
			<li><a>horarios disponiveis para este especialista 4</a></li>
			<li><a>horarios disponiveis para este especialista 5</a></li>
		</ul>

	<button>Marcar consulta</button>

	to pensando em criar um formulario aqui
	aonde o paciente insere os dados
	e pego esses dados
	e crio por baixo um post do typo cpt_consulta
	assim o paciente n precisa ter acesso direto ao cpt_consulta,
	que daria muito trabalho pra controlar,

	


	<br>
	<?php echo 'sobre a role: ' ; ?>
	<br>
	<?php var_dump(get_role('administrator')); ?>



	<div class="consulta">
			<h1>Nova Consulta</h1>
			<h1>Consulta nº: 999999</h1>
			<div class="relatorio">
				<div class="meta-options campos">
			        <label for="lista_de_remedios">relatório</label>
			        <textarea id="lista_de_remedios"
			        type="text"
			        name="lista_de_remedios"
			        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lista_de_remedios', true ) ); ?>">
			    	</textarea>
			    </div>
			</div>

			<div class="informacoes">
				<?php require_once("cpt_consulta_form.php"); ?>
			</div>

			<div class="comentarios">
			</div>
	</div><!-- fim consulta -->

<?php } ?>