<?php 

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));






require_once('models/annee.php');
require_once('models/film.php');



switch ($action) {
    case 'list':
        showList();
        break;
}





function showList(){
    global $twig;
    $result = listeannee();
    
    $template = $twig->load('annee.html.twig');
    echo $template->render(array('title'=>'Toutes les années','annees' => $result));


}