const div_switch = document.querySelector('.section_menu')
alert('fefe')
div_switch.addEventListener("click", () => {
    alert('fef')
})

/*
const animate = gsap.timeline({ paused: true });
const animateBackground = new TimelineMax({ paused: true });
let toggle = true;

animateBackground
    .to("body", 0.1, { backgroundImage: "none", backgroundColor: "#111" }, 0.2)
    .set(".switch", { boxShadow: "0 0 10px rgba(255, 255, 255, 0.2)" })
    .to(".text p", 0.1, { color: "#FFF" }, 0.2);

animate
    .to(".toggle-button", 0.2, { scale: 0.7 }, 0)
    .set(".toggle", { backgroundColor: "#FFF" })
    .set(".circle", { display: "none" })
    .to(".moon-mask", 0.2, { translateY: 20, translateX: -10 }, 0.2)
    .to(".toggle-button", 0.2, { translateY: 49 }, 0.2)
    .to(".toggle-button", 0.2, { scale: 0.9 })

document.getElementsByClassName("switch")[0].addEventListener("click", () => {
    if(toggle){
        animate.restart();
        animateBackground.restart();
    } else {
        animate.reverse();
        animateBackground.reverse();
    }
    toggle = !toggle;
});
*/

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


