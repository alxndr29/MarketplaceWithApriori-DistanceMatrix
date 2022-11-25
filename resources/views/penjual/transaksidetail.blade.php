@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Detail Transaksi Transaksi</small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Basic Tables <small>basic table subtitle</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        Data Pemesan:
                        <br>
                        Nama: {{$datapemesan->name}}
                        <br>
                        Email: {{$datapemesan->email}}
                    </div>
                    <div class="col-md-4 col-sm-6">
                        Data Alamat:
                        <br>
                        Alamat Lengkap: {{$dataalamat->alamat_lengkap}}
                        <br>
                        Nama Penerima: {{$dataalamat->nama_penerima}}
                        <br>
                        Telepon: {{$dataalamat->telepon}}
                        <br>
                        Kota: {{$dataalamat->kabupaten}}
                        <br>
                        Provinsi: {{$dataalamat->provinsi}}
                    </div>
                    <div class="col-md-4 col-sm-6">
                        Data Pesanan:
                        <br>
                        Tanggal: {{$datapemesan->tanggal}}
                        <br>
                        ID Transaksi: {{$datapemesan->idtransaksi}}
                        <br>
                        Status: {{$datapemesan->status}}
                        <br>
                        Pembayaran: {{$datapemesan->pembayaran}}
                        <br>
                        Pengiriman: {{$datapemesan->pengiriman}}
                        <br>
                        Total: Rp. {{number_format($datapemesan->total)}}
                        <br>
                        Diskon: RP. {{number_format($datapemesan->nilai_potongan)}}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        Daftar Barang:
                        <table class="table" id='datatable-1'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($databarang as $key => $value)
                                <tr>
                                    <td>{{$key +1 }}</td>
                                    <td>{{$value->nama}}</td>
                                    <td>{{$value->jumlah / $value->qty}}</td>
                                    <td>{{$value->qty}}</td>
                                    <td>Rp. {{number_format($value->jumlah)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Produk</td>
                                    <td>Rp. {{number_format($datapemesan->total)}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Ongkir</td>
                                    <td>Rp. {{number_format($datapemesan->onkir)}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Seluruh</td>
                                    <td>Rp. {{number_format($datapemesan->total + $datapemesan->onkir)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if($datapemesan->status == "Menunggu Konfirmasi")
                        <a href="{{route('seller.transaksistatus',['id' => $datapemesan->idtransaksi, 'status' => 'Pesanan Diproses'])}}" class="btn btn-primary">Pesanan Diproses</a>
                        <a href="{{route('seller.transaksistatus',['id' => $datapemesan->idtransaksi, 'status' => 'Batal'])}}" class="btn btn-danger">Batal</a>
                        @endif

                        @if($datapemesan->status == "Pesanan Diproses")
                        @if ($datapemesan->pengiriman == "ambil_sendiri")
                        <a href="{{route('seller.transaksistatus',['id' => $datapemesan->idtransaksi, 'status' => 'Pesanan Siap Diambil'])}}" class="btn btn-primary">Pesanan Siap Diambil</a>
                        @else
                        <a href="{{route('seller.transaksistatus',['id' => $datapemesan->idtransaksi, 'status' => 'Pesanan Dikirim'])}}" class="btn btn-primary">Pesanan Dikirim</a>
                        @endif
                        @endif

                        @if ($datapemesan->status == "Pesanan Siap Diambil")
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Beritahu Pelanggan
                        </button>
                        @endif
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-chat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" action="{{route('seller.notifpesan')}}">
                @csrf
                <div class="modal-header">
                    Send Message:
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kepada: </label>
                        <input type="text" class="form-control" readonly value="{{$datapemesan->name}}">
                        <input type="hidden" class="form-control" readonly value="{{$datapemesan->id}}" name="idpembeli">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea class="form-control" rows="3" name="pesan">Pesanan anda dengan ID Transaksi: "{{$datapemesan->idtransaksi}}" Siap Diambil.</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Chat -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="p1">
                        <a class="btn btn-primary" href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to={{$datapemesan->email}}&body=Pesanan Anda Dengan Nomor Transaksi {{$datapemesan->id}} Sudah Dapat Diambil&su=SU">Via Email</a>
                    </div>
                    <div class="p1">
                        <a class="btn btn-primary" href="https://wa.me/62{{$datapemesan->telepon}}?text=Pesanan%Anda%Dengan%Nomor%Transaksi%{{$datapemesan->id}}%Sudah%Dapat%Diambil">Via WhatsApp</a>
                    </div>
                    <div class="p1">
                        <button class="btn btn-primary" onClick="modalChat()">Via Chat</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('anotherjs')
<script type="text/javascript">
    $(document).ready(function() {
        console.log('hello world!');
        // $('#datatable-1').DataTable();
    });
    function modalChat(){
        $("#exampleModalCenter").modal('hide');
        $("#modal-chat").modal('show');
    }
</script>
@endsection