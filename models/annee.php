<?php
    require'models/connection_bdd.php';


    function listeannee(){
        global $basedonne;
        $requete = $basedonne->prepare("SELECT films.annee FROM films GROUP BY annee ORDER BY annee DESC");

        $requete->execute();
    
        return $requete->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    function anneeById($id){
        global $basedonne;
        $requete = $basedonne->prepare("SELECT films.annee FROM films WHERE films.annee=:id GROUP BY annee");
        $requete -> bindParam(":id", $id, PDO::PARAM_INT);
        $requete->execute();
    
        return $requete->fetch(PDO::FETCH_ASSOC);
        
    }
