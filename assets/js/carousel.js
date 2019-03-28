$(document).ready(function() {  

    //Evénements qui réinitialisent et redémarrent l'animation du minuteur lorsque les diapositives changent
    $("#transition-timer-carousel").on("slide.bs.carousel", function(event) {

        //La classe d'animation est supprimée pour revenir directement à 0%
        $(".transition-timer-carousel-progress-bar", this)
            .removeClass("animate").css("width", "0%");
    }).on("slid.bs.carousel", function(event) {
        //La transition des diapositives étant terminée, on ajoute de nouveau la classe animate 
        //afin que la barre de la minuterie prenne du temps à se remplir.
        $(".transition-timer-carousel-progress-bar", this)
            .addClass("animate").css("width", "100%");
    });
    
    //On lance l'animation de la diapositive initiale lorsque le document est prêt
    $(".transition-timer-carousel-progress-bar", "#transition-timer-carousel")
        .css("width", "100%");
});