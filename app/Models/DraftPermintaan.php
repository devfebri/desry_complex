<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permintaan;

class DraftPermintaan extends Model
{
    use HasFactory;
    protected $table='draft_permintaan';
    protected $fillable=['approval_manager_it','approval_senior_manager_it','draft_id','permintaan_id','status'];

    public function permintaan()
    {
        return $this->belongsto(Permintaan::class);
    }
}
