// Variable globale 
var id_aireprotegee;

$(document).ready(function(){
    
    $(".culturel").click(function(){

        // Affichage du modal :
        $("#culturelModal").modal();

        // Création d'une table : 
        $("#bodyCulturel").html('<table class="table table-bordered jambo_table table-striped table-hover dataTable js-exportable" id="table_culturel" ><tbody></tbody></table>');

        //Récupérer l'identifiant de l'aire protégée séléctionnée :
        id_aireprotegee = $(this).attr("id");


    });

    $("#culturelModal").on('shown.bs.modal', function() {
        
        //Récupérer les domaines d'intérêts pour l'aire protégée déjà séléctionnée par l'utilisateur
        get_culturel(id_aireprotegee);

        //NiceScroll 
        $('.modal-body').niceScroll({
            scrollspeed: 20,
            cursorcolor:"#b6dc3b",
        });

    });

});

// Fonction qui permet de récupérer les domaines d'intérêts selon l'identifiant de l'aire protégée :

function get_culturel(id_aireprotegee) {

    var url = "assets/php/get_culturel.php";
    
    $.ajax({
        url: url,
        type: 'POST',
        dataType: "json",
        data: { id_aireprotegee: id_aireprotegee },
        success: function(data) {

            $.each(data, function(i, field) {

                var nom_culturel = field.nom_culturel;
                
                $("#table_culturel").append("<tr><td>"+nom_culturel+"</td></tr>");
                     
            });
               
        }
    });
}
