
$(function(){


    $('#communication').submit(function (e) {



                 e.preventDefault();

                 $('.comments').empty();

                 let communication = $(this).serialize();


                 $.ajax({
                     url: 'BackEnd/sendCommunication.php',
                     type: 'POST',
                     data: communication,
                     dataType: 'json',
                     success : function (res) {

                         if(res.valider){

                                alert('Inscription effectée avec success');

                             $('#object').val('');
                             $('#date').val('');
                             $('#nom').val('');
                             $('#phone').val('');
                             $('#email').val('');

                         }else{

                             $('#object + .comments').html(res.objectError);
                             $('#date + .comments').html(res.dateError);
                             $('#nom + .comments').html(res.nomError);
                             $('#phone + .comments').html(res.phoneError);
                             $('#email + .comments').html(res.emailError);


                         }

                     }

                 })


    })

})