<?php 
/*
	https://developer.wordpress.org/reference/functions/add_role/

	este arquivo é responsável por criar a função de nivel de acesso de usuário que determina quais ações pode e não pode realizar

	atribui funções para cada nova função/capacidade (role/nivel de acesso de user)
	https://wordpress.stackexchange.com/questions/173073/bind-custom-role-to-admin-page/173181
	https://matthewaprice.com/article/wordpress-admin-menu-for-multiple-roles/
	https://wordpress.stackexchange.com/questions/108338/capabilities-and-custom-post-types
*/

add_action('after_setup_theme','add_all_roles');//hook de teste
//add_action('init','add_all_roles');// usar essa hook
function add_all_roles(){
	$capacidades = array(
		'read' => true,
		'edit_posts' => false,
		'delete_posts' => false,
		'publish_posts' => false,
		'upload_files' => true,
	);
	//(pull request)adicionar permissao de comentario
	$lista_acessos_adm = array('edit_consulta', 'edit_consultas', 'edit_other_consultas', 'publish_consultas', 'read_consulta', 'read_private_consultas', 'delete_consulta', 'nivel_de_acesso_paciente', 'nivel_de_acesso_especialista', 'nivel_de_acesso_recepcionista');
	$lista_acessos_paciente = array('publish_consultas', 'read_consulta');
	$lista_acessos_especialista = array('edit_consulta', 'read_consulta', 'read_private_consultas');
	$lista_acessos_recepcionista = array('publish_consultas', 'read_consulta');

	add_gereneric_role('paciente', 'Paciente', $capacidades, 
		'nivel_de_acesso_paciente', $lista_acessos_paciente);
	add_gereneric_role('especialista', 'Especialista', $capacidades, 
		'nivel_de_acesso_especialista', $lista_acessos_especialista);
	add_gereneric_role('recepcionista', 'Recepcionista', $capacidades, 
		'nivel_de_acesso_recepcionista', $lista_acessos_recepcionista);

	//add acessos customizados do cpt-consulta ao super admin
	$roles_adm = get_role('administrator');
	foreach ($lista_acessos_adm as $acesso) {
		$roles_adm->add_cap($acesso);
	}
}

function add_gereneric_role($id, $nome, $argumentos, $nivel_de_acesso_tela, $nivel_de_acesso_consulta){
	add_role($id,$nome,$argumentos);//cria role custom
	$roles = get_role($id);
	$roles->add_cap($nivel_de_acesso_tela);
	foreach ($nivel_de_acesso_consulta as $acesso) {
		$roles->add_cap($acesso);
	}
}
/* remeove os niveis de acessos padroes do wordpress */
remove_role('subscriber');
remove_role('editor');
remove_role('contributor');
remove_role('author');

?>