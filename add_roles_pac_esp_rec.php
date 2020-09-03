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

	$roles = get_role('administrator');

	$roles->add_cap('nivel_de_acesso_paciente');
	$roles->add_cap('nivel_de_acesso_especialista');
	$roles->add_cap('nivel_de_acesso_recepcionista');
	$roles->add_cap('nivel_de_acesso_consulta');
	$roles->add_cap( 'edit_consulta' ); 
    $roles->add_cap( 'edit_consultas' ); 
    $roles->add_cap( 'edit_other_consultas' ); 
    $roles->add_cap( 'publish_consultas' ); 
    $roles->add_cap( 'read_consulta' ); 
    $roles->add_cap( 'read_private_consultas' ); 
    $roles->add_cap( 'delete_consulta' ); 
}

function add_gereneric_role($id, $nome, $argumentos, $nivel_de_acesso){
	//$roles = add_role($id,$nome,$argumentos);
	add_role($id,$nome,$argumentos);
	$roles = get_role($id);

	$roles->add_cap($nivel_de_acesso);
	$roles->add_cap('nivel_de_acesso_consulta');
	$roles->add_cap( 'edit_consulta' ); 
    $roles->add_cap( 'edit_consultas' ); 
    $roles->add_cap( 'edit_other_consultas' ); 
    $roles->add_cap( 'publish_consultas' ); 
    $roles->add_cap( 'read_consulta' ); 
    $roles->add_cap( 'read_private_consultas' ); 
    $roles->add_cap( 'delete_consulta' ); 
}
?>