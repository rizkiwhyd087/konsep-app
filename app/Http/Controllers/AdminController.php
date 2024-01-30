<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $data = array(
                'title' => 'Beranda',
                'pages' => 'beranda',
                'name' => Auth::user()->name
            );
            return view('admin.beranda', $data);
        }
    }

    public function dataKonser()
    {
        $data = array(
            'title' => 'Data Konser',
            'pages' => 'dataKonser',
            'id' => Auth::user()->id_user,
            'dataKonser' => Konser::all(),
        );
        return view('admin.dataKonser', $data);
    }

    public function tambahKonser(Request $request)
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

        return redirect('/admin/konser');
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

        return redirect('/admin/konser');
    }

    public function deleteKonser(Request $request)
    {
        $image_name = $request->image;
        $image_path = public_path('assets/img/poster/' . $image_name);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        Konser::where('id_konser', $request->id_konser)->delete();
        return redirect('/admin/konser');
    }

    public function dataTransaksi()
    {
        $data = array(
            'title' => 'Data Transaksi',
            'pages' => 'dataTransaksi',
            'name' => Auth::user()->name,
            'dataTransaksi' => DB::table('transaksi')
                ->join('users', 'transaksi.id_user', '=', 'users.id_user')
                ->join('konser', 'transaksi.id_konser', '=', 'konser.id_konser')
                ->orderBy('tanggal', 'desc')
                ->get(),
        );
        return view('admin.dataTransaksi', $data);
    }

    public function updateTransaksi(Request $request)
    {
        Transaksi::where('id_transaksi', $request->id_transaksi)
            ->where('id_transaksi', $request->id_transaksi)
            ->update([
                'status' => $request->status,
            ]);

        return redirect('/admin/transaksi');
    }

    public function dataPembeli()
    {
        $data = array(
            'title' => 'Data Pembeli',
            'pages' => 'dataPembeli',
            'name' => Auth::user()->name,
            'dataPembeli' => DB::table('users')
                ->where('role', 'pembeli')
                ->get(),
        );
        return view('admin.dataPembeli', $data);
    }
}
