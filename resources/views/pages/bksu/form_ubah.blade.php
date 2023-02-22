@extends("master_lte")
@section("title-page", "Ubah Master Bentuk Kerja Sama Umum")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Bentuk Kerja Sama Umum
    <small>Ubah Master Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('Bentuk Kerja Sama Umum') }}"><i class="fa fa-tags"></i> Bentuk Kerja Sama Umum</a></li>
    <li class="active"><i class="fa fa-plus-square"></i> Ubah Master Bentuk Kerja Sama Umum</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-plus-square text-success'></i> Ubah Data Bentuk Kerjasama Umum</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nama_bentuk_kerjasam_umum" autocomplete=off class='control-label'>Nama Bentuk Kerjasama Umum <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->nama_bentuk_kerjasam_umum }}" placeholder="Entri Bentuk Kerjasama Umum" name='nama_bentuk_kerjasam_umum' id='nama_bentuk_kerjasam_umum' class='form-control FormIsi'>
            </div>
            <div class="form-group">
                <label for="penjelasan_bentuk_kerjasam_umum" class='control-label'>Penjelasan Bentuk Kerjasama Umum</label>
                <textarea type="text" placeholder="Entri Penjelasan Bentuk Kerjasama Umum"  name='penjelasan_bentuk_kerjasam_umum' id='penjelasan_bentuk_kerjasam_umum' class='form-control' rows='8'>{{ $data->penjelasan_bentuk_kerjasam_umum }}</textarea>
            </div>

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('bksu') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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
            url		: "{{ url('bksu/update/'.$id) }}",
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
                        window.location.href = "{{ url('bksu') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('bksu') }}";
                    });
                }
            },
            error: function (error) {
                error_detail(error);
            }
        });
    }

  
</script>
@endsection