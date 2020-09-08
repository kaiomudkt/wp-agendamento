<?php 

// Create post object
$consulta = array();
if !($_POST['ID']) {
	$consulta['ID']    = $_POST['ID'];
}
$consulta['post_title']    = 'consulta';
$consulta['post_content']  = 'This is my post.';
$consulta['post_status']   = 'publish';
$consulta['post_author']   = 1;
$consulta['post_category'] = array(0);


if ($_POST['post_title']) {
	$consulta['post_title']    = $_POST['post_title'];
}
if ($_POST['post_content']) {
	$consulta['post_content']  = $_POST['post_content'];
}

if($autor){
	$consulta['post_author']   = 1;
}

if ($_POST['post_category']) {//talvez usar isso para definir a categoria
	$consulta['post_category'] = array(0);
}


if ($_POST['post_status') {// acho que n precisa disso
	$consulta['post_status']   = 'publish';
}
// Insert the post into the database
wp_insert_post( $consulta );
 ?>



