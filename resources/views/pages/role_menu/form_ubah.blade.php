@extends("master_lte")
@section("title-page", "Ubah Role Menu")

@section('breadcrumb')
<section class="content-header">
  <h1>
     Role Menu
    <small>Ubah Role Menu</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('role-menu') }}"><i class="fa fa-book"></i> Role Menu</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Role Menu</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Role Menu</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="id_role" autocomplete=off class='control-label'>Nama Role <span class='text-danger'>*</span></label>
                <select name="id_role" id="id_role"  class="form-control select-role">
                    <option value="">..:: Pilih Nama Role ::..</option>
                    @foreach($role as $key => $dt_role)
                        <option  value="{{ $dt_role->id }}" @if($data->id_role == $dt_role->id) selected @endif>{{ $dt_role->nama_role }}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_menu" autocomplete=off class='control-label'>Nama Menu <span class='text-danger'>*</span></label>
                <select name="id_menu" id="id_menu" class="form-control select-user">
                    <option value="">..:: Pilih Nama Menu ::..</option>
                    @foreach($menu as $key => $dt_menu)
                        <option data-parent="{{ $dt_menu->parent }}" value="{{ $dt_menu->id }}" @if($data->id_menu == $dt_menu->id) selected @endif>{{ $dt_menu->nama_menu }}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status" class='control-label'>Status Menu<span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><input type="radio" name="status" class="flat-red" value="1" @if($data->status == "1") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Aktif'>
                    <span class='input-group-addon'><input type="radio" name="status" class="flat-red" value="0" @if($data->status == "0") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Tidak Aktif'>
                </div>
            </div>

            <div id='no-root'>
            <div class="form-group">
                <label for="status_tambah" class='control-label'>Status Tambah<span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><input type="radio" name="status_tambah" class="flat-red" value="1" @if($data->status_tambah == "1") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Aktif'>
                    <span class='input-group-addon'><input type="radio" name="status_tambah" class="flat-red" value="0" @if($data->status_tambah == "0") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Tidak Aktif'>
                </div>
            </div>
            <div class="form-group">
                <label for="status_edit" class='control-label'>Status Edit<span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><input type="radio" name="status_edit" class="flat-red" value="1" @if($data->status_edit == "1") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Aktif'>
                    <span class='input-group-addon'><input type="radio" name="status_edit" class="flat-red" value="0"  @if($data->status_edit == "0") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Tidak Aktif'>
                </div>
            </div>
            <div class="form-group">
                <label for="status_hapus" class='control-label'>Status Hapus<span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><input type="radio" name="status_hapus" class="flat-red" value="1"  @if($data->status_hapus == "1") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Aktif'>
                    <span class='input-group-addon'><input type="radio" name="status_hapus" class="flat-red" value="0" @if($data->status_hapus == "0") checked @endif></span>
                    <input type="text" readonly class='form-control' value='Tidak Aktif'>
                </div>
            </div>
            <div class="form-group">
                <label for="status_tampil" class='control-label'>Status Tampil<span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><input type="radio" name="status_tampil" class="flat-red" value="all" @if($data->status_tampil == "all") checked @endif></span>
                    <input type="text" readonly class='form-control' value='All'>
                    <span class='input-group-addon'><input type="radio" name="status_tampil" class="flat-red" value="user_id" @if($data->status_tampil == "user_id") checked @endif></span>
                    <input type="text" readonly class='form-control' value='User Id Create'>
                </div>
            </div>
            </div>
            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('role-menu') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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
        @if($data->menu->parent != "root")
            $("#no-root").show();
        @else
            $("#no-root").hide();
        @endif

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

    $('#id_menu').on("select2:select", function(e) { 
        $("#no-root").hide();
        var parent = $(this).find(':selected').data('parent');
        console.log(parent);
        if(parent == "root"){
            $("#no-root").hide();
        }else{
            $("#no-root").show();
        }
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
            url		: "{{ url('role-menu/update/'.$id) }}",
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
                        window.location.href = "{{ url('role-menu') }}";
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

   
</script>
@endsection