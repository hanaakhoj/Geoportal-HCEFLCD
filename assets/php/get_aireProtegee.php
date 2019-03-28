<?php
    header("Access-Control-Allow-Origin: *");
    session_start();

    //Connecter à la base de données
    include_once('db_connect.php');

    //Récupérer les aires protégées sous formats GeoJSON
    $query = "SELECT id_aireprotegee, nom, province, ccdrf, secteur, designat, desig_type, zo_humide, domaine, delim, surf_total as surface, ST_AsGeoJSON(geom) as geom FROM aire_protegee;";
    $result = pg_query($query);

    if($result){
        $feature = array();
        while ($row = pg_fetch_assoc($result)) {

            $type = '"type": "Feature"';
            $geometry = '"geometry": '.$row['geom'];
            unset($row['geom']);
            $properties = '"properties": '.json_encode($row);
            $feature[] = '{'.$type.', '.$geometry.', '.$properties.'}';
        }

        $header = '{"type": "FeatureCollection", "features": [';
        $footer = ']}';
        if(count($feature) > 0) {
            echo $header.implode(', ', $feature).$footer;
        }
        else {
            echo '{"type":"FeatureCollection", "features":"empty"}';
        }
    }

    // Libèrer le résultat
    pg_free_result($result);

    // Fermer la connexion
    pg_close($dbconn);

?>