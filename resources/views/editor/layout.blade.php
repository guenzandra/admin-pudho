<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PUDHO Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">
  @include('editor.nav') <!-- This includes your nav.blade.php -->
</body>

</html>