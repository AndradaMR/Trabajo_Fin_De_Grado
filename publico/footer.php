 <footer class="main-footer">
    <div class="container footer-container">
      <div class="footer-brand">
        <p>&copy; 2026 Body and Soul. Todos los derechos reservados.</p>
      </div>

      <div class="footer-social">
        <a href="https://www.instagram.com/bodyandsoules/" aria-label="Instagram" class="social-link">IG</a>
        <a href="#" aria-label="Facebook" class="social-link">f</a>
        <a href="#" aria-label="X" class="social-link">X</a>
      </div>
    </div>
  </footer>

  <script src="../js/favoritos.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const stars = document.querySelectorAll(".stars-input span");
      const input = document.getElementById("puntuacion");

      if(stars.length > 0 && input){

        stars.forEach(star => {

          // Hover
          star.addEventListener("mouseover", function () {
            const val = this.dataset.value;

            stars.forEach(s => {
              s.classList.remove("hover");
              if (s.dataset.value <= val) {
                s.classList.add("hover");
              }
            });
          });

          // Quitar hover
          star.addEventListener("mouseout", function () {
            stars.forEach(s => s.classList.remove("hover"));
          });

          // Click
          star.addEventListener("click", function () {
            const val = this.dataset.value;
            input.value = val;

            stars.forEach(s => {
              s.classList.remove("active");
              if (s.dataset.value <= val) {
                s.classList.add("active");
              }
            });
          });

        });
      }
    });
  </script>
