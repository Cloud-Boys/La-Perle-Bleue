$(function () {

    // ACTIVATION DU DATEPICKER 
    $('.datepicker').datepicker({
        format: 'DD/MM/YYYY',

        datesDisabled: ['02/03/2022'],
        daysOfWeekDisabled: ['0,6']
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


