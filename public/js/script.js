const div_switch = document.querySelector('.section_menu')

$(function () {

    // ACTIVATION DU DATEPICKER 
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        language: "fr",
        daysOfWeekDisabled: [1,0],
        startDate: new Date(),
        orientation: "top",
        autoclose: true
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
        zindex: 10,
        hoursDisabled: '15, 16, 17'
    });
});



$(document).ready(function() {
    $('input').attr('autocomplete', 'off');
  });


