<?php 
error_reporting(E_ALL & ~E_NOTICE);
session_start();
?>
<script>
        $("#formulaire").submit(function(event){
            var fichier        = $("#fichier").val();
            var destinataire      = $("#mail_dest").val();
            var expediteur      = $("#mail_exp").val();
            var champs = fichier + destinataire + expediteur
			var alerte = "Merci de remplir tous les champs";
            var alerte_fichier  = "Vous n'avez pas uploadé votre fichier";
			var alerte_dest  = "Vous n'avez pas choisi de destinataire";
			var alerte_exp  = "Vous n'avez pas choisi l'expéditeur";

            if (champs  == "") {
                $("#alerte").html(message);
            } 
			else if (fichier == "") {
                $("#fichier_err").html(alerte_fichier);
            } 
			else if (destinataire == "") {
                $("#fichier_dest_err").html(alerte_dest);
            } 
			else if (expediteur == "") {
                $("#fichier_exp_err").html(alerte_exp);
            }			
			else {
                $.ajax({
                    type : "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success : function(result) {
                        if (result == "error") {
								$('.message').html("Un des champs n'est pas rempli correctement ...");
							}
							else {
								$('.message').html("Fichier envoyé !");
							}
						},
                    error: function() {
                        $("#formulaire").html("<p>Erreur</p>");
                    }
                });
            }

            return false;
        });
</script>