<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DraftPermintaan;

class Draft extends Model
{
    use HasFactory;
    protected $table='draft';
    protected $fillable = [
        'npp', 'user_id', 'nama', 'devisi', 'sub_devisi', 'keterangan', 
        'approval_manager', 'approval_senior_manager', 'approval_manager_it', 
        'approval_teknisi', 'approval_senior_manager_it', 'status', 'waktu_pengambilan',
        'tanggal_submit','tanggal_diambil','tanggal_approval_manager','tanggal_approval_sm',
        'tanggal_approval_manager_it','tanggal_approval_teknisi','tanggal_approval_sm_it',
        'ket_manager','ket_sm','ket_manager_it','ket_teknisi','ket_sm_it'
    ];


    protected $casts = [
        'waktu_pengambilan' => 'date',
        'tanggal_submit' => 'datetime',
        'tanggal_diambil'=>'datetime',
        'tanggal_approval_manager'=>'datetime',
        'tanggal_approval_sm'=>'datetime',
        'tanggal_approval_manager_it'=>'datetime',
        'tanggal_approval_teknisi'=>'datetime',
        'tanggal_approval_sm_it'=>'datetime',
    ];
    public function draftpermintaan()
    {
        return $this->belongsTo(DraftPermintaan::class);
    }
}
