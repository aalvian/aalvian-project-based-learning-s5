<?php

namespace App\Console\Commands;

use App\Models\Aktifasi;
use Carbon\Carbon;
use Illuminate\Console\Command;

class updateStatusPresensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:status-presensi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    // Mendapatkan waktu sekarang
    $currentDateTime = Carbon::now();

    // Ambil data yang waktu tenggatnya lebih kecil dari waktu sekarang
    $data = Aktifasi::where('status', 1)
        ->where('tenggat', '<', $currentDateTime) // Membandingkan tenggat dengan waktu sekarang
        ->get();

    // Update status menjadi 0 jika kondisi di atas terpenuhi
    foreach ($data as $item) {
        $item->update(['status' => 0]);
    }

    // Menampilkan informasi jika status berhasil diperbarui
    $this->info('Status diperbarui.');
}

}
