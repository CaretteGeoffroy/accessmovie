<?php
    require'models/connection_bdd.php';


    function listeGenre(){
        global $basedonne;
        $sql = "SELECT g.id, g.type FROM genre AS g";
        
        $requete = $basedonne->prepare($sql);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
        
    }