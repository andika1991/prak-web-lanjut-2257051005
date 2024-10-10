<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk mempermudah penanganan file

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ], [
            'nama.regex' => 'Nama hanya boleh mengandung huruf.',
            'npm.digits' => 'NPM harus 10 digit angka.',
            'kelas_id.required' => 'Kelas harus dipilih.',
        ]);

        $user = UserModel::findOrFail($id);


        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
         
            $fotoPath = $foto->store('img', 'public');
        } else {

            $fotoPath = $user->foto;
        }

      
        $user->update([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'foto' => $fotoPath,
        ]);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'npm' => 'required|digits:10|unique:user,npm',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ], [
            'nama.regex' => 'Nama hanya boleh mengandung huruf.',
            'npm.digits' => 'NPM harus 10 digit angka.',
            'npm.unique' => 'NPM sudah ada dalam sistem.',
            'kelas_id.required' => 'Kelas harus dipilih.',
        ]);

     
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            
            $fotoPath = $foto->store('uploads/img', 'public');
        } else {
            $fotoPath = null; 
        }

    
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'foto' => $fotoPath,
        ]);

        return redirect()->route('user.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function profile($nama = "", $kelas = "", $npm = "")
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm,
        ];

        return view('profile', $data);
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        
        
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
    }

    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = $this->kelasModel->getKelas();
        return view('edit_user', compact('user', 'kelas'));
    }

    public function show($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = $user->kelas ? $user->kelas->nama_kelas : null; 
        
        return view('profile', ['user' => $user, 'kelas' => $kelas]);
    }
    
    
}
