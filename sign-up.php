<?php  
    session_start();
    if(isset($_SESSION["email_admin"]))
    {
    header("location: admin.php");
    }
    elseif (isset($_SESSION["email_agent"])){

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>GÉOPORTAIL || S'AUTHENTIFIER</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Animate.css -->
    <link rel="stylesheet" href="assets/plugins/animate/animate.css">

    <!-- hamburgers.css -->
    <link rel="stylesheet" href="assets/plugins/css-hamburgers/hamburgers.min.css">

    <!-- animsition.css -->
    <link rel="stylesheet" href="assets/plugins/animsition/css/animsition.min.css">

    <!-- Select2.css -->
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">

    <!-- Login css -->
    <link rel="stylesheet" href="assets/css/sign_in.css">
    <link rel="stylesheet" href="assets/css/util.css">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <style>

        .alert {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            border-radius: 0;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            -ms-box-shadow: none;
            box-shadow: none;
            border: none;
            color: #fff !important; 
        }
        .alert .alert-link {
            color: #fff;
            text-decoration: underline;
            font-weight: bold; 
        }
        .alert-danger {
            background-color: #fb483a !important; 
            color: #ffffff;
        }
    </style>

</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="loginForm" method="POST" action="assets/php/login.php" role="form">

                    <div>
                        <center> <img src="assets/images/logo-HCEF.png" alt="" style="width: 260px; height:200px;"></center>
                    </div>

                    <br> <br>

                    <div id="error"></div>
                  
					<div class="wrap-input100 validate-input" data-validate = "Entrez une adresse email valide (abc@def.xyz)">
						<input class="input100" type="text" name="email" id="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email </span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Entrez votre mot de passe">
						<input class="input100" type="password" name="password" id="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Mot de passe</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-10">
						
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100 test"  type="radio" name="admin_ckb" id="admin_ckb" value="admin_ckb" checked>
                            <label class="label-checkbox100" for="admin_ckb">
                                Administrateur
                            </label>
                        </div>

                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100 test" type="radio" name="agent_ckb" value="agent_ckb" id="agent_ckb">
                            <label class="label-checkbox100" for="agent_ckb">
                                Agent
                            </label>
                        </div>

                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100"  type="checkbox" name="rememberme" id="rememberme">
                            <label class="label-checkbox100" for="rememberme">
                                Me souvenir
                            </label>
                        </div>
                        <!-- Mot de passe oublié 
						<div>
							<a href="#" class="txt1">
								Mot de passe oublié ?
							</a>
                        </div>
                        -->
                    </div>
                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        
                    </div>
			
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" id="submitButton">
							Connectez-vous
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Ou
						</span>
					</div>
                    
                    <div class="container-login100-form-btn">
                        <button class="login10-form-btn" type="button" onclick="window.location.href='index.php'">
                            Continuez comme étant un visiteur
                        </button>
                    </div>

				</form>

				<div class="login100-more">
                    <!-- The carousel -->
                    <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#transition-timer-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#transition-timer-carousel" data-slide-to="1"></li>
                            <li data-target="#transition-timer-carousel" data-slide-to="2"></li>
                        </ol>
            
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="assets/images/jbelMoussa.jpg" />
                                <div class="carousel-caption">
                                    <h1 class="carousel-caption-header">Jbel Moussa</h1>
                                    <p class="carousel-caption-text hidden-sm hidden-xs" style="color:white;">
                                        Culminant à 850m d'altitude sur 4000 ha, Jbel Moussa, est un SIBE littoral de priorité 1, c'est un territoir à haut intérêt biologique et géographique
                                        , situé à l'extrimité de la grande dorsale calcaire qui structure toute la région montagneuse du Rif. Aussi appelé "Mont Atlas", Jbel Moussa dispose de nombreuses
                                        ressources naturelles notamment une faune et une flore riches et diversifiées ainsi qu'un grand potentiel culturels et ethnographiques faisant du site
                                        une attraction touristique unique sur la rive occidentale de la mediterranée.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="item">
                                <img src="assets/images/Jebha1.jpg" />
                                <div class="carousel-caption">
                                    <h1 class="carousel-caption-header">Jebha</h1>
                                    <p class="carousel-caption-text hidden-sm hidden-xs" style="color:white;">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim aliquet rutrum. Praesent vitae ante in nisi condimentum egestas. Aliquam.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="item">
                                <img src="assets/images/Talessemetane1.jpg"/>
                                <div class="carousel-caption">
                                    <h1 class="carousel-caption-header">Talessemetane</h1>
                                    <p class="carousel-caption-text hidden-sm hidden-xs" style="color:white;">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim aliquet rutrum. Praesent vitae ante in nisi condimentum egestas. Aliquam.
                                    </p>
                                </div>
                            </div>
                        </div>
                
                        <!-- Controls -->
                        <a class="left carousel-control" href="#transition-timer-carousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#transition-timer-carousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                            
                        <!-- Timer "progress bar" -->
                        <hr class="transition-timer-carousel-progress-bar animate" />
                    </div>
                </div>    
			</div>
		</div>
    </div>
    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- jQuery Validation Form -->
    <script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/moment.min.js"></script>

    <!-- Animsition JS -->
    <script src="assets/plugins/animsition/js/animsition.min.js"></script>

    <!-- Page login JS -->
    <script src="assets/js/login.js"></script>
    <script src="assets/js/carousel.js"></script>

</body>
</html>