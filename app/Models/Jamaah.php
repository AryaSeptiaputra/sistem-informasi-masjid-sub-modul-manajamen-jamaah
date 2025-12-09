<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    protected $table = 'jamaah';
    protected $primaryKey = 'id_jamaah';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'nama_lengkap',
        'kata_sandi',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_handphone',
        'tanggal_bergabung',
        'status_aktif'
    ];

    protected $hidden = ['kata_sandi'];

    // RELASI (Boleh tetap ada, tidak mengganggu auth)
    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_jamaah', 'id_jamaah', 'id_kategori')
                    ->withPivot(['status_aktif', 'periode']);
    }

    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class, 'keikutsertaan_kegiatan', 'id_jamaah', 'id_kegiatan')
                    ->withPivot(['tanggal_daftar', 'status_kehadiran']);
    }

    public function donasi()
    {
    return $this->belongsToMany(Donasi::class, 'riwayat_donasi', 'id_jamaah', 'id_donasi')
                ->withPivot(['jumlah', 'tanggal_donasi']);
    }
}
