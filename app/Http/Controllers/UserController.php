<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Fakultas;
use App\Models\UserModel;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk mempermudah penanganan file

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {

        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index()
    {
      
        $users = $this->userModel->getUserWithRelations();

     
        return view('list_user', ['users' => $users]);
    }

    public function create()
    {
        $kelas = $this->kelasModel->getKelas();
        $jurusan = Jurusan::all(); 
        $fakultas = Fakultas::all(); 
    
        $data = [
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'fakultas' => $fakultas,
        ];
        return view('create_user', $data);
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);
    
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|digits:10',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user->nama = $request->nama;
        $user->npm = $request->npm;
        $user->kelas_id = $request->kelas_id;
        $user->jurusan_id = $request->jurusan_id;
    
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
    
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $user->foto = $filePath;
        }
    
        $user->save();
    
        return redirect()->route('user.index')->with('success', 'User berhasil diupdate.');
    }
    
    
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'npm' => 'required|digits:10|unique:user,npm', // Correct the table name here if needed
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.regex' => 'Nama hanya boleh mengandung huruf.',
            'npm.digits' => 'NPM harus 10 digit angka.',
            'npm.unique' => 'NPM sudah ada dalam sistem.',
            'kelas_id.required' => 'Kelas harus dipilih.',
            'jurusan_id.required' => 'Jurusan harus dipilih.',
        ]);
    
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('uploads', 'public');
        } else {
            $fotoPath = null;
        }
    
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'jurusan_id' => $request->input('jurusan_id'),
            'foto' => $fotoPath,
        ]);
    
        return redirect()->route('user.index')->with('success', 'User baru berhasil ditambahkan.');
    }
    

    public function profile($nama = "", $kelas = "", $npm = "")
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
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
        $jurusan = Jurusan::all(); 
        $fakultas = Fakultas::all(); 
    
        return view('edit_user', compact('user', 'kelas', 'jurusan', 'fakultas'));
    }

    public function show($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = $user->kelas ? $user->kelas->nama_kelas : null; 
        $jurusan = $user->jurusan ? $user->jurusan->nama_jurusan : null; 
        
        return view('profile', ['user' => $user, 'kelas' => $kelas,'jurusan' => $jurusan]);
    }
    
    
}
