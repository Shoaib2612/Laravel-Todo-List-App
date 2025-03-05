<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>📋@yield("title","To Do App")</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
      html, body {
          height: 100%;
          margin: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          font-family: 'Poppins', sans-serif;
          background: linear-gradient(135deg, #1e3c72, #2a5298, #6dd5ed, #2193b0);
          background-size: 400% 400%;
          animation: gradientShift 10s ease infinite;
      }

      @keyframes gradientShift {
          0% { background-position: 0% 50%; }
          50% { background-position: 100% 50%; }
          100% { background-position: 0% 50%; }
      }

      .center-container {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          width: 90%;
          max-width: 450px;
          padding: 2.5rem;
          background: rgba(255, 255, 255, 0.1);
          border-radius: 20px;
          backdrop-filter: blur(12px);
          box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
          text-align: center;
          animation: floatUp 3s ease-in-out infinite;
      }

      @keyframes floatUp {
          0%, 100% { transform: translateY(0); }
          50% { transform: translateY(-10px); }
      }

      /* Override Bootstrap Buttons */
      .btn-primary {
          background: linear-gradient(45deg, #ff416c, #ff4b2b);
          border: none;
          padding: 15px;
          font-size: 18px;
          color: white;
          border-radius: 30px;
          cursor: pointer;
          transition: all 0.4s ease;
          box-shadow: 0 0 15px #ff4b2b;
      }

      .btn-primary:hover {
          transform: scale(1.1);
          box-shadow: 0 0 25px #ff416c;
      }

      a {
          color: #6dd5ed;
          text-decoration: none;
      }

      a:hover {
          color: #ff416c;
          text-decoration: underline;
      }

      .text-body-secondary {
          font-size: 12px;
          color: rgba(255, 255, 255, 0.8);
      }
    </style>
  </head>

  <body class="d-flex align-items-center py-4">
    @yield("content")

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
  </body>
</html>