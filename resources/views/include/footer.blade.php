<footer class="footer mt-auto py-4 bg-dark text-light">
  <div class="container text-center">

    <!-- Project Developed By -->
    <div class="fw-bold fs-5 animate-fadeIn">Project Developed by <span class="text-success">Shoaib.</span></div>

    <!-- Tech Stack Used -->
    <div class="tech-stack animate-slideUp mt-2">
      <span class="badge bg-danger">Laravel</span>
      <span class="badge bg-primary">PHP</span>
      <span class="badge bg-warning text-dark">MySQL</span>
      <span class="badge bg-success">Bootstrap</span>
      <span class="badge bg-info text-dark">CSS</span>
    </div>

    <!-- Social Icons -->
    <div class="social-icons mt-3">
      <a href="https://github.com/yourgithub" target="_blank" class="icon github">
        <i class="fab fa-github"></i>
      </a>
      <a href="https://linkedin.com/in/yourlinkedin" target="_blank" class="icon linkedin">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="mailto:your.email@gmail.com" class="icon gmail">
        <i class="fas fa-envelope"></i>
      </a>
    </div>

    <!-- Copyright -->
    <div class="mt-3 text-secondary small">© Shoaib. 2025</div>

  </div>
</footer>

<!-- Icons Styles & Animations -->
<style>
  body {
    margin: 0;
    padding-bottom: 80px; /* Adjust this to match the footer height */
    overflow-y: auto; /* Ensures vertical scrolling */
}

  .footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height:100px;
    box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.2);
  }

  /* Tech Stack Badges */
  .tech-stack span {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 14px;
    margin: 3px;
    animation: fadeIn 1s ease-in-out;
  }

  /* Social Icons */
  .social-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
  }

  .icon {
    font-size: 24px;
    text-decoration: none;
    padding: 10px;
    border-radius: 50%;
    display: inline-block;
    transition: transform 0.3s ease, background 0.3s ease;
  }

  .github { color: white; background: #333; }
  .linkedin { color: white; background: #0077B5; }
  .gmail { color: white; background: #D44638; }

  .icon:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.3);
  }

  /* Animations */
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .animate-fadeIn { animation: fadeIn 1.5s ease-in-out; }
  .animate-slideUp { animation: fadeIn 1.5s ease-in-out; }
  .footer a {
    transition: transform 0.3s ease, color 0.3s ease;
}

.footer a:hover {
    transform: scale(1.2);
    color: #f8f9fa !important; /* Light color on hover */
}
</style>

<!-- FontAwesome Icons (For GitHub, LinkedIn, Gmail) -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>