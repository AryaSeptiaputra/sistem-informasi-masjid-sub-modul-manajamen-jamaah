<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;

    protected $table = 'jamaah';
    protected $primaryKey = 'id_jamaah';

    protected $fillable = [
        'username',
        'nama_lengkap',
        'kata_sandi',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_handphone',
        'tanggal_bergabung',
        'status_aktif',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    protected $casts = [
        'tanggal_lahir'    => 'date',
        'tanggal_bergabung'=> 'date',
        'status_aktif'     => 'boolean',
    ];

    // Relasi ke kategori_jamaah (many-to-many)
    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_jamaah', 'id_jamaah', 'id_kategori')
                    ->withPivot(['status_aktif', 'periode']);
    }

    // Relasi ke keikutsertaan_kegiatan
    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class, 'keikutsertaan_kegiatan', 'id_jamaah', 'id_kegiatan')
                    ->withPivot(['tanggal_daftar', 'status_kehadiran']);
    }

    // Relasi ke riwayat_donasi
    public function donasi()
    {
        return $this->belongsToMany(Donasi::class, 'riwayat_donasi', 'id_jamaah', 'id_donasi')
                    ->withPivot(['besar_donasi', 'tanggal_donasi']);
    }
}
