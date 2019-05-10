<?php 

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));






require_once('models/film.php');
require_once('models/genre.php');
require_once('models/acteur.php');
require_once('models/realisateur.php');
require_once('models/annee.php');


switch ($action) {
    case 'list':
        showList();
        break;
        case 'genre':
        showListbyGenre();
        break;
        case 'realisateur':
        showListByOneRealisateur();
        break;
        case 'acteur':
        showListByOneActeur();
        break;
        case 'annee':
        showListAnnee();
        break;
}





function showList(){
    global $twig, $baseurl;
    $films = liste();
    $genres = listeGenre();
    
    $template = $twig->load('film.html.twig');
    echo $template->render( array('title'=>'Tous les Films', 'films' => $films, 'genres' => $genres, 'baseurl' => $baseurl) );

}

function showListbyGenre(){
    global $twig, $id, $baseurl;
    $films = showFilmsByGenre($id);
    $genres = listeGenre();
    

    $template = $twig->load('film.html.twig');
    echo $template->render( array( 'films' => $films, 'genres' => $genres, 'baseurl' => $baseurl) );

}

function showListByOneRealisateur(){
    global $twig, $id, $baseurl;
    $films = showFilmsByOneRealisateur($id);
    $realisateur = realisateurById($id);
    

    $template = $twig->load('film.html.twig');
    echo $template->render( array( 'showrealisateur'=>$realisateur["realisateur"].' a réalisé le(s) film(s) ci-dessous', 'returnreal'=>'<i class="fas fa-arrow-circle-left"></i> Retourner en arrière', 'films' => $films, 'baseurl' => $baseurl) );

}

function showListByOneActeur(){
    global $twig, $id, $baseurl;
    $films = showFilmsByOneActeur($id);
    $acteur = acteurById($id);
    $titre = $acteur["acteur"].' a joué dans le(s) film(s) ci-dessous';

    $template = $twig->load('film.html.twig');
    echo $template->render( array('showacteur'=> $titre, 'returnacteur'=>'<i class="fas fa-arrow-circle-left"></i> Retourner en arrière', 'films' => $films, 'baseurl' => $baseurl) );

}

function showListAnnee(){
    global $twig, $id, $baseurl;
    $films = showAnnee($id);
    $annee = anneeById($id);
    

    $template = $twig->load('film.html.twig');
    echo $template->render( array('showannee'=>'Le(s) film(s) ci-dessous est/sont sorti(s) en '.$annee["annee"], 'returnannee'=>'<i class="fas fa-arrow-circle-left"></i> Retourner en arrière', 'films' => $films, 'baseurl' => $baseurl) );

}


