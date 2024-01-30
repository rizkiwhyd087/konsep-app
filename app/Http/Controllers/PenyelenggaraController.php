<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\Transaksi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenyelenggaraController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'penyelenggara') {

            $data = array(
                'title' => 'Beranda',
                'pages' => 'beranda',
                'id' => Auth::user()->id_user,
                'name' => Auth::user()->name,
            );
            return view('penyelenggara.beranda', $data);
        }
    }

    public function dataKonser()
    {
        $data = array(
            'title' => 'Data Konser',
            'pages' => 'dataKonser',
            'id' => Auth::user()->id_user,
            'dataKonser' => DB::table('konser')
                ->where('id_user', Auth::user()->id_user)
                ->orderBy('created_at', 'desc')
                ->get(),
        );
        return view('penyelenggara.dataKonser', $data);
    }

    public function insertKonser(Request $request)
    {
        $file = $request->file('image');
        $tujuan_upload = 'assets/img/poster';
        $file->move($tujuan_upload, $file->getClientOriginalName());

        Konser::create([
            'id_user' => $request->id_user,
            'nama_konser' => $request->nama_konser,
            'tanggal_konser' => $request->tanggal_konser,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'tiket' => $request->tiket,
            'image' => $file->getClientOriginalName(),
            'jenis_bank' => $request->jenis_bank,
            'atas_nama' => $request->atas_nama,
            'rekening' => $request->rekening,
        ]);

        return redirect('/penyelenggara/dataKonser');
    }

    public function updateKonser(Request $request)
    {
        Konser::where('id_konser', $request->id_konser)
            ->where('id_konser', $request->id_konser)
            ->update([
                'nama_konser' => $request->nama_konser,
                'tanggal_konser' => $request->tanggal_konser,
                'lokasi' => $request->lokasi,
                'harga' => $request->harga,
                'tiket' => $request->tiket,
                'jenis_bank' => $request->jenis_bank,
                'atas_nama' => $request->atas_nama,
                'rekening' => $request->rekening,
            ]);

        return redirect('/penyelenggara/dataKonser');
    }

    public function deleteKonser(Request $request)
    {
        $image_name = $request->image;
        $image_path = public_path('assets/img/poster/' . $image_name);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        Konser::where('id_konser', $request->id_konser)->delete();
        return redirect('/penyelenggara/dataKonser');
    }

    public function dataTransaksi()
    {
        $data = array(
            'title' => 'Data Transaksi',
            'pages' => 'dataTransaksi',
            'id' => Auth::user()->id_user,
            'dataTransaksi' => DB::table('transaksi')
                ->join('users', 'transaksi.id_user', '=', 'users.id_user')
                ->join('konser', 'transaksi.id_konser', '=', 'konser.id_konser')
                ->where('konser.id_user', Auth::user()->id_user)
                ->orderBy('transaksi.created_at', 'desc')
                ->get(),
        );
        return view('penyelenggara.dataTransaksi', $data);
    }

    public function updateTransaksi(Request $request)
    {
        if ($request->status == "Berhasil") {
            QrCode::generate($request->id_transaksi, public_path('assets/img/qrcode/' . $request->id_transaksi . '.svg'));
        }

        Transaksi::where('id_transaksi', $request->id_transaksi)
            ->where('id_transaksi', $request->id_transaksi)
            ->update([
                'status' => $request->status,
                'qrcode' => $request->id_transaksi,
            ]);

        return redirect('/penyelenggara/dataTransaksi');
    }
}
