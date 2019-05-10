<?php
    require'models/connection_bdd.php';


    function listerealisateur(){
        global $basedonne;
        $requete = $basedonne->prepare("SELECT realisateur.realisateur, realisateur.id, realisateur.image_realisateur FROM realisateur");

        $requete->execute();
    
        return $requete->fetchAll(PDO::FETCH_ASSOC);
        
    }

    function realisateurById($id){
        global $basedonne;
        $requete = $basedonne->prepare("SELECT realisateur.realisateur, realisateur.id, realisateur.image_realisateur FROM realisateur WHERE realisateur.id=:id");
        $requete -> bindParam(":id", $id, PDO::PARAM_INT);
        $requete->execute();
    
        return $requete->fetch(PDO::FETCH_ASSOC);
        
    }
    
