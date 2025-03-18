<?php


namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    
    protected $table = 'pengembalians';
    protected $primaryKey = "id_pengembalian";
    protected $fillable = [
        'id_pengembalian',
        'id_peminjaman',
        'tggl_kembali',
        'image',
        'petugas_id'
    ];

    public static function kembali(Request $request)
    {
        // user login
        $userId = Auth::id();

        // Validasi input dari request
        $validatedData = $request->validate([
            'id_peminjaman' => 'required|exists:peminjamans,id_peminjaman', 
            'tggl_kembali' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        
        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'public/pengembalian' dan simpan path-nya di $validatedData['image']
            $path = $request->file('image')->store('public/pengembalian');
            
            // Simpan path relatif (tanpa 'public/') ke dalam database
            $validatedData['image'] = str_replace('public/', '', $path);
        }

        // Menambahkan ID petugas ke dalam data yang divalidasi
        $validatedData['petugas_id'] = $userId;

        // buat pengembalian
        $pengembalian = self::create($validatedData);

        // Ubah status to 'dikembalikan' agar tidak tampil lagi di view peminjaman
        $peminjaman = Peminjaman::find($validatedData['id_peminjaman']);
        if ($peminjaman) {
            $peminjaman->status = 'dikembalikan';
            $peminjaman->save();

            // ubah stok alat
            $alat = Alat::find($peminjaman->id_alat); 
            if ($alat) {
                $alat->stok += $peminjaman->jml_alat; //kembalikan jumlah alat yang dikembalikan oleh stok
                $alat->save();
            }
        }

        return $pengembalian;
    }
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

    
}