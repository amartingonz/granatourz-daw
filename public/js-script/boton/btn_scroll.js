    // Muestra u oculta el botón según la posición de desplazamiento
    window.onscroll = function() { scrollFunction() };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("btnToTop").style.display = "block";
      } else {
        document.getElementById("btnToTop").style.display = "none";
      }
    }

    // Realiza el desplazamiento hacia arriba suave al hacer clic en el botón
    function scrollToTop() {
      document.body.scrollTop = 0; 
      document.documentElement.scrollTop = 0; 
    }