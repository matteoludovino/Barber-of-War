document.addEventListener('DOMContentLoaded', function () {
    const carrossel = document.querySelector('.depoimentos-carrossel');
    const depoimentos = document.querySelectorAll('.depoimento');
    const prevBtn = document.querySelector('.carrossel-btn.prev');
    const nextBtn = document.querySelector('.carrossel-btn.next');
    let currentIndex = 0;

    function updateCarrossel() {
        carrossel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    prevBtn.addEventListener('click', function () {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : depoimentos.length - 1;
        updateCarrossel();
    });

    nextBtn.addEventListener('click', function () {
        currentIndex = (currentIndex < depoimentos.length - 1) ? currentIndex + 1 : 0;
        updateCarrossel();
    });

    setInterval(function () {
        currentIndex = (currentIndex < depoimentos.length - 1) ? currentIndex + 1 : 0;
        updateCarrossel();
    }, 5000);
});

let mybutton = document.getElementById("topo");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
}