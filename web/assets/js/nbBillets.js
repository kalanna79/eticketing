/**
 * Created by natacha on 04/08/2017.
 */


$('#nb_tickets_NbBillets').hide();

$('#nb_tickets_choiceNb_0').click(function () {
    $('#nb_tickets_NbBillets').hide();
});

$('#nb_tickets_choiceNb_1').click(function () {
    $('#nb_tickets_NbBillets').show().prop( "disabled", false );
});

/*
$(function () {
    $('#nb_tickets_choiceNb_1').click(function () {
        console.log('prout');
        $('#nb_tickets_NbBillets').prop( "disabled", false );
    });
    $('#nb_tickets_choiceNb_0').click(function () {
        $('#nb_tickets_NbBillets').prop( "disabled", true );
    });
});
    */
