@extends('layouts.template-administrator')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Tarif Pengiriman</small></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="card">
    <div class="card-header">
       Form Atur Tarif Pengiriman
    </div>
    <div class="card-body">
        <form method="post" action="{{route('admin.onkirpost')}}">
            @csrf
            <div class="form-group row ">
                <label class="control-label col-md-3 col-sm-3 ">Tarif</label>
                <div class="col-md-9 col-sm-9 ">
                    <input type="number" class="form-control"  name="harga_ongkir" value="{{$data->harga_ongkir}}" required="">
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>

    </div>
    <div class="card-footer">

    </div>
</div>
@endsection

@section('anotherjs')
<script type="text/javascript">
    $(document).ready(function() {
        console.log('hello world!');
    });
</script>
@endsection