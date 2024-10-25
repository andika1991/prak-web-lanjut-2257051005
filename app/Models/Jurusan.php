<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';
    protected $guarded = ['id'];

    public function fakultas() {
        return $this->belongsTo(Fakultas::class, 'fakultas_id'); 
    }

    public function user() {
        return $this->hasMany(UserModel::class, 'jurusan_id'); 
    }

    public function getJurusanWithFakultas(){
       
        return $this->with('fakultas')->get();
    }
}
