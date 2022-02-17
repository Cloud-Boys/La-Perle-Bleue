


$(function () {

    // ACTIVATION DU DATEPICKER 
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        language: "fr",
        daysShort: true,
        datesDisabled: ['02/03/2022'],
        daysOfWeekDisabled: [1,0],
        startDate: new Date(),
    });
    /*
    $('.timepicker').datetimepicker({
    });
    */
});


$(document).ready(function(){
    $('input.timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 10,
        minTime: '10',
        maxTime: '22',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        zindex: 10
    });
});


$(document).ready(function() {
    $('input').attr('autocomplete', 'off');
  });


