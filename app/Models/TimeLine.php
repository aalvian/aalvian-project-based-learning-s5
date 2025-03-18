<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Timeline extends Model
{
    use HasFactory;

    protected $table = 'time_lines';
    protected $primaryKey = "id_timeline";
    protected $fillable = [
        'nama',
        'waktu_mulai',
        'waktu_berakhir',
        'status',
    ];

    public static function timeline_index(){
        $dtTimeLine1 = timeLine::find(1);
        $dtTimeLine2 = timeLine::find(2);
        $status1 = $dtTimeLine1->status;
        $status2 = $dtTimeLine2->status;
        return view('admin.timeline.timeLine', compact('dtTimeLine1','dtTimeLine2','status1','status2'));
    }

    public static function timeline_update(Request $request, $id){
        // Validasi input
        $validator = Validator::make($request->all(), [
            'waktu_mulai' => 'required|date|before:waktu_berakhir',
            'waktu_berakhir' => 'required|date|after:waktu_mulai',
            'status' => 'required|in:0,1',
        ],
        ['waktu_mulai.before' => 'Waktu mulai harus sebelum waktu selesai.',]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Validasi apakah timeline saling beda
        $timeline_1 = Timeline::find(1);
        $timeline_2 = Timeline::find(2);
        if ($id == 1){
            if ($request->waktu_mulai <= $timeline_2->waktu_berakhir && $request->waktu_berakhir >= $timeline_2->waktu_mulai) {
                return back()->withErrors(['error' => 'Tanggal antara gelombang tidak boleh sama.'])->withInput();
            }
            }elseif ($id == 2){
            if($request->waktu_mulai <= $timeline_1->waktu_berakhir && $request->waktu_berakhir >= $timeline_1->waktu_mulai) {
                return back()->withErrors(['error' => 'Tanggal antara gelombang tidak boleh sama.'])->withInput();
            }
        }
        // Update data timeline
        $timeline = TimeLine::find($id);
        $timeline->waktu_mulai = $request->waktu_mulai;
        $timeline->waktu_berakhir = $request->waktu_berakhir;
        $timeline->status = $request->status;
        $timeline->save();

        // Redirect ke halaman timeline dengan pesan sukses
        if ($request->status == 0) {
            return redirect(route('view-timeLine'))->with('toast_error', 'Pendaftaran di non-aktifkan');
        } else {
            return redirect()->route('view-timeLine')->with('toast_success', 'Pendaftaran Diaktifkan');
        }
    }

    public static function timeline_user(){
        $currentDate = Carbon::now()->format('Y-m-d');
        $gelombang_1 = Timeline::find(1);
        $gelombang_2 = Timeline::find(2);

        return view('home.main', compact(
            'currentDate',
            'gelombang_1',
            'gelombang_2',
        ));
    }
}
