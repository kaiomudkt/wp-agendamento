<?php 
/*
https://developer.wordpress.org/reference/functions/add_role/

	este arquivo é responsável por criar a função de nivel de acesso de usuário que determina quais ações pode e não pode realizar

	atribui funções para cada nova função/capacidade (role/nivel de acesso de user)
	https://wordpress.stackexchange.com/questions/173073/bind-custom-role-to-admin-page/173181
*/

add_action('init','add_all_roles');
function add_all_roles(){
	$capacidades = array(
		'read' => true,
		'edit_posts' => false,
		'delete_posts' => false,
		'publish_posts' => false,
		'upload_files' => true,
	);
	add_gereneric_role('paciente', 'Paciente', $capacidades, 
		'nivel_de_acesso_paciente');
	add_gereneric_role('especialista', 'Especialista', $capacidades, 
		'nivel_de_acesso_especialista');
	add_gereneric_role('recepcionista', 'Recepcionista', $capacidades, 
		'nivel_de_acesso_recepcionista');
}

function add_gereneric_role($id, $label, $array, $acesso){
	//$role = add_role($id,$label,$array);
	add_role($id,$label,$array);
	$role = get_role($id);
	$role->add_cap($acesso);
}
?>