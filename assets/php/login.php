<?php
    session_start();
    include_once("db_connect.php");

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email=='' || $password =''){
        echo 0;
    }
    else{

        $query = "SELECT * FROM admin where email_admin= '$email' and password='$password' ";
        $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

        if (pg_num_rows($result) == 0) {

            echo "Email ou mot de passe incorrecte"; 

        }
        else{
            echo 1;
            /*
            $row=pg_fetch_array($result);
            $_SESSION["id_admin"] = $row["id_admin"];
                
            if(!empty($_POST["rememberme"])) {
                setcookie ("username",$username,time()+ (10 * 365 * 24 * 60 * 60));
                setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
            } else {
                if(isset($_COOKIE["username"])) {
                    setcookie ("username","");
                }
                if(isset($_COOKIE["password"])) {
                    setcookie ("password","");
                }
            }

            $_SESSION['nom']=$row['nom_admin'];
            $_SESSION['prenom']=$row['prenom_admin'];
            $_SESSION['username'] = $username;	*/
            
        }

        pg_free_result($result);

    }

    pg_close($dbconn);
    

    

?>
