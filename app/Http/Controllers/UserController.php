<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas; 
use App\Models\UserModel;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    // Method untuk menampilkan daftar user
    public function index()
    {
        // Ambil data users dari model
        $users = $this->userModel->getUser();

        // Kirim data users ke view 'list_user'
        return view('list_user', ['users' => $users]);
    }

    public function create()
    {
     $kelasModel = new Kelas();
     $kelas = $this->kelasModel->getKelas();


     $data = [
     'kelas' => $kelas,
     ];
     return view('create_user', $data);
    } 
    
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'npm' => 'required|digits:10',
        'kelas_id' => 'required|exists:kelas,id',
    ], [
        'nama.regex' => 'Nama hanya boleh mengandung huruf.',
        'npm.digits' => 'NPM harus 10 digit angka.',
        'kelas_id.required' => 'Kelas harus dipilih.',
    ]);

    // Update user
    $user = UserModel::findOrFail($id);
    $user->update($validatedData);

    return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
}

public function store(Request $request)
{
    // Validasi data yang diterima
    $validatedData = $request->validate([
        'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'npm' => 'required|digits:10',
        'kelas_id' => 'required|exists:kelas,id',
    ], [
        'nama.regex' => 'Nama hanya boleh mengandung huruf.',
        'npm.digits' => 'NPM harus 10 digit angka.',
        'kelas_id.required' => 'Kelas harus dipilih.',
    ]);

    // Simpan user baru
    $this->userModel->create($validatedData);

    return redirect()->route('user.index')->with('success', 'User baru berhasil ditambahkan.');
}


    public function profile($nama = "", $kelas = "", $npm = "")
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm
        ];
      
        return view('profile', $data);
    }

    public function destroy($id)
{
  
    $user = UserModel::findOrFail($id);
    $user->delete();
    return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
}

public function edit($id)
{
   
    
    $user = UserModel::findOrFail($id);
    $kelas = $this->kelasModel->getKelas(); 
    return view('edit_user', compact('user', 'kelas'));
}


}
