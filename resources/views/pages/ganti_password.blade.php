@extends("master_lte")
@section("title-page", "GANTI PASSWORD")

@section('breadcrumb')
<section class="content-header">
  <h1>
    UBAH PASSWORD
    <small>DATA</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('Bentuk Kerja Sama Detail') }}"><i class="fa fa-tags"></i> Ubah Password</a></li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-plus-edit text-success'></i> UBAH PASSWORD</h3>
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="username" autocomplete=off class='control-label'>USERNAME <span class='text-danger'>*</span></label>
                <input type="text" value="{{ auth()->user()->username }}" readonly placeholder="Entri Username" name='username' id='username' class='form-control FormIsi'>
            </div>

            <div class="form-group">
                <label for="password" autocomplete=off class='control-label'>Password Baru <span class='text-danger'>*</span></label>
                <input type="text" placeholder="Entri New Password" name='password' id='password' class='form-control FormIsi'>
                
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

    $("#FormData").submit(function(e){
        e.preventDefault();
        SubmitData();
    })


    function SubmitData() {
        var idata =new FormData($('#FormData')[0]);
        $.ajax({
            type	: "POST",
            dataType: "json",
            url		: "{{ url('save-password') }}",
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
                        window.location.href = "{{ url('/') }}";
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