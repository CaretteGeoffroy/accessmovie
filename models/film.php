<?php
    require'models/connection_bdd.php';


    function liste(){
        global $basedonne;

        $sql = "SELECT films.titre,films.annee,films.description,films.image_film, films.bande_annonce, 
        GROUP_CONCAT(DISTINCT genre.type SEPARATOR ', ') AS genre,
        GROUP_CONCAT(DISTINCT realisateur.realisateur SEPARATOR ', ') AS realisateur,
        GROUP_CONCAT(DISTINCT acteur.acteur SEPARATOR ', ') AS acteur
        FROM film_genre 
        INNER JOIN films ON film_genre.film = films.id
        INNER JOIN film_realisateur ON film_realisateur.film = films.id
        INNER JOIN realisateur ON realisateur.id = film_realisateur.realisateur
        INNER JOIN genre ON genre.id = film_genre.genre
        INNER JOIN film_acteur ON film_acteur.film = films.id
        INNER JOIN acteur ON acteur.id = film_acteur.acteur
        GROUP BY films.titre";
        
        $requete = $basedonne->prepare($sql);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }

    function showFilmsByGenre($idgenre){
        global $basedonne;
        $sql = "SELECT films.titre,films.annee,films.description,films.image_film, films.bande_annonce,
        GROUP_CONCAT(DISTINCT genre.type SEPARATOR ', ') AS genre,
        GROUP_CONCAT(DISTINCT realisateur.realisateur SEPARATOR ', ') AS realisateur,
        GROUP_CONCAT(DISTINCT acteur.acteur SEPARATOR ', ') AS acteur
        FROM film_genre 
        INNER JOIN films ON film_genre.film = films.id
        INNER JOIN film_realisateur ON film_realisateur.film = films.id
        INNER JOIN realisateur ON realisateur.id = film_realisateur.realisateur
        INNER JOIN genre ON genre.id = film_genre.genre
        INNER JOIN film_acteur ON film_acteur.film = films.id
        INNER JOIN acteur ON acteur.id = film_acteur.acteur
        WHERE genre.id = :idgenre
        GROUP BY films.titre";
        
        $requete = $basedonne->prepare($sql);
        $requete -> bindParam(':idgenre', $idgenre, PDO::PARAM_INT);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }

    function showFilmsByOneRealisateur($idrealisateur){
        global $basedonne;

        $sql = "SELECT f.id, f.annee, f.bande_annonce, f.description, f.image_film, f.titre, 
        (SELECT GROUP_CONCAT(DISTINCT g.type SEPARATOR ', ')
                     FROM genre g inner JOIN film_genre as fg ON g.id = fg.genre 
                     WHERE fg.film = f.id ) AS genre,
                     
        (SELECT GROUP_CONCAT(DISTINCT r.realisateur SEPARATOR ', ')
                     FROM realisateur as r inner JOIN film_realisateur as fr ON r.id = fr.realisateur  
                     WHERE fr.film = f.id ) AS realisateur,
                     
        (SELECT GROUP_CONCAT(DISTINCT a.acteur SEPARATOR ', ')
                     FROM acteur as a inner JOIN film_acteur as fa ON a.id = fa.acteur  
                     WHERE fa.film = f.id ) AS acteur
        
        
        from films as f 
        inner join film_acteur as fa on fa.film = f.id 
        inner join acteur as a on a.id = fa.acteur 
        inner join film_realisateur as fr on fr.film = f.id 
        inner join realisateur as r on r.id = fr.realisateur 
        inner join film_genre as fg on fg.film = f.id 
        inner join genre as g on g.id = fg.genre 
        where r.id = :idrealisateur
        group by f.id";
        
        $requete = $basedonne->prepare($sql);
        $requete -> bindParam(':idrealisateur', $idrealisateur, PDO::PARAM_INT);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }

    function showFilmsByOneActeur($idacteur){
        global $basedonne;

        $sql = "SELECT f.id, f.annee, f.bande_annonce, f.description, f.image_film, f.titre, 
        (SELECT GROUP_CONCAT(DISTINCT g.type SEPARATOR ', ')
                     FROM genre g inner JOIN film_genre as fg ON g.id = fg.genre 
                     WHERE fg.film = f.id ) AS genre,
                     
        (SELECT GROUP_CONCAT(DISTINCT r.realisateur SEPARATOR ',')
                     FROM realisateur as r inner JOIN film_realisateur as fr ON r.id = fr.realisateur  
                     WHERE fr.film = f.id ) AS realisateur,
                     
        (SELECT GROUP_CONCAT(DISTINCT a.acteur SEPARATOR ', ')
                     FROM acteur as a inner JOIN film_acteur as fa ON a.id = fa.acteur  
                     WHERE fa.film = f.id ) AS acteur
        
        
        from films as f 
        inner join film_acteur as fa on fa.film = f.id 
        inner join acteur as a on a.id = fa.acteur 
        inner join film_realisateur as fr on fr.film = f.id 
        inner join realisateur as r on r.id = fr.realisateur 
        inner join film_genre as fg on fg.film = f.id 
        inner join genre as g on g.id = fg.genre 
        where a.id = :idacteur
        group by f.id";
        
        $requete = $basedonne->prepare($sql);
        $requete -> bindParam(':idacteur', $idacteur, PDO::PARAM_INT);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }

    function showAnnee($idannee){
        global $basedonne;

        $sql = "SELECT films.titre,films.annee,films.description,films.image_film, films.bande_annonce, 
        GROUP_CONCAT(DISTINCT genre.type SEPARATOR ', ') AS genre,
        GROUP_CONCAT(DISTINCT realisateur.realisateur SEPARATOR ', ') AS realisateur,
        GROUP_CONCAT(DISTINCT acteur.acteur SEPARATOR ', ') AS acteur
        FROM film_genre 
        INNER JOIN films ON film_genre.film = films.id
        INNER JOIN film_realisateur ON film_realisateur.film = films.id
        INNER JOIN realisateur ON realisateur.id = film_realisateur.realisateur
        INNER JOIN genre ON genre.id = film_genre.genre
        INNER JOIN film_acteur ON film_acteur.film = films.id
        INNER JOIN acteur ON acteur.id = film_acteur.acteur
        WHERE annee = :idannee
        GROUP BY films.titre 
        ORDER BY annee";
        
        $requete = $basedonne->prepare($sql);
        $requete -> bindParam(':idannee', $idannee, PDO::PARAM_INT);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }



