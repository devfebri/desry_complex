<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DraftPermintaan;

class Draft extends Model
{
    use HasFactory;
    protected $table='draft';
    protected $fillable=['npp','user_id','nama','devisi','sub_devisi','keterangan','approval_manager','approval_senior_manager','approval_manager_it','approval_senior_manager_it','status'];
     
    public function draftpermintaan()
    {
        return $this->belongsTo(DraftPermintaan::class);
    }
}
