<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel.
     * Sesuai dengan Modul 9 [cite: 117] dan db_rshp2.sql.
     */
    protected $table = 'pemilik';

    /**
     * Menentukan primary key tabel.
     * Sesuai dengan Modul 9 [cite: 119] dan db_rshp2.sql.
     */
    protected $primaryKey = 'idpemilik';

    /**
     * Kolom yang boleh diisi.
     * (Modifikasi dari Modul 9[cite: 121], ditambahkan 'iduser' 
     * agar sesuai dengan Controller dan db_rshp2.sql)
     */
    protected $fillable = ['no_wa', 'alamat', 'iduser'];

    /**
     * PENTING: Model ini tidak menggunakan timestamps.
     * Sesuai dengan tabel di db_rshp2.sql.
     */
    public $timestamps = false;

    /**
     * Relasi ke model User.
     * Menandakan bahwa satu Pemilik 'dimiliki oleh' satu User.
     * Sesuai dengan Modul 9 [cite: 124-130].
     */
    public function user()
    {
        // Parameter: (Model Tujuan, Foreign Key di tabel ini, Primary Key di tabel tujuan)
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}