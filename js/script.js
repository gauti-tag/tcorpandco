$(function () {

      $('#formulaire').submit(function (e) {
		
		

            e.preventDefault();

            $('.comments').empty();

            let post = $(this).serialize();


            $.ajax({
                  url:'BackEnd/sender.php',
                  type:'POST',
                  data: post,
                  dataType: 'json',

                  success: function (res) {

                       if(res.valide){

                            // $('#sms').html('<span id="sms" class="btn btn-success">  DEVIS ENVOYE  </span>').delay(3000).hide(1000);
                             $('.eventDate').val(' ');
                             $('.jour').val(' ');
                             $('.tel').val(' ');
                             $('.email').val(' ');
                             $('.nom').val(' ');
                             $('.nbre').val(' ');
                             $('.somme').val(' ');
                             $('input[type="checkbox"]').val(' ');

                          //  $('#pdf').html('<span><a href="devis.php" target="_blank" class="btn btn-info"> TELECHARGER VOTRE DEVIS PDF </a></span>');
						 
						 
						 $('#success').html(' <div class="alert alert-success left" role="alert" style="" align="center">\n' +
                                 '\n' +
                                 '                <strong>Dévis envoyé</strong> à votre adresse :<b>'+ res.email +'</b>'+ ' ' +' <a href="devis.php" class="alert-link" target="_blank"> <i>Cliquer ici pour télécharger votre devis pdf </i> </a>\n' +
                                 '\n' +
                                 '                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                                 '                    <span aria-hidden="true">&times;</span>\n' +
                                 '                </button>\n' +
                                 '\n' +
                                 '            </div>');



                       }else{

                             $('.eventDate + .comments').html(res.dateEventError);
                             $('.jour + .comments').html(res.periodeEventError);
                             $('.nom + .comments').html(res.nomDemandeurError);
                             $('.tel + .comments').html(res.numeroDemandeurError);
                             $('.email + .comments').html(res.emailError);
                             $('.comments').html(res.optError);


                       }

                  }

            }) 

      })

})