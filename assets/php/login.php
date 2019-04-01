<?php
    session_start();
    include_once("db_connect.php");

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email=='' || $password ==''){
        echo 0;
    }
    else{
        if (!empty($_POST["admin_ckb"])) {
            $query = "SELECT * FROM admin where email_admin= '$email' and password='$password' ";
            $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

            if (pg_num_rows($result) == 0) {

                echo "Email ou mot de passe incorrecte"; 

            }
            else{
                echo 1;
                
                $row=pg_fetch_array($result);
                $_SESSION["id_admin"] = $row["id_admin"];
                    
                if(!empty($_POST["rememberme"])) {
                    setcookie ("email",$email,time()+ (10 * 365 * 24 * 60 * 60));
                    setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
                } else {
                    if(isset($_COOKIE["email"])) {
                        setcookie ("email","");
                    }
                    if(isset($_COOKIE["password"])) {
                        setcookie ("password","");
                    }
                }

                $_SESSION['nom']=$row['nom_admin'];
                $_SESSION['prenom']=$row['prenom_admin'];
                $_SESSION['email_admin'] = $email;	
                
            }
            pg_free_result($result);
        }

        else {
            $query = "SELECT * FROM agent where email_agent= '$email' and password_agent='$password' ";
            $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

            if (pg_num_rows($result) == 0) {

                echo "Email ou mot de passe incorrecte"; 

            }
            else{
                echo 2;
                $row=pg_fetch_array($result);
                $_SESSION["id_agent"] = $row["id_agent"];
                    
                if(!empty($_POST["rememberme"])) {
                    setcookie ("email",$email,time()+ (10 * 365 * 24 * 60 * 60));
                    setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
                } else {
                    if(isset($_COOKIE["email"])) {
                        setcookie ("email","");
                    }
                    if(isset($_COOKIE["password"])) {
                        setcookie ("password","");
                    }
                }

                $_SESSION['nom']=$row['nom_agent'];
                $_SESSION['prenom']=$row['prenom_agent'];
                $_SESSION['email_agent'] = $email;	
            }
            pg_free_result($result);

        }
            
    }

    pg_close($dbconn);
    

    

?>
