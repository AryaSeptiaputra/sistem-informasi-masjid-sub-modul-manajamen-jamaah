<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = [
        'nama_kategori',
        'tanggal',
        'lokasi',
        'status_kegiatan',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function jamaah()
    {
        return $this->belongsToMany(Jamaah::class, 'keikutsertaan_kegiatan', 'id_kegiatan', 'id_jamaah')
                    ->withPivot(['tanggal_daftar', 'status_kehadiran']);
    }
}
