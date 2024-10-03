<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f4f6; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            position: relative; 
        }

        .profile-container {
            background-color: white;
            padding: 40px;
            border-radius: 50px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .profile-container img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #6C63FF; 
        }

        .profile-container .info {
            background-color: #EEF1FF; 
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            transition: background-color 0.3s ease;
        }

        .profile-container .info:hover {
            background-color: #dfe3ff; 
        }

        .profile-container .info strong {
            display: block;
            font-size: 1.2rem;
            color: #6C63FF; 
        }

        .profile-container .info .detail {
            font-size: 1.1rem;
            color: #4A4A4A; 
        }

        .btn-custom {
            background-color: #6C63FF; 
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #5a55d6;
        }

        .social-icons {
            position: absolute;
            left: 20px; 
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .social-icons a {
            margin: 10px 0;
            font-size: 2rem;
            color: #6C63FF;
            transition: color 0.3s ease, transform 0.3s ease;
            text-decoration: none; 
        }

        .social-icons a:hover {
            color: #5a55d6;
            transform: scale(1.1); /
        }
    </style>
</head>
<body>


    <div class="social-icons">
        <a href="https://instagram.com" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://github.com" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
        <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
    </div>

    <!-- Profile container -->
    <div class="profile-container">
        <img src="{{ asset('img/PHOTO.JPG') }}" alt="Profile Image">
        <p style="font-weight:bold;">Mahasiswa Ilmu Komputer 2022</p>
        <div class="info">
            <strong>Nama</strong>
            <span class="detail">{{ $nama }}</span>
        </div>
        
        <div class="info">
            <strong>Kelas</strong>
            <span class="detail">{{ $kelas ?? 'kelas tidak ditemukan' }}</span>
        </div>

        <div class="info">
            <strong>NPM</strong>
            <span class="detail">{{ $npm }}</span>
        </div>
        
        <a href="{{ route('user.index') }}" class="btn btn-custom mt-3">Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
