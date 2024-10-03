<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initialscale=1.0">
 <title>@yield('title', 'Default Title')</title>

 <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.m
in.css" rel="stylesheet" integrity="sha384-
QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
crossorigin="anonymous">

<script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .animated-bg {
            background: linear-gradient(270deg, #6a11cb, #2575fc);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
   /* styles.css */

body {
    background-color: #f4f7fa; /* Warna latar belakang lembut */
    font-family: 'Helvetica Neue', Arial, sans-serif; /* Tipografi yang bersih */
    color: #333; /* Warna teks gelap */
}

.container {
    border-radius: 8px; /* Sudut kontainer melengkung */
    background-color: #fff; /* Latar belakang putih */
    padding: 20px; /* Padding dalam kontainer */
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
}

h2 {
    color: #0056b3; /* Warna teks header yang menarik */
    font-weight: 700; /* Tebalkan teks header */
}

.table {
    border-collapse: collapse; /* Menghilangkan jarak antara sel */
}

.table th {
    background-color: #007bff; /* Warna latar belakang header tabel */
    color: #fff; /* Warna teks putih */
    padding: 12px; /* Padding sel header */
    font-size: 1.1em; /* Ukuran font lebih besar untuk header */
}

.table td {
    padding: 12px; /* Padding sel tabel */
    border-bottom: 1px solid #e9ecef; /* Garis pemisah antar baris */
}

.table tbody tr:hover {
    background-color: #f1f1f1; /* Warna latar belakang saat hover */
}

.btn {
    border-radius: 25px; /* Sudut tombol melengkung */
    padding: 10px 20px; /* Padding tombol */
    font-weight: 600; /* Tebalkan teks tombol */
}

.btn-primary {
    background-color: #0056b3; /* Warna tombol utama */
    border: none; /* Menghilangkan border */
}

.btn-warning {
    background-color: #ffc107; /* Warna tombol edit */
}

.btn-danger {
    background-color: #dc3545; /* Warna tombol hapus */
}

.btn:hover {
    filter: brightness(0.9); /* Efek gelap saat hover */
}

.alert {
    margin-bottom: 20px; /* Jarak bawah untuk alert */
}

.text-center {
    text-align: center; /* Rata tengah untuk teks */
}
header {
    background-color: #007bff; /* Warna latar belakang biru */
}

footer {
    background-color: #f8f9fa; /* Warna latar belakang abu-abu muda */
    border-top: 1px solid #e9ecef; /* Garis atas untuk pemisah */
}

    </style>

</head>
<body>
@yield('content')
 <script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstr
ap.bundle.min.js" integrity="sha384-
YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous"><script>
</body>
</html>