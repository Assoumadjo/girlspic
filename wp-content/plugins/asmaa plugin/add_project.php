<?php

//define(PLUGIN_PATH, plugin_dir_path( __FILE__ ));
//
//include_once('asmaa-plugin.php');

$titre=$_POST['projet_title'];
echo $titre;
function ajouter()
 {
add_post_type_support( 'projet', array(
				$titre ));
}
add_action( 'init', 'ajouter' );
?>
