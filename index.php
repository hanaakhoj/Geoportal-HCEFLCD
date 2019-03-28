<?php
session_start(); 
include 'assets/php/db_connect.php';
/*
if(!isset($_SESSION["username"]))
{
 header("location:login/sign-in.php");

}
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>GÉOPORTAIL</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome CSS -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
   
    <!-- Modal d'authentification -->
    <link rel="stylesheet" href="assets/css/login_modal.css">

    <!-- Leaflet Plugin -->
    <link href="assets/plugins/leaflet/leaflet.css" rel="stylesheet" type="text/css" />
    
    <!-- Menu de navigation (Leaflet)-->
    <link href="assets/plugins/leaflet-navbar/Leaflet.NavBar.css" rel="stylesheet" type="text/css" />

    <!-- zoom min-->
    <link href="assets/plugins/leaflet-zoom-min/L.Control.ZoomMin.css" rel="stylesheet" type="text/css" />

    <!-- La loupe-->
    <link href="assets/plugins/Leaflet.MagnifyingGlass/leaflet.magnifyingglass.css" rel="stylesheet" type="text/css"  />
    <link rel="stylesheet" href="assets/css/Control.MagnifyingGlass.css" />
    
    <!--Minimap (Overview)-->
    <link rel="stylesheet" href="assets/plugins/leaflet.layerscontrol-minimap/control.layers.minimap.css">
    <link rel="stylesheet" href="assets/plugins/Leaflet-MiniMap/src/Control.MiniMap.css">
    
    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link rel="stylesheet" href="assets/plugins/leaflet-esri/dist/esri-leaflet-geocoder.css">

    <!--Mouse Position-->
    <link rel="stylesheet" href="assets/plugins/libs/L.Control.MousePosition.css"/>

    <!--Localisation-->
    <link rel="stylesheet" href="assets/plugins/libs/L.Control.Locate.min.css"/>
    
    <!-- Context Menu -->
    <link rel="stylesheet" href="assets/plugins/libs/leaflet.contextmenu.css"/>

    <!-- Outils de dessin -->
    <link rel="stylesheet" href="assets/plugins/leaflet-draw/dist/leaflet.draw-src.css"/>

    <!-- Boite à outils de dessin -->
    <link rel="stylesheet" href="assets/plugins/leaflet-draw-toolbar/dist/leaflet.draw-toolbar.css">

    <!-- Boite à outils -->
    <link rel="stylesheet" href="assets/plugins/leaflet-toolbar/dist/leaflet.toolbar.css">

    <!-- ColorPicker -->
    <link rel="stylesheet" href="assets/plugins/colorpicker/ColorPicker.js">

    <!-- Géosignets (Bookmarks) -->
    <link rel="stylesheet" href="assets/plugins/Leaflet.Bookmarks/dist/leaflet.bookmarks.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="assets/plugins/animate/animate.css">
    
    <!-- Map.css -->
    <link rel="stylesheet" href="assets/css/map.css">

    <!-- Module du Jbel Moussa -->
    <link rel="stylesheet" href="assets/css/jbelMoussa.css">

    <!-- Responsive Leaflet Popup CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-responsive-popup@0.6.3/leaflet.responsive.popup.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-responsive-popup@0.6.3/leaflet.responsive.popup.rtl.css" />

    
		
</head>

<body class="adminbody">

    <div id="main">

        <!-- top bar navigation -->
        <div class="headerbar">

            <!-- LOGO -->
            <div class="headerbar-left">
                <a href="index.html" class="logo"><img alt="Logo" src="assets/images/logo.png" /> <span>Eaux et forêts</span></a>
            </div>

            <nav class="navbar-custom">
                    <ul class="list-inline float-right mb-0">

                        <li class="list-inline-item dropdown notif">
                            <a id="login" class="nav-link nav-user" data-toggle="modal" data-target="#loginModal" tabindex="-1" role="dialog">
                                <i class="fas fa-sign-in-alt"></i>
                            </a>
                           
                        </li>

                    </ul>
                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </li>                        
                </ul>
            </nav>

        </div>
        <!-- End Navigation -->
        
        <div class="content-page">
        
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="breadcrumb-holder">
                                <h1 class="main-title float-left">GÉNÉRALITÉS</h1>
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item">ACCEUIL</li>
                                    <li class="breadcrumb-item active">GÉNÉRALITÉS</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>	

                    <!-- MAP -->
                    <div class="row">			
                        <div id="map" ></div> 
                    </div>
                    <!-- /MAP -->
                </div>
            </div>
            <!-- /END content -->
        </div>
            <!-- END content-page -->
            
        <!-- Left Sidebar -->
        <div class="left main-sidebar">
        
            <div class="sidebar-inner leftscroll">

                <div id="sidebar-menu">
            
                    <ul>
                        <li class="submenu">
                                <a class="active" href="index.html"><i class="fa fa-fw fa-area-chart"></i><span>Généralités</span> </a>
                        </li>

                        <li class="submenu">
                            <a  href="#"><i class="fas fa-map-marked-alt"></i></i><span> Zones protégées </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">

                                <?php 
                                // Exécution de la requête SQL
                                $query = 'select id_aireprotegee, nom from aire_protegee;';
                                $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
                                while ($row=pg_fetch_row($result)) { 
                                
                                ?>
								<li>
                                    <a href="#" id="<?php echo $aireprotegee =$row[0]; ?>" class="aireprotegee"><?php  echo $row[1] ?> <span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><a href="#" id="<?php echo $culturel =$row[0]; ?>" class="culturel"><span>Domaines d'intérêts</span></a></li>
                                        <li><a href="#"><span>Faune</span></a></li>
                                        <li><a href="#"><span>Flore</span></a></li>
                                        <li><a href="#"><span>Cours d'eaux</span></a></li>
                                    </ul>
                                </li>

                                <?php } ?>

							</ul>
                        </li>

                        <li class="submenu">
                            <a  href="#"><i class="fas fa-satellite"></i><span> Données satellitaires </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
                                <li><a href="#">Végétation</span></a></li>
                                <li><a href="#">Glissements de terrain</span></a></li>
                                <li><a href="#">Zones humides</span></a></li>
							</ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Modal : Login -->
        <div id="loginModal" class="modal fade animated zoomIn" role="dialog">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="avatar">
                            <i class="fas fa-user-shield fa-4x" style="color:white;"></i>
                        </div>				
                        <h4 class="modal-title"> Administrateur</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="/examples/actions/confirmation.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Email" required="required">		
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required="required">	
                            </div>        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">S'authentifier</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#">Mot de passe oublié?</a>
                    </div>
                </div>
            </div>
        </div> 

        <!-- Modals : Visualisation des domaines d'intérêts  -->
        <div id="culturelModal" class="modal fade animated zoomIn">
          <div class="modal-dialog .modal-dialog-centered" role="document" style="height: 80%;">
            <div class="modal-content" style="height: 80%;">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Domaines d'intérêts</h4>
                </div>
                <br>
                <div class="modal-body" id="bodyCulturel" style="max-height: calc(100% - 120px); overflow-y: scroll;">
                <div class="table-responsive" id="table_culturel"></div>  
                
                </div>
                <br> <br> <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <span class="text-right">
            2019 &copy; <a target="_blank" href="http://www.eauxetforets.gov.ma/fr/index.aspx">Haut Commissariat aux Eaux et Forêts et à la Lutte Contre la Désertification	
            </a>
            </span>
        </footer>

    </div>

    <!-- Bibliothèques et scripts JS -->

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- jQuery Nice scroll bar -->
    <script src="assets/plugins/jquery.nicescroll/jquery.nicescroll.js"></script>
    <script>
        $(document).ready(function(){

            $(".main-sidebar").niceScroll({
                scrollspeed: 20,
                cursorcolor:"#b6dc3b",
            });

        });
        
    </script>

    <!-- BlockUI pour les opérations AJAX -->
    <script src="assets/js/jquery.blockUI.js"></script>

    <!-- ScrollBar -->
    <script src="assets/js/jquery.nicescroll.js"></script>

    <!-- Leaflet JS -->
    <script src="assets/plugins/leaflet/leaflet.js"></script>
    
    <!-- Menu de navigation (Leaflet) -->
    <script src="assets/plugins/leaflet-navbar/Leaflet.NavBar.js"></script>

    <!-- Zoom min -->
    <script src="assets/plugins/leaflet-zoom-min/L.Control.ZoomMin.js"></script>

    <!-- Mini map -->
    <script src="assets/plugins/Leaflet-MiniMap/src/Control.MiniMap.js"></script>

    <!-- Esri Leaflet JS  -->
    <script src="assets/plugins/leaflet-esri/dist/esri-leaflet.js"></script>

    <!-- Esri Leaflet Geocoder -->
    <script src="assets/plugins/leaflet-esri/dist/esri-leaflet-geocoder.js"></script>
    
    
    <!-- Google maps base layers js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByA8CDtyo9mQFAlXCRcncQ-t9Kmdt0yTI" async defer></script>
    <script type="text/javascript" src="assets/plugins/Leaflet.GridLayer.GoogleMutant/Leaflet.GoogleMutant.js"></script>
    
    <script src="assets/plugins/leaflet.layerscontrol-minimap/L.Control.Layers.Minimap.js"></script>

    <script src="assets/plugins/libs/L.Control.Locate.js"></script> 

    <!-- Coordonnées géographiques -->
    <script src="assets/plugins/libs/L.Control.MousePosition.js"></script>

    <!-- La loupe JS -->
    <script src="assets/plugins/Leaflet.MagnifyingGlass/leaflet.magnifyingglass.js"></script>
    <script src="assets/js/Control.MagnifyingGlass.js"></script>
    
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>

    <!-- Menu : Clique droit-->
    <script src="assets/plugins/libs/leaflet.contextmenu.js"></script>

    <!-- Boite à outils -->
    <script src="assets/plugins/leaflet-toolbar/dist/leaflet.toolbar-src.js"></script>

    <!-- Outils de dessin -->
    <script src="assets/plugins/leaflet-draw/dist/leaflet.draw-src.js"></script>

    <!-- Boite à outils de dessin -->
    <script src="assets/plugins/leaflet-draw-toolbar/dist/leaflet.draw-toolbar.js"></script>

    <!-- ColorPicker -->
    <script src="assets/plugins/colorpicker/ColorPicker.js"></script>

    <!-- Géosignets (Bookmarks) -->
    <script src="assets/plugins/Leaflet.Bookmarks/dist/Leaflet.Bookmarks.js"></script>

    <!-- Template js -->
    <script src="assets/js/pikeadmin.js"></script>

    <!-- Responsive Leaflet Popup JS-->
    <script src="https://unpkg.com/leaflet-responsive-popup@0.6.3/leaflet.responsive.popup.js"></script>

    <!-- Map js -->
    <script src="assets/js/map.js"></script>

    <!-- Modules : Zones protégées JS -->
    <script src="assets/js/culturel.js"></script>

    <?php 
    //pg_free_result($result);
    pg_close($dbconn);
    ?>
    
</body>
</html>