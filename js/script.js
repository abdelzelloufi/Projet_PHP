$(function () { 
    // Code à exécuter lorsque le DOM est complètement chargé (équivalent à $(document).ready())

    $('#contact-form').submit(function(e) {
        // Capture l'événement de soumission du formulaire (formulaire ayant l'ID 'contact-form')
        
        e.preventDefault(); 
        // Empêche le comportement par défaut du formulaire (qui est de recharger la page lors de l'envoi)

        $('.comment').empty(); 
        // Vide tous les éléments avec la classe 'comment' (efface les anciens messages d'erreur s'il y en a)

        var postdata = $('#contact-form').serialize(); 
        // Récupère les données du formulaire sous forme de chaîne de texte en vue de l'envoyer via AJAX

        $.ajax({
            type: 'POST', // Méthode d'envoi (POST)
            url: 'php/contact.php', // URL du fichier serveur qui va traiter la requête
            data: postdata, // Données à envoyer (les champs du formulaire)
            dataType: 'json', // Type de retour attendu du serveur (ici JSON)

            success: function(result) { 
                // Fonction de callback exécutée en cas de succès de la requête AJAX

                if(result.isSuccess) { 
                    // Si le serveur renvoie 'isSuccess' comme vrai (le formulaire est validé côté serveur)
                    
                    $('#contact-form').append("<p class='thank you'>Votre message a bien été envoyé. Merci de m'avoir contacté ;)</p>");
                    // Ajoute un message de remerciement sous le formulaire
                    
                    $('#contact-form')[0].reset(); 
                    // Réinitialise les champs du formulaire
                }
                else {
                    // Si des erreurs sont renvoyées par le serveur (ex. les validations ont échoué)

                    $("#firstname + .comment").html(result.firstnameError);
                    // Affiche l'erreur associée au champ 'firstname' à l'emplacement prévu (juste après l'élément avec l'ID 'firstname')

                    $("#name + .comment").html(result.nameError); 
                    // Affiche l'erreur associée au champ 'name'

                    $("#email + .comment").html(result.emailError); 
                    // Affiche l'erreur associée au champ 'email'

                    $("#phone + .comment").html(result.phoneError); 
                    // Affiche l'erreur associée au champ 'phone'

                    $("#message + .comment").html(result.messageError); 
                    // Affiche l'erreur associée au champ 'message'
                }
            }
        });

    });

});
