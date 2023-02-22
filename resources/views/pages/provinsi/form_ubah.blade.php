@extends("master_lte")
@section("title-page", "Ubah Master Provinsi")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Provinsi
    <small>Ubah Master Provinsi</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('provinsi') }}"><i class="fa fa-tags"></i> Provinsi</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Master Provinsi</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Provinsi</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nama_provinsi" autocomplete=off class='control-label'>Nama Provinsi <span class='text-danger'>*</span></label>
                <input type="text" placeholder="Entri Nama Provinsi" value="{{ $data->nama_provinsi }}" name='nama_provinsi' id='nama_provinsi' class='form-control FormIsi'>
            </div>
            <div class="form-group">
                <label for="deskripsi" class='control-label'>Deskripsi</label>
                <textarea type="text" placeholder="Entri Deskripsi"  name='deskripsi' id='deskripsi' class='form-control' rows='5'>{{ $data->deskripsi }}</textarea>
            </div>

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('provinsi') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
            </div>

        </form>
    </div><!-- /.box-body -->
   
</div><!-- /.box -->
</div>
</div>
@endsection

@section('script')
<script>
 
    $("#FormData").submit(function(e){
        e.preventDefault();
        SubmitData();
    })


    function SubmitData() {
        var idata =new FormData($('#FormData')[0]);
        $.ajax({
            type	: "POST",
            dataType: "json",
            url		: "{{ url('provinsi/update/'.$id) }}",
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
                        window.location.href = "{{ url('provinsi') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('provinsi') }}";
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