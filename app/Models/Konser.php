<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Konser extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'konser';
    protected $primaryKey = 'id_konser';

    protected $fillable = [
        'id_user',
        'nama_konser',
        'tanggal_konser',
        'lokasi',
        'harga',
        'tiket',
        'image',
        'jenis_bank',
        'atas_nama',
        'rekening',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
