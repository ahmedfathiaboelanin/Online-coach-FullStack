<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>
<!-- owl carousel -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script>
  window.onload=()=>{
    setTimeout(() => {
    document.getElementById("preload").setAttribute("style", "display:none");
    document.getElementById("preloadImg").setAttribute("style", "display:none");
    }, 000);
  }
  // owl carousel
    $(".owl-carousel").owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      dots:false,
      center: true,
      autoWidth: true,
      slideBy: 1,
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 3,
        },
      },
    });
  // -----------------------
</script>
    <!-- wow js -->
      <script src="js/wow.min.js"></script>
      <script>
      new WOW().init();
      </script>
    <!-- -------------- -->