<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventify - Book Your Events</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

  <!-- AOS (Animate on Scroll) -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Custom CSS (Neon Event Theme) -->
  <style>
    :root{
      --bg-dark:#07060a;
      --card-dark:#0f0f14;
      --accent1:#ff4dff; /* neon pink */
      --accent2:#00d2ff; /* neon cyan */
      --yellow:#ffc107;
      --glass: rgba(255,255,255,0.04);
      --muted:#bfc3cf;
    }

    html,body { height:100%; }
    body {
      margin:0;
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(180deg, #05040a 0%, #0b0b10 100%);
      color: #e9eef8;
      -webkit-font-smoothing:antialiased;
      scroll-behavior: smooth;
    }

    a { text-decoration:none; color:inherit; }

    /* Navbar */
    .navbar {
      padding: 0.9rem 1.5rem;
      background: linear-gradient(90deg, rgba(255,77,255,0.06), rgba(0,210,255,0.03));
      border-bottom: 1px solid rgba(255,255,255,0.03);
      backdrop-filter: blur(6px);
      transition: background 0.25s ease, transform 0.15s ease;
    }
    .navbar-brand {
      font-family: 'Montserrat', sans-serif;
      font-weight: 800;
      letter-spacing: 0.6px;
      font-size: 1.6rem;
      color: white;
      text-shadow: 0 2px 18px rgba(255,77,255,0.08);
    }
    .nav-link {
      color: var(--muted) !important;
      transition: color .15s, transform .12s;
    }
    .nav-link:hover { color: #fff !important; transform: translateY(-2px); }

    .btn-cta {
      background: linear-gradient(90deg, var(--accent1), var(--accent2));
      border: none;
      color: #070714;
      font-weight: 700;
      box-shadow: 0 6px 30px rgba(0,210,255,0.08), 0 2px 6px rgba(255,77,255,0.06);
      transition: transform .15s ease, box-shadow .15s;
    }
    .btn-cta:hover { transform: translateY(-4px); box-shadow: 0 18px 50px rgba(0,210,255,0.12); }

    /* HERO - Parallax */
    .hero {
      position: relative;
      height: 92vh;
      min-height: 640px;
      display:flex;
      align-items:center;
      justify-content:center;
      text-align:center;
      overflow:hidden;
      padding-top:60px;
    }

    .hero-bg {
      position:absolute;
      top:50%;
      left:50%;
      width:120%;
      height:120%;
      transform: translate(-50%,-50%);
      object-fit:cover;
      filter: saturate(1.05) contrast(1.02) brightness(0.62);
      transition: transform 0.2s linear;
      will-change: transform;
      z-index:0;
    }

    /* colorful radial lights */
    .hero-lights::before,
    .hero-lights::after {
      content: "";
      position:absolute;
      width:900px;
      height:900px;
      border-radius:50%;
      filter: blur(120px);
      opacity:0.22;
      z-index:0;
      pointer-events:none;
    }
    .hero-lights::before { background: radial-gradient(circle at 30% 30%, rgba(255,77,255,0.9), transparent 30%); left:-12%; top:-10%; }
    .hero-lights::after { background: radial-gradient(circle at 70% 70%, rgba(0,210,255,0.85), transparent 30%); right:-12%; bottom:-10%; }

    .hero-overlay {
      position:absolute;
      inset:0;
      background: linear-gradient(180deg, rgba(0,0,0,0.25), rgba(0,0,0,0.5));
      z-index:0;
    }

    .hero-content {
      position:relative;
      z-index:5;
      max-width:980px;
      padding: 40px;
      border-radius:18px;
      backdrop-filter: blur(6px);
      background: linear-gradient(135deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border: 1px solid rgba(255,255,255,0.03);
    }

    .hero-title {
      font-family:'Montserrat',sans-serif;
      font-weight:800;
      font-size:3.2rem;
      line-height:1.02;
      margin:0;
      letter-spacing:1px;
      color: #fff;
      text-shadow: 0 10px 40px rgba(0,0,0,0.6);
    }
    .hero-subtitle {
      color: #d7e6ff;
      margin-top:0.6rem;
      font-size:1.05rem;
      font-weight:500;
    }
    .hero-cta-wrap { margin-top:1.4rem; display:flex; gap:12px; justify-content:center; }

    .btn-ghost {
      background:transparent;
      color:var(--muted);
      border-radius:50px;
      border:1px solid rgba(255,255,255,0.06);
      padding:10px 22px;
    }

    /* EVENTS */
    #events { padding:70px 0; }
    #events h2 { font-family:'Montserrat'; font-weight:800; color:#fff; margin-bottom:30px; text-align:center; }

    .events-grid {
      perspective:1200px; /* for 3D effect */
    }

    .event-card {
      border-radius:14px;
      overflow:hidden;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border:1px solid rgba(255,255,255,0.04);
      transition: transform .35s cubic-bezier(.12,.9,.21,1), box-shadow .35s;
      transform-style: preserve-3d;
      will-change: transform;
    }

    .event-card:hover {
      transform: translateY(-18px) rotateX(6deg) rotateY(-5deg) scale(1.03);
      box-shadow: 0 35px 80px rgba(3,6,23,0.7);
    }

    .event-card .card-img-top {
      height:230px;
      object-fit:cover;
      display:block;
      transition: transform .6s ease;
      transform-origin: center;
      will-change: transform;
    }
    .event-card:hover .card-img-top { transform: scale(1.06) translateZ(20px); }

    .card-body { padding:18px; }
    .card-title { font-family:'Montserrat'; font-weight:700; letter-spacing:0.6px; color:#fff; margin-bottom:6px; }
    .card-meta { color:var(--muted); font-size:0.95rem; margin-bottom:10px; }

    .btn-book {
      background: linear-gradient(90deg, rgba(255,77,255,0.92), rgba(0,210,255,0.92));
      color:#070714;
      font-weight:700;
      border-radius:12px;
    }
    .btn-book:hover { transform: translateY(-4px); }

    /* Testimonials */
    .testimonials { padding:60px 0; background: linear-gradient(180deg, rgba(2,2,8,0.6), rgba(2,2,8,0.75)); }
    .testimonial-card { background:linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02)); border-radius:12px; padding:22px; border:1px solid rgba(255,255,255,0.03); }
    .testimonial-card img { object-fit:cover; }

    /* Contact */
    #contact { padding:60px 0; }
    #contact .form-control {
      background: transparent;
      border:1px solid rgba(255,255,255,0.06);
      color:#eef4ff;
      border-radius:10px;
      padding:14px 16px;
    }
    #contact .form-control::placeholder { color: rgba(255,255,255,0.45); }
    #contact .btn-primary { background: linear-gradient(90deg,var(--accent1),var(--accent2)); border:none; }

    /* Footer */
    footer { padding:20px 0; background:transparent; color:var(--muted); border-top:1px solid rgba(255,255,255,0.03); }
    footer a { color:var(--muted); transition: color .12s; }
    footer a:hover { color:#fff; }

    /* Modal */
    .modal-content { background: linear-gradient(180deg, rgba(11,11,16,0.9), rgba(6,6,10,0.96)); color:#eaf2ff; border-radius:14px; border:1px solid rgba(255,255,255,0.03); }

    /* Responsive tweaks */
    @media (max-width:991px){
      .hero-title{ font-size:2.4rem; }
      .hero { min-height:560px; height:82vh; }
    }
    @media (max-width:575px){
      .hero-title{ font-size:1.85rem; }
      .hero-subtitle{ font-size:0.98rem; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Eventify</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon" style="filter:invert(1);"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          <li class="nav-item ms-2"><a class="btn btn-cta btn-sm" href="#events">Book Now</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero hero-lights" id="home">
    <!-- background image (parallax) -->
    <img src="./assets/bd.2.jpg" alt="Background" class="hero-bg" id="heroBg">

    <div class="hero-overlay"></div>

    <div class="hero-content" data-aos="zoom-in" data-aos-duration="900">
      <h1 class="hero-title">Music Fest 2025</h1>
      <p class="hero-subtitle">Join us for an unforgettable live concert experience — lights, beats, and moments that glow.</p>
      <div class="hero-cta-wrap">
        <a href="#events" class="btn btn-cta btn-lg">Book Tickets</a>
        <button class="btn btn-ghost btn-lg" onclick="document.querySelector('#about').scrollIntoView({behavior:'smooth'})">Learn More</button>
      </div>
    </div>
  </section>

  <!-- EVENTS -->
  <section id="events">
    <div class="container">
      <h2 data-aos="fade-up">Upcoming Events</h2>

      <div class="row g-4 events-grid">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="80">
          <div class="card event-card h-100 shadow-sm">
            <img src="./assets/ev.1.jpg" class="card-img-top" alt="Event 1">
            <div class="card-body">
              <h5 class="card-title">MUSIC CONCERT</h5>
              <p class="card-meta">📅 20th September 2025&nbsp;&nbsp; ⏰ 6:00 PM</p>
              <p class="card-meta">📍 Chennai Stadium</p>
              <button class="btn btn-book w-100" data-bs-toggle="modal" data-bs-target="#bookingModal" data-event="MUSIC CONCERT - Chennai Stadium">Book Now</button>
            </div>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="160">
          <div class="card event-card h-100 shadow-sm">
            <img src="./assets/ev.2.jpg" class="card-img-top" alt="Event 2">
            <div class="card-body">
              <h5 class="card-title">DJ NIGHT PARTY</h5>
              <p class="card-meta">📅 31st August 2025&nbsp;&nbsp; ⏰ 8:30 PM</p>
              <p class="card-meta">📍 Bangalore Club</p>
              <button class="btn btn-book w-100" data-bs-toggle="modal" data-bs-target="#bookingModal" data-event="DJ NIGHT PARTY - Bangalore Club">Book Now</button>
            </div>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="240">
          <div class="card event-card h-100 shadow-sm">
            <img src="./assets/ev.3.jpg" class="card-img-top" alt="Event 3">
            <div class="card-body">
              <h5 class="card-title">MUSIC CONCERT</h5>
              <p class="card-meta">📅 30th September 2025&nbsp;&nbsp; ⏰ 7:00 PM</p>
              <p class="card-meta">📍 Coimbatore Arena</p>
              <button class="btn btn-book w-100" data-bs-toggle="modal" data-bs-target="#bookingModal" data-event="MUSIC CONCERT - Coimbatore Arena">Book Now</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Booking Modal (PHP logic untouched) -->
  <form action="index.php" method="POST">
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
          <div class="modal-header">
            <h5 class="modal-title">Book Your Ticket</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Event</label>
              <input type="text" id="eventName" class="form-control" readonly name="evn">
            </div>
            <div class="mb-3">
              <label class="form-label">Your Name</label>
              <input type="text" class="form-control" placeholder="Enter your name" required name="nm">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Enter your email" required name="em">
            </div>
            <div class="mb-3">
              <label class="form-label">Phone</label>
              <input type="number" class="form-control" placeholder="Enter your mobile" required name="pho">
            </div>
            <div class="mb-3">
              <label class="form-label">Tickets</label>
              <input type="number" class="form-control" min="1" value="1" required name="noft">
            </div>
            <button type="submit" class="btn btn-success w-100" name="book">Confirm Booking</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- ABOUT -->
  <section id="about" class="py-5">
    <div class="container">
      <h2 data-aos="fade-up">About Eventify</h2>
      <div class="row align-items-center mt-4">
        <div class="col-md-6" data-aos="fade-right">
          <h5 style="font-weight:700;">🎉 Experience Unforgettable Moments</h5>
          <p>Eventify brings electrifying concerts, sports matches, and glamorous parties to life. Our mission is to create memorable experiences for everyone.</p>
          <h6>📍 Address</h6>
          <p>123 Event Street, Tamil Nadu, India</p>
          <h6>📧 Email</h6>
          <p>contact@eventify.com</p>
          <h6>📞 Phone</h6>
          <p>+91 98765 43210</p>
        </div>
        <div class="col-md-6 text-center" data-aos="fade-left">
          <img src="./assets/about.jpg" class="img-fluid rounded shadow" alt="About Image" style="max-height:340px; object-fit:cover;">
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="testimonials">
    <div class="container">
      <h2 data-aos="fade-up">What People Say</h2>
      <div class="row g-4 mt-3">
        <div class="col-md-4" data-aos="flip-left" data-aos-delay="80">
          <div class="testimonial-card text-center">
            <img src="./assets/r.p.1.jpg" class="rounded-circle mb-3" width="80" height="80" alt="">
            <p>"Amazing experience! Loved the vibe and the performances."</p>
            <h6>- Rukmani Vasanth</h6>
          </div>
        </div>
        <div class="col-md-4" data-aos="flip-left" data-aos-delay="160">
          <div class="testimonial-card text-center">
            <img src="./assets/r.p.2.jpg" class="rounded-circle mb-3" width="80" height="80" alt="">
            <p>"The best event I’ve attended this year. Highly recommended!"</p>
            <h6>- Sai Pallavi</h6>
          </div>
        </div>
        <div class="col-md-4" data-aos="flip-left" data-aos-delay="240">
          <div class="testimonial-card text-center">
            <img src="./assets/sm.1.jpg" class="rounded-circle mb-3" width="80" height="80" alt="">
            <p>"Great organization and fantastic music. Can’t wait for the next one."</p>
            <h6>- SM</h6>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="py-5">
    <div class="container">
      <h2 data-aos="fade-up">Contact Us</h2>
      <div class="row justify-content-center mt-3">
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="80">
          <form onsubmit="sendWhatsApp(); return false;">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Your Email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Message</label>
              <textarea class="form-control" rows="4" id="message" placeholder="Your Message" required></textarea>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="text-center">
    <div class="container">
      <p>
        <a href="#">Facebook</a> | 
        <a href="#">Instagram</a> | 
        <a href="#">Twitter</a>
      </p>
      <p>&copy; 2025 Eventify. All rights reserved.</p>
    </div>
  </footer>

  <!-- Bootstrap + AOS + small utilities -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    // Initialize AOS
    AOS.init({
      once: true,
      easing: 'ease-out-cubic',
      duration: 700
    });

    // Booking Modal: set event name (unchanged)
    const bookingModal = document.getElementById('bookingModal');
    if (bookingModal) {
      bookingModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const eventName = button.getAttribute('data-event') || '';
        document.getElementById('eventName').value = eventName;
      });
    }

    // WhatsApp send (unchanged behavior)
    function sendWhatsApp() {
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const message = document.getElementById("message").value.trim();
      const text = `Name: ${name}%0AEmail: ${email}%0AMessage: ${message}`;
      const phone = "918608144068";
      window.open(`https://wa.me/${phone}?text=${text}`, "_blank");
    }

    // HERO Parallax (subtle): translates background image based on scroll
    (function() {
      const bg = document.getElementById('heroBg');
      if(!bg) return;
      let latestKnownScrollY = 0;
      let ticking = false;

      function onScroll() {
        latestKnownScrollY = window.scrollY;
        requestTick();
      }

      function requestTick() {
        if (!ticking) {
          requestAnimationFrame(update);
        }
        ticking = true;
      }

      function update() {
        const scrolled = latestKnownScrollY;
        // compute a parallax offset (subtle)
        // move up to +/- 40px based on scroll within first viewport
        const maxOffset = 40;
        const ratio = Math.min(scrolled / (window.innerHeight), 1);
        const offset = -maxOffset * ratio;
        // small horizontal drift using sine for natural feel
        const drift = Math.sin(scrolled / 200) * 6;
        bg.style.transform = `translate(calc(-50% + ${drift}px), calc(-50% + ${offset}px)) scale(1.03)`;
        ticking = false;
      }

      window.addEventListener('scroll', onScroll, { passive: true });
      // initial update
      update();
    })();

    // Pointer-based tilt for stronger 3D feeling on event cards (hover motion)
    (function(){
      const cards = document.querySelectorAll('.event-card');
      cards.forEach(card => {
        card.addEventListener('pointermove', function(e) {
          const rect = card.getBoundingClientRect();
          const cx = rect.left + rect.width/2;
          const cy = rect.top + rect.height/2;
          const dx = e.clientX - cx;
          const dy = e.clientY - cy;
          const tiltx = (dy / rect.height) * 8; // rotateX
          const tilty = (dx / rect.width) * -8; // rotateY
          card.style.transform = `translateY(-18px) rotateX(${tiltx}deg) rotateY(${tilty}deg) scale(1.03)`;
        });
        card.addEventListener('pointerleave', function(){
          card.style.transform = '';
        });
      });
    })();
  </script>

  <!-- =============== DO NOT CHANGE PHP BELOW =============== -->
  <?php 
  if (isset($_POST['book'])) {
      $name  = $_POST['nm'];
      $email = $_POST['em'];  
      $pho   = $_POST['pho'];
      $noft  = $_POST['noft'];
      $event = $_POST['evn'];
  
      // Database connection
      $servername = "localhost";
      $username   = "u913997673_prasanna";
      $password   = "Ko%a/2klkcooj]@o";
      $dbname     = "u913997673_prasanna";
  
      $conn = new mysqli($servername, $username, $password, $dbname);
  
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
  
      // Insert into database
      $sql = "INSERT INTO book (name,email,phone,noft,event) 
              VALUES ('$name','$email','$pho','$noft','$event')";
  
      if ($conn->query($sql) === TRUE) {
          // Success message
          echo "<script>
              Swal.fire({
                title: '✅ Booking Confirmed!',
                text: 'Your booking details have been saved in the database.',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                customClass: {
                  title: 'swal2-title-custom',
                  popup: 'swal2-popup-custom'
                }
              }).then(() => {
                window.location.href='index.php';
              });
          </script>";
  
          // Send Email after successful booking
          $to = $email;
          $subject = "Your Event Booking Confirmation";
          $message = "Hello $name,\n\nThank you for booking with us!\n\n".
                     "Name: $name\nEmail: $email\nPhone: $pho\nTickets: $noft\nEvent: $event\n\n".
                     "We will contact you soon.\n\nRegards,\nEvent Team";
  
          $headers = "From: no-reply@prasanna.techmerise.com";
  
          if (mail($to, $subject, $message, $headers)) {
              echo "<script>alert('📩 Confirmation email sent to $email');</script>";
          } else {
              echo "<script>alert('⚠️ Failed to send confirmation email');</script>";
          }
  
      } else {
          // Error inserting data
          echo "<script>
              Swal.fire({
                title: '❌ Error!',
                text: 'Booking could not be saved.',
                icon: 'error',
                confirmButtonText: 'Try Again',
                confirmButtonColor: '#d33'
              });
          </script>";
      }
  
      $conn->close();
  }
  ?>
  <!-- =============== END PHP (UNCHANGED) =============== -->

</body>
</html>
