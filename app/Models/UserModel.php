<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user'; 

    protected $fillable = [
        'nama',
        'npm',
        'kelas_id',
        'jurusan_id',
        'foto',
    ];

    protected $guarded = ['id'];

   
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

   
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

   
    public function fakultas()
    {
        return $this->hasOneThrough(
            Fakultas::class,
            Jurusan::class,
            'id', 
            'id', 
            'jurusan_id', 
            'fakultas_id' 
        );
    }

    
    public function getUserWithRelations()
    {
        return $this->with(['kelas', 'jurusan.fakultas'])->get(); 
    }

   
    public function getUser()
    {
        return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
            ->select('user.*', 'kelas.nama_kelas as nama_kelas')
            ->orderBy('user.created_at', 'desc')
            ->get();
    }

    
    public function getUserDetail($id = null)
    {
        if ($id != null) {
            return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                ->select('user.*', 'kelas.nama_kelas as nama_kelas')
                ->where('user.id', $id)
                ->first();
        }
        return null;
    }
}
