@extends("master_lte")
@section("title-page", "Ubah Master Jenis Kerjasama")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Jenis Kerjasama
    <small>Ubah Master Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('Jenis Kerjasama') }}"><i class="fa fa-tags"></i> Jenis Kerjasama</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Master Jenis Kerjasama</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Jenis Kerjasama</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nama_jenis_kerjasama" autocomplete=off class='control-label'>Nama Jenis Kerjasama <span class='text-danger'>*</span></label>
                <input type="text" placeholder="Entri Jenis Kerjasama" value="{{ $data->nama_jenis_kerjasama }}"  name='nama_jenis_kerjasama' id='nama_jenis_kerjasama' class='form-control FormIsi'>
            </div>
            <div class="form-group">
                <label for="deskripsi" class='control-label'>Deskpripsi</label>
                <textarea type="text" placeholder="Entri Penjelasan Jenis Kerjasama"  name='deskripsi' id='deskripsi' class='form-control' rows='8'>{{ $data->deskripsi }}</textarea>
            </div>

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('jenis-ks') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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
            url		: "{{ url('jenis-ks/update/'.$id) }}",
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
                        window.location.href = "{{ url('jenis-ks') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('jenis-ks') }}";
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