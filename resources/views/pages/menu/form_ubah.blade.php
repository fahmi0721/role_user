@extends("master_lte")
@section("title-page", "Ubah Master Menu")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Menu
    <small>Ubah Master Menu</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('menu') }}"><i class="fa fa-book"></i> Menu</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Master Menu</li>
  </ol>
</section>
@endsection


@section('konten')

<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Menu</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nama_menu" autocomplete=off class='control-label'>Nama Menu <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->nama_menu }}" placeholder="Entri Nama Menu" name='nama_menu' id='nama_menu' class='form-control FormIsi'>
            </div>
            <div class="form-group">
                <label for="url" autocomplete=off class='control-label'>Url </label>
                <input type="text" value="{{ $data->url }}" placeholder="Entri Url" name='url' id='url' class='form-control FormIsi'>
            </div>
            <div class="form-group">
                <label for="parent" class='control-label'>Parent <span class='text-danger'>*</span></label>
                <select name="parent" id="parent" class='form-control FormIsi select-parent'>
                    <option value=""></option>
                    <option value="root" @if($data->parent == 'root') selected  @endif>Root</option>
                    @foreach($parent as $key => $dt)
                        <option value="{{ $dt['id'] }}" @if($data->parent == $dt['id']) selected @endif>{{ $dt['nama_menu'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="icon" class='control-label'>Icon <span class='text-danger'>*</span></label>
                <div class="input-group">
                    <input type="text" placeholder="Entri Icon" value="{{ $data->icon }}" value="fa fa-circle-o" onkeyup='ubah_icon(this.value)' name='icon' id='icon' class='form-control FormIsi'>
                    <span class='input-group-addon'><i class='fa fa-circle-o text-success'></i></span>
                </div>
            </div>

            <div class="form-group">
                <label for="status" class='control-label'>Status <span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><input type="radio" name="status" class="flat-red" value="1" @if($data->status == '1') checked @endif></span>
                    <input type="text" readonly class='form-control' value='Aktif'>
                    <span class='input-group-addon'><input type="radio" name="status" class="flat-red" value="0" @if($data->status == '0') checked @endif></span>
                    <input type="text" readonly class='form-control' value='Tidak Aktif'>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('menu') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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
        $('.select-parent').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Parent Menu',
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
            url		: "{{ url('menu/update/'.$id) }}",
            data	: idata,
            processData: false,
            contentType: false,
            cache 	: false,
            beforeSend: function () { 
                // in_load();
            },
            success	:function(data) {
                swal(
                    {
                        title: data.status,
                        text: data.messages,
                        type: "success",
                    },
                function(){
                    window.location.href = "{{ url('menu') }}";
                });
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