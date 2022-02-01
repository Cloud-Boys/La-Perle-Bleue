var onglets = document.querySelectorAll(".onglet");
var products_container = document.querySelectorAll('.products_container');

onglets.forEach(objet => {

  objet.addEventListener('click', () => {

    var index_on = objet.getAttribute('data-num');


    for (var i = 0; i < onglets.length; i++) {
      if (onglets[i].getAttribute('data-num') == index_on) {
        onglets[i].classList.add('active');
       }else {
          onglets[i].classList.remove('active');
        }
      }


    for (var j = 0; j < products_container.length; j++) {

      if(products_container[j].getAttribute('data-num') == index_on) {
        products_container[j].classList.add('visible');
      } else {
        products_container[j].classList.remove('visible');
      }

    }

  })
});