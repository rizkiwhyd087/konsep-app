<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembeliController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'pembeli') {
            $data = array(
                'title' => 'Beranda',
                'pages' => 'beranda',
                'id' => Auth::user()->id_user,
                'name' => Auth::user()->name,
                'dataKonser' => Konser::all(),
            );
            return view('pembeli.beranda', $data);
        }
    }

    public function dataTiket()
    {
        $data = array(
            'title' => 'Data Tiket',
            'pages' => 'dataTiket',
            'name' => Auth::user()->name,
            'dataTiket' => DB::table('transaksi')
                ->join('users', 'transaksi.id_user', '=', 'users.id_user')
                ->join('konser', 'transaksi.id_konser', '=', 'konser.id_konser')
                ->where('transaksi.id_user', Auth::user()->id_user)
                ->orderBy('tanggal', 'desc')
                ->get(),
        );
        return view('pembeli.dataTiket', $data);
    }

    public function tambahTransaksi(Request $request)
    {
        $file = $request->file('transfer');
        $tujuan_upload = 'assets/img/transfer';
        $file->move($tujuan_upload, $file->getClientOriginalName());

        Transaksi::create([
            'id_konser' => $request->id_konser,
            'id_user' => $request->id_user,
            'qty' => $request->qty,
            'total' => $request->total,
            'tanggal' => date('Y-m-d'),
            'status' => 'Proses',
            'transfer' => $file->getClientOriginalName(),
            'qrcode' => '-',
        ]);

        return redirect('/pembeli');
    }
}
