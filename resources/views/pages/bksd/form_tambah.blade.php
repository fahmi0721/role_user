@extends("master_lte")
@section("title-page", "Tambah Master Bentuk Kerja Sama Detail")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Bentuk Kerja Sama Detail
    <small>Tambah Master Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('Bentuk Kerja Sama Detail') }}"><i class="fa fa-tags"></i> Bentuk Kerja Sama Detail</a></li>
    <li class="active"><i class="fa fa-plus-square"></i> Tambah Master Bentuk Kerja Sama Detail</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-plus-square text-success'></i> Tambah Data Bentuk Kerjasama Detail</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            <div class="form-group">
                <label for="nama_bentuk_kerjasam_detail" autocomplete=off class='control-label'>Nama Bentuk Kerjasama Detail <span class='text-danger'>*</span></label>
                <input type="text" placeholder="Entri Bentuk Kerjasama Detail" name='nama_bentuk_kerjasam_detail' id='nama_bentuk_kerjasam_detail' class='form-control FormIsi'>
            </div>

            <div class="form-group">
                <label for="id_bentuk_kerjasama_umum" autocomplete=off class='control-label'>Bentuk Kerjasama Umum <span class='text-danger'>*</span></label>
                <select name="id_bentuk_kerjasama_umum" id="id_bentuk_kerjasama_umum"  class="form-control select-bksu">
                    <option value="">..:: Pilih Bentuk Kerjasama Umum ::..</option>
                    @foreach($bksu as $key => $dt_bksu)
                        <option  value="{{ $dt_bksu->id }}">{{ $dt_bksu->nama_bentuk_kerjasam_umum }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="rincian_bentuk_kerjasam_detail" class='control-label'>Penjelasan Bentuk Kerjasama Detail</label>
                <textarea type="text" placeholder="Entri Penjelasan Bentuk Kerjasama Detail"  name='rincian_bentuk_kerjasam_detail' id='rincian_bentuk_kerjasam_detail' class='form-control' rows='8'></textarea>
            </div>

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('bksd') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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
        $('.select-bksu').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kerjasama Detail',
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
            url		: "{{ url('bksd/save') }}",
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
                        window.location.href = "{{ url('bksd') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('bksd') }}";
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