@extends("master_lte")
@section("title-page", "Tambah Unit")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Unit
    <small>Tambah Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('unit') }}"><i class="fa fa-tags"></i> Unit</a></li>
    <li class="active"><i class="fa fa-plus-square"></i> Tambah Unit</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-plus-square text-success'></i> Tambah Data Unit</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            <div class="form-group">
                <label for="nama_unit" autocomplete=off class='control-label'>Nama Unit <span class='text-danger'>*</span></label>
                <input type="text" placeholder="Entri Nama Unit" name='nama_unit' id='nama_unit' class='form-control'>
            </div>

            <div class="form-group">
                <label for="pd_unit" autocomplete=off class='control-label'>Pd Unit <span class='text-danger'>*</span></label>
                <input type="text" placeholder="Entri Pd Unit" name='pd_unit' id='pd_unit' class='form-control'>
            </div>
            
            <div class="form-group">
                <label for="email" autocomplete=off class='control-label'>Email </label>
                <input type="text" placeholder="Entri Email" name='email' id='email' class='form-control'>
            </div>

            <div class="form-group">
                <label for="no_telp" autocomplete=off class='control-label'>No Telepon </label>
                <input type="text" placeholder="Entri No Telepon" name='no_telp' id='no_telp' class='form-control'>
            </div>

            <div class="form-group">
                <label for="web" autocomplete=off class='control-label'>Website</label>
                <input type="text" placeholder="Entri Website" name='web' id='web' class='form-control'>
            </div>

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('unit') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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
            url		: "{{ url('unit/save') }}",
            data	: idata,
            processData: false,
            contentType: false,
            cache 	: false,
            beforeSend: function () { 
                // in_load();
            },
            success	:function(data) {
                console.log(data);
                if(data.status){
                    swal(
                    {
                            title: data.status,
                            text: data.messages,
                            type: "success",
                        },
                    function(){
                        window.location.href = "{{ url('unit') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('unit') }}";
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