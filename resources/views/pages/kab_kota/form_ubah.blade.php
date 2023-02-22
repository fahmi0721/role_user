@extends("master_lte")
@section("title-page", "Ubah Master Kabupaten / Kota")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Kabupaten / Kota
    <small>Ubah Master Kabupaten / Kota</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('kab-kota') }}"><i class="fa fa-tags"></i> Kabupaten / Kota</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Master Kabupaten / Kota</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Kabupaten / Kota</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUt")
            <div class="form-group">
                <label for="nama_kab_kota" autocomplete=off class='control-label'>Nama Kabupaten / Kota <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->nama_kab_kota }}" placeholder="Entri Nama Kabupaten / Kota" name='nama_kab_kota' id='nama_kab_kota' class='form-control'>
            </div>
            <div class="form-group">
                <label for="id_provinsi" autocomplete=off class='control-label'>Nama Provinsi <span class='text-danger'>*</span></label>
                <select name="id_provinsi" id="id_provinsi"  class="form-control select-provinsi">
                    <option value="">..:: Pilih Nama Provinsi ::..</option>
                    @foreach($provinsi as $key => $dt_provinsi)
                        <option  value="{{ $dt_provinsi->id }}" @if($data->id_provinsi == $dt_provinsi->id) selected @endif>{{ $dt_provinsi->nama_provinsi }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="deskripsi" class='control-label'>Deskripsi</label>
                <textarea type="text" placeholder="Entri Deskripsi"  name='deskripsi' id='deskripsi' class='form-control' rows='5'>{{ $data->deskripsi }}</textarea>
            </div>

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('kab-kota') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
            </div>

        </form>
    </div><!-- /.box-body -->
   
</div><!-- /.box -->
</div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.select-provinsi').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Provinsi',
        });

    });
 
    $("#FormData").submit(function(e){
        e.preventDefault();
        SubmitData();
    })


    function SubmitData() {
        var idata =new FormData($('#FormData')[0]);
        $.ajax({
            type	: "POST",
            dataType: "json",
            url		: "{{ url('kab-kota/update/'.$id) }}",
            data	: idata,
            processData: false,
            contentType: false,
            cache 	: false,
            beforeSend: function () { 
                // in_load();
            },
            success	:function(data) {
                if(data.status){
                    swal(
                    {
                            title: data.status,
                            text: data.messages,
                            type: "success",
                        },
                    function(){
                        window.location.href = "{{ url('kab-kota') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('kab-kota') }}";
                    });
                }
            },
            error: function (error) {
                error_detail(error);
            }
        });
    }

    function ubah_icon(str){
        $(".input-group-addon i").attr('class',str+" text-success");
    }
</script>
@endsection