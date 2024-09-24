<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas; 
use App\Models\UserModel;

class UserController extends Controller
{
    public function profile($nama = "", $kelas = "", $npm = "")
    {
        $data = [
            'nama' => $nama ,
            'kelas' => $kelas ,
            'npm' => $npm  
        ];
      
        return view('profile', $data);
    }

   
    public function create()
    {
        return view('create_user', ['kelas' => Kelas::all()]);
    }
    
   
    public function store(Request $request)
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
    
    
        $user = UserModel::create($validatedData);
    
   
        $user->load('kelas');
    
        return redirect()->route('user.profile', [
            'nama' => $user->nama,
            'npm' => $user->npm,
            'kelas' => $user->kelas->nama_kelas ?? 'kelas tidak ditemukan',
        ]);
    }
}
