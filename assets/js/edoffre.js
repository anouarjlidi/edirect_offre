/**
 * Created by edirect on 05/11/2015.
 */
var step = 0;
(function ($) {
    $(document).ready(function () {
        init();
    });

    function init() {
       var html ='<div class="modal fade" id="offreModal" tabindex="-1" role="dialog" aria-labelledby="offreModalLabel"> \
            <div class="modal-dialog" role="document">\
            <form class="modal-content">\
            <div class="modal-header">\
            <div class="image_offre_type"></div>\
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
        <h4 class="modal-title" id="exampleModalLabel">Cette offre m\'intéresse</h4>\
        </div>\
        <div class="modal-body" id="form_offre">\
        <div class="display_message"></div>\
            <form action="#" method="POST" id="offre_form_submit" enctype="multipart/form-data">\
            <div class="form-group">\
        <input type="text" placeholder="Nom" class="form-control" name="nom" id="nom">\
            </div>\
            <div class="form-group">\
           <input type="text" placeholder="Nom de votre entreprise" class="form-control" name="nom_entreprise" id="nom_entreprise">\
        </div> \
        <div class="form-group">\
           <input type="email" placeholder="Votre adresse Email *" class="form-control" name="email_offre" id="email_offre">\
        </div> \
         <div class="form-group">\
           <input type="tel" placeholder="N° de téléphone de votre entreprise" class="form-control" name="tel_entreprise" id="tel_entreprise">\
        </div> \
          <div class="form-group">\
           <input type="tel" placeholder="N° de Fax de votre entreprise" class="form-control" name="fax_entreprise" id="fax_entreprise">\
        </div> \
           <div class="form-group">\
    <input type="text" value="offre" class="form-control" name="type_offre_d" id="type_offre_d" disabled>\
    <input type="hidden" value="offre" class="form-control" name="type_offre" id="type_offre">\
    </div> \
 <div class="form-group">\
        <textarea class="form-control" name="message_offre" id="message_offre" placeholder="Message"></textarea>\
            </div>\
        \
            <button type="submit" type="submit" class="btn btn-primary" id="submit_offre">Envoyer</button></form> </div></div></div> </div>';
            jQuery('body').append(html);
            jQuery('.audit_container .btn-suivant').click(function () {

            });
        jQuery('#offreModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var imagebg = button.data('imagebg')
            var modal = $(this)
            modal.find('.modal-body input#type_offre').val(recipient);
            modal.find('.modal-body input#type_offre_d').val(recipient);
            modal.find('.image_offre_type').css('background-image', 'url(' + imagebg +')');
        });

       jQuery('body').on('click', '#submit_offre', function(event){
            event.preventDefault();
            var nom = document.getElementById("nom").value;
            var nom_entreprise = document.getElementById("nom_entreprise").value;
            var email_offre = document.getElementById("email_offre").value;
            var tel_entreprise = document.getElementById("tel_entreprise").value;
            var fax_entreprise = document.getElementById("fax_entreprise").value;
            var type_offre = document.getElementById("type_offre").value;
            var message_offre = document.getElementById("message_offre").value;
           var error = false;
           $("#form_offre input[type=text], #form_offre input[type=email], #form_offre textarea, #form_offre input[type=tel]").each(function(){
               var input = jQuery(this);
               if(input.val() == "")
               {
                   error = true;
                   input.addClass("error_input");
                   input.attr("placeholder", "Champ requis !");
               }
               else
               {
                   input.removeClass("error_input");
                   error = false;
               }

           });
        if(email_offre != "") {
            if (validateEmail(email_offre) == false) {
                jQuery("#email_offre").addClass("error_input");
                jQuery("#email_offre").attr("placeholder", "Email non valide !");
                error = true;

            }
            else {
                jQuery("#email_offre").removeClass("error_input");
                error = false;
            }
        }
           if(tel_entreprise != "")
           {
               if (phonenumber(tel_entreprise) == false) {
                   jQuery("#tel_entreprise").addClass("error_input");
                   jQuery("#tel_entreprise").attr("placeholder", "Numéro télephone non valide !");
                   error = true;

               }
               else {
                   jQuery("#tel_entreprise").removeClass("error_input");
                   error = false;
               }


           }
           if(fax_entreprise != "")
           {
               if (phonenumber(fax_entreprise) == false) {
                   jQuery("#fax_entreprise").addClass("error_input");
                   jQuery("#fax_entreprise").attr("placeholder", "Numéro télephone non valide !");
                   error = true;

               }
               else {
                   jQuery("#fax_entreprise").removeClass("error_input");
                   error = false;
               }


           }
           if(error == false) {
            jQuery.ajax({
                type: "POST",
                url: ED.ajaxurl,
                data: "action=edoffre_submit&nom="+nom+"&nom_entreprise="+nom_entreprise+"&email_offre="+email_offre+"&tel_entreprise="+tel_entreprise+"&fax_entreprise="+type_offre+"&type_offre="+type_offre+"&message_offre="+message_offre,
                dataType: "json",
                beforeSend: function(){
                    jQuery('#submit_offre').text("patienter...");
                  //  jQuery('#submit_offre').setAttribute('disabled', 'disabled');
                },
                success: function(data){
                    if(data['success'] == true)
                    {
                        jQuery('.display_message').addClass('success');
                        jQuery('.display_message').text('Votre demande a bien été envoyée. Nous vous recontacterons dans les plus brefs délais.');
                        jQuery('.display_message').fadeIn();
                        jQuery(this).closest('form').find("input[type=text], textarea, input[type=email]").val("");
                    }
                },
                complete: function()
                {
                    jQuery('#submit_offre').text("Envoyer");

                //    jQuery('#submit_offre').removeAttribute('disabled');
                }
            });
           }
        });
        /*  jQuery("form#offre_form" ).submit(function( event ) {

        });*/
    }
    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    }

    function phonenumber(inputtxt)
    {
        var phoneno = /^[0-9]+$/;
        if(inputtxt.match(phoneno))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


})(jQuery);