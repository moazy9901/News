<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Toastify CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

  @vite('resources/css/app.css')
</head>

<body>

  @yield("content")

  <!-- Toastify JS -->
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  @if(session('success'))
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        Toastify({
          text: @json(session('success')),
          duration: 4000,
          close: true,
          gravity: "top",
          position: "right",
          stopOnFocus: true,
          style: {
            background: "green",
            borderRadius: "8px",
            fontSize: "15px",
          },
          offset: {
            x: 20,
            y: 20
          },
        }).showToast();
      });
    </script>
  @endif

</body>

</html>