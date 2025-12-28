<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
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

    protected function casts(): array
    {
        return [
            'tanggal_lahir'     => 'date',
            'tanggal_bergabung' => 'date',
            'status_aktif'      => 'boolean',
            'kata_sandi'        => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

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
                    ->withPivot(['besar_donasi', 'tanggal_donasi']);
    }

    public function riwayatDonasi()
    {
        return $this->hasMany(RiwayatDonasi::class, 'id_jamaah', 'id_jamaah');
    }

    public function isAdmin()
    {
        return $this->kategori()
                    ->where(function($query) {
                        $query->where('nama_kategori', 'Admin Masjid')
                              ->orWhere('nama_kategori', 'Pengurus DKM');
                    })
                    ->wherePivot('status_aktif', true)
                    ->exists();
    }
}
