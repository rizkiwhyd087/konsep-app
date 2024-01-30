@include('structure.header')
@include('structure.navbarPenyelenggara')
<!-- gray bg -->
<!-- Button trigger modal -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container" style="height: 600px;">
        <br><br><br>
        <h2 class="text-center"><b>DATA TRANSAKSI</b></h2>
        <hr>
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Konser</th>
                    <th>Nama Pembeli</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($dataTransaksi as $dt) {
                    if ($dt->status == 'Berhasil') {
                        $warna = "success";
                        $ket = "BERHASIL";
                        $a = "selected";
                        $b = "";
                        $c = "";
                    } else if ($dt->status == 'Proses') {
                        $warna = "warning";
                        $ket = "PROSES";
                        $a = "";
                        $b = "selected";
                        $c = "";
                    } else {
                        $warna = "danger";
                        $ket = "GAGAL";
                        $a = "";
                        $b = "";
                        $c = "selected";
                    }
                ?>
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ date('d-m-Y', strtotime($dt->tanggal)) }}</td>
                        <td>{{ $dt->nama_konser }}</td>
                        <td>{{ $dt->name }}</td>
                        <td>{{ $dt->qty }}</td>
                        <td>Rp. {{ number_format($dt->total, 2, ',', '.') }}</td>
                        <td><span class='badge bg-{{$warna}}'>{{$ket}}</span></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $dt->id_transaksi }}">
                                <span class="fa fa-info-circle"></span>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $dt->id_transaksi }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Detail Transaksi</b></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/penyelenggara/updateTransaksi" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Bukti Transfer</b></label>
                                                            <img src="/assets/img/transfer/{{$dt->transfer}}" class="card-img-top" alt="..." style="height: 300px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-8" style="border-left: 1px solid black;">
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Nama Konser</b></label>
                                                            <input type="text" class="form-control" id="nama_konser" name="nama_konser" value="{{ $dt->nama_konser }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Nama</b></label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $dt->name }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Harga Tiket</b></label>
                                                            <input type="number" class="form-control" id="harga" name="harga" value="{{ $dt->harga }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Qty</b></label>
                                                            <input type="number" class="form-control" id="qty" name="qty" value="{{ $dt->qty }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Total</b></label>
                                                            <input type="number" class="form-control" id="total" name="total" value="{{ $dt->total }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Status</b></label>
                                                            <select class="form-select" name="status" id="status">
                                                                <option value="Berhasil" {{$a}}>Berhasil</option>
                                                                <option value="Proses" {{$b}}>Proses</option>
                                                                <option value="Gagal" {{$c}}>Gagal</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="id_transaksi" value="{{ $dt->id_transaksi }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });
</script>
@include('structure.footer')