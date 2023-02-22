@extends("master_lte")
@section("title-page", "Ubah Master Users")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Users
    <small>Ubah Master Users</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('users') }}"><i class="fa fa-book"></i> Users</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Master Users</li>
  </ol>
</section>
@endsection


@section('konten')

<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Users</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nama_user" autocomplete=off class='control-label'>Nama User <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->nama_user }}" placeholder="Entri Nama User" name='nama_user' id='nama_user' class='form-control'>
            </div>
           
            <div class="form-group">
                <label for="username" class='control-label'>Username <span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><i class='fa fa-user text-success'></i></span>
                    <input type="text" value="{{ $data->username }}" placeholder="Entri Username"  name='username' id='username' class='form-control'>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class='control-label'>Password <span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><i class='fa fa-key text-success'></i></span>
                    <input type="text" placeholder="Entri Password"  name='password' id='password' class='form-control'>
                </div>
            </div>

            <div class="form-group">
                <label for="level" class='control-label'>Level <span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><input type="radio" name="level" class="flat-red" value="admin" @if($data->level == "admin") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Admin'>
                    <span class='input-group-addon'><input type="radio" name="level" class="flat-red" value="member" @if($data->level == "member") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Member'>
                </div>
            </div>

            <div class="form-group">
                <label for="status" class='control-label'>Status <span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><input type="radio" name="status" class="flat-red" value="1" @if($data->status == "1") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Aktif'>
                    <span class='input-group-addon'><input type="radio" name="status" class="flat-red" value="0" @if($data->status == "0") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Tidak Aktif'>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('users') }}" data-toggle='tooltip' title='Kembali ke Master Users'><i class="fa fa-mail-reply"></i> Kembali</a>
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
        //Flat red color scheme for iCheck
        $('input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
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
            url		: "{{ url('users/update/'.$id) }}",
            data	: idata,
            processData: false,
            contentType: false,
            cache 	: false,
            beforeSend: function () { 
                // in_load();
            },
            success	:function(data) {
                console.log(data);
                swal(
                    {
                        title: data.status,
                        text: data.messages,
                        type: "success",
                    },
                function(){
                    window.location.href = "{{ url('users') }}";
                });
            },
            error: function (error) {
                error_detail(error);
            }
        });
    }

</script>
@endsection