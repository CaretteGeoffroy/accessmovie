<?php 

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));






require_once('models/realisateur.php');
require_once('models/film.php');



switch ($action) {
    case 'list':
        showList();
        break;
}





function showList(){
    global $twig;
    $result = listerealisateur();
    

    $template = $twig->load('realisateur.html.twig');
    echo $template->render(array('title'=>'Tous les Réalisateurs','realisateurs' => $result));


}