<?php
    require'models/connection_bdd.php';


    function listeacteur(){
        global $basedonne;
        $requete = $basedonne->prepare("SELECT acteur.acteur, acteur.id, acteur.image_acteur FROM acteur");

        $requete->execute();
    
        return $requete->fetchAll(PDO::FETCH_ASSOC);
        
    }

    function acteurById($id){
        global $basedonne;
        $requete = $basedonne->prepare("SELECT acteur.acteur, acteur.id, acteur.image_acteur FROM acteur WHERE acteur.id=:id");
        $requete -> bindParam(":id", $id, PDO::PARAM_INT);
        $requete->execute();
    
        return $requete->fetch(PDO::FETCH_ASSOC);
        
    }
    
    
