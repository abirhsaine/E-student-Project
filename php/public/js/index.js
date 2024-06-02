document.addEventListener('DOMContentLoaded', () => {

    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  
    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {
  
      // Add a click event on each of them
      $navbarBurgers.forEach( el => {
        el.addEventListener('click', () => {
  
          // Get the target from the "data-target" attribute
          const target = el.dataset.target;
          const $target = document.getElementById(target);
  
          // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
          el.classList.toggle('is-active');
          $target.classList.toggle('is-active');
  
        });
      });
    }
  
  });

// Gestion des boutons de filtre des catégories
var tab = document.getElementsByClassName('panel-tabs')[0];
if (tab){
  // gestion de la selection d'une catégorie après le chargement d'une page
  if (localStorage.getItem('categorie')){
    filtreCategorie = localStorage.getItem('categorie');
    rechercheListe();
    for(var i = 0; i < tab.children.length; i++){
      if (tab.children[i].dataset.category == localStorage.getItem('categorie'))
        tab.children[i].classList.add('is-active');
      else
        tab.children[i].classList.remove('is-active');
    }
  } else {
    tab.children[0].classList.add('is-active');
  }
      
  tab.addEventListener('click', function(event){
    if (event.target.nodeName == 'A'){
      for(var i = 0; i < tab.children.length; i++){
        tab.children[i].classList.remove('is-active');
      }
      event.target.classList.add('is-active');
    }
  });  
}

// Gestion de la liste des catégorie (changement de couleur du logo de la catégorie séléctionnée)
var panelsblock = document.getElementById('panels-block');
if (panelsblock){
  panelsblock.addEventListener('click', function(event){
    for(var i = 0; i < panelsblock.children.length; i++){
      panelsblock.children[i].classList.remove('is-active');
    }
    event.target.classList.add('is-active');
  });
}

// Filtre de la liste lors de la séléction d'une catégorie
var filtreCategorie = 'All';
var paneltabs = document.getElementsByClassName('panel-tabs')[0];
if (paneltabs){
  paneltabs.addEventListener('click', function(event){
    if (event.target.nodeName == 'A'){
      filtreCategorie = event.target.dataset.category;
      localStorage.setItem('categorie', filtreCategorie);
      for(var i = 0; i < panelsblock.children.length; i++){
        if (panelsblock.children[i].dataset.category == event.target.dataset.category || event.target.dataset.category == "All")
          panelsblock.children[i].style.display = "flex";
        else
          panelsblock.children[i].style.display = "none";
      }
      rechercheListe();
    }
  });
}

// Système de recherche au sein de la liste
function rechercheListe(){
  var input = document.getElementById('rechercheListe');
  var panelsblock = document.getElementById('panels-block');
  for(var i = 0; i < panelsblock.children.length; i++){
    if (panelsblock.children[i].textContent.trim().toUpperCase().toUpperCase().includes(input.value.toUpperCase())
        && (panelsblock.children[i].dataset.category == filtreCategorie || filtreCategorie == "All"))
      panelsblock.children[i].style.display = "flex";
    else
      panelsblock.children[i].style.display = "none";
  }
}

// Activation de SELECT2
$('select[multiple]').select2();

// Systèmes de notifications
document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    const $notification = $delete.parentNode;

    $delete.addEventListener('click', () => {
      $notification.parentNode.removeChild($notification);
    });
  });
});

// Champs date
const calendars = bulmaCalendar.attach('[type="date"]', {
  type: "date",
  lang: 'fr',
  minDate: new Date("1900-01-01"),
  maxDate: new Date(),
  dateFormat: 'dd/MM/yyyy',
});