<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permintaan;

class DraftPermintaan extends Model
{
    use HasFactory;
    protected $table='draft_permintaan';
    protected $fillable=['approval'];

    public function permintaan()
    {
        return $this->belongsto(Permintaan::class);
    }
}
