<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    
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
    </style>
</head>

<body class="animated-bg flex items-center justify-center min-h-screen">

    <form action="{{ route('user.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative">
        @csrf

        <div class="absolute top-[-50px] left-[50%] transform -translate-x-[50%] bg-white rounded-full p-3 shadow-md">
            <i class="fas fa-user-plus text-purple-500 text-4xl"></i>
        </div>

        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Create User</h2>

        <div class="mb-6">
            <label for="nama" class="block text-gray-700 mb-2 font-medium">Nama:</label>
            <div class="flex items-center border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-purple-500">
                <span class="px-3 text-gray-500">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text" id="nama" name="nama" class="w-full px-3 py-2 focus:outline-none rounded-r-lg" placeholder="Masukkan nama" value="{{ old('nama') }}">
            </div>
            @if ($errors->has('nama'))
                <p class="text-red-500 text-sm mt-1">{{ $errors->first('nama') }}</p>
            @endif
        </div>

        <div class="mb-6">
            <label for="npm" class="block text-gray-700 mb-2 font-medium">NPM:</label>
            <div class="flex items-center border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-purple-500">
                <span class="px-3 text-gray-500">
                    <i class="fas fa-id-card"></i>
                </span>
                <input type="text" id="npm" name="npm" class="w-full px-3 py-2 focus:outline-none rounded-r-lg" placeholder="Masukkan NPM" value="{{ old('npm') }}">
            </div>
            @if ($errors->has('npm'))
                <p class="text-red-500 text-sm mt-1">{{ $errors->first('npm') }}</p>
            @endif
        </div>

        <div class="mb-6">
            <label for="kelas_id" class="block text-gray-700 mb-2 font-medium">Kelas:</label>
            <div class="flex items-center border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-purple-500">
                <span class="px-3 text-gray-500">
                    <i class="fas fa-school"></i>
                </span>
                <select id="kelas_id" name="kelas_id" class="w-full px-3 py-2 focus:outline-none rounded-r-lg" required>
                    <option>Pilih Kelas</option>
                    @foreach ($kelas as $kelasItem)
                    <option value="{{$kelasItem->id}}" {{ old('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                        {{$kelasItem->nama_kelas}}
                    </option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('kelas_id'))
                <p class="text-red-500 text-sm mt-1">{{ $errors->first('kelas_id') }}</p>
            @endif
        </div>

        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition ease-in-out duration-300">
            <i class="fas fa-paper-plane"></i> Simpan
        </button>
    </form>

</body>


</html>
