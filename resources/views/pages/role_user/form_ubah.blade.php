@extends("master_lte")
@section("title-page", "Ubah Role User")

@section('breadcrumb')
<section class="content-header">
  <h1>
     Role User
    <small>Ubah Role User</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('role-user') }}"><i class="fa fa-group"></i> Role User</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Role User</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Role User</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="id_role" autocomplete=off class='control-label'>Nama Role <span class='text-danger'>*</span></label>
                <select name="id_role" id="id_role" class="form-control select-role">
                    <option value="">..:: Pilih Nama Role ::..</option>
                    @foreach($role as $key => $dt_role)
                        <option value="{{ $dt_role->id }}" @if($data->id_role == $dt_role->id) selected @endif>{{ $dt_role->nama_role }}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_user" autocomplete=off class='control-label'>Nama User <span class='text-danger'>*</span></label>
                <select name="id_user" id="id_user" class="form-control select-user">
                    <option value="">..:: Pilih Nama User ::..</option>
                    @foreach($user as $key => $dt_user)
                        <option value="{{ $dt_user->id }}" @if($data->id_user == $dt_user->id) selected @endif>{{ $dt_user->nama_user }}</option>

                    @endforeach
                </select>
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
                <a class='btn btn-sm btn-danger' href="{{ url('role-user') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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
        $('.select-user').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama User',
        });

        $('.select-role').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Role',
        });

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
            url		: "{{ url('role-user/update/'.$id) }}",
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
                        window.location.href = "{{ url('role-user') }}";
                    });
                }else{
                    swal(
                        {
                            title: "warning",
                            text: data,
                            type: "warning",
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