


$(function(){


         $('#formulaireFormations').submit(function (e) {

            // alert('ok');

                   e.preventDefault();

                   $('.comments').empty();

                   let formation  = $(this).serialize();

                   $.ajax({
                            url:'BackEnd/sendFormation.php',
                            type: 'POST',
                            data: formation,
                            dataType: 'json',
                            success: function (res) {

                                if(res.valider){

                                         alert('Inscription validée, vous recevez un mail confirmant votre reservation à votre adresse:'+' '+res.email);

                                    $('#formations').val(' ');
                                    $('#nom_prenoms').val(' ');
                                    $('#telephone').val(' ');
                                    $('#email').val(' ');
                                    $('#niveau').val(' ');
                                    $('#objectif').val(' ');
                                    $('#disponibilite').val(' ');
                                    $('#habitation').val(' ');
                                    $('#coche').val(' ');
                                    $('input[type="checkbox"]').val(' ');


                                }else{

                                    $('#formations + .comments').html(res.contenu_formationError);
                                    $('#nom_prenoms + .comments').html(res.nom_prenomsError);
                                    $('#telephone + .comments').html(res.telephoneError);
                                    $('#email + .comments').html(res.emailError);
                                    $('#niveau + .comments').html(res.niveauError);
                                    $('#objectif + .comments').html(res.objectifError);
                                    $('#disponibilite + .comments').html(res.disponibiliteError);
                                    $('#habitation + .comments').html(res.habitationError);
                                    $('#etatcoche + .comments').html(res.etatcocheError);


                                 //   alert('pas ok');


                                }




                       }

                   })
         })


})