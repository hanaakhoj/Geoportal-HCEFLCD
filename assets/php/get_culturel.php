<?php
    header("Access-Control-Allow-Origin: *");

    session_start();

    //Connecter à la base de données
    include_once('db_connect.php');

    //Identifiant de l'aire protégée :
    $id_aireprotegee = $_POST['id_aireprotegee'];

    //Récupérer les aires protégées sous formats GeoJSON
    $query = "SELECT culturel.id_culturel, culturel.nom_culturel FROM culturel, aireprotegee_culturel WHERE culturel.id_culturel=aireprotegee_culturel.id_culturel and aireprotegee_culturel.id_aireprotegee='$id_aireprotegee';";
    $result = pg_query($query);

    if($result){

        $data = array();

        while ($row = pg_fetch_object($result)){

            $data[]=$row;
        }

        // Codage des intitulés des domaines d'intérêts en UTF-8
        echo json_encode($data);

        //echo 1;

    }

    // Libèrer le résultat
    pg_free_result($result);

    // Fermer la connexion
    pg_close($dbconn);

?>