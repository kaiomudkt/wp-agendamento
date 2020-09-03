<?php 
/*
https://developer.wordpress.org/reference/functions/add_role/

	este arquivo é responsável por criar a função de nivel de acesso de usuário que determina quais ações pode e não pode realizar

	atribui funções para cada nova função/capacidade (role/nivel de acesso de user)
	https://wordpress.stackexchange.com/questions/173073/bind-custom-role-to-admin-page/173181
	https://matthewaprice.com/article/wordpress-admin-menu-for-multiple-roles/
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
		'manage_categories' => true,
		/*'custom_cap' => true,*/
		/*'manage_capabilities' => true,*/
	);
	add_gereneric_role('paciente', 'Paciente', $capacidades, 
		'nivel_de_acesso_paciente');
	add_gereneric_role('especialista', 'Especialista', $capacidades, 
		'nivel_de_acesso_especialista');
	add_gereneric_role('recepcionista', 'Recepcionista', $capacidades, 
		'nivel_de_acesso_recepcionista');

	$role = get_role('administrator');
	$role->add_cap('nivel_de_acesso_paciente');
	$role->add_cap('nivel_de_acesso_especialista');
	$role->add_cap('nivel_de_acesso_recepcionista');
	$role->add_cap('nivel_de_acesso_consulta');
}

function add_gereneric_role($id, $nome, $argumentos, $nivel_de_acesso){
	//$role = add_role($id,$nome,$argumentos);
	add_role($id,$nome,$argumentos);
	$role = get_role($id);
	$role->add_cap($nivel_de_acesso);
	$role->add_cap('nivel_de_acesso_consulta');

}
?>