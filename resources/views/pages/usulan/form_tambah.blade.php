@extends("master_lte")
@section("title-page", "Tambah Usulan")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Usulan
    <small>Tambah Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('usulan') }}"><i class="fa fa-tags"></i> Usulan</a></li>
    <li class="active"><i class="fa fa-plus-square"></i> Tambah Usulan</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-plus-square text-success'></i> Tambah Data Usulan</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            
            <div class="form-group">
                <label for="id_unit" autocomplete=off class='control-label'>Unit <span class='text-danger'>*</span></label>
                <select name="id_unit" id="id_unit"  class="form-control select-unit">
                    <option value="">..:: Pilih Nama Unit ::..</option>
                    @foreach($unit as $key => $dt_unit)
                        <option  value="{{ $dt_unit->id }}">{{ $dt_unit->nama_unit }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_jenis_kerjasama" autocomplete=off class='control-label'>Jenis Kerjasama <span class='text-danger'>*</span></label>
                <select name="id_jenis_kerjasama" id="id_jenis_kerjasama"  class="form-control select-jenis-kerjasama">
                    <option value="">..:: Pilih Nama Jenis Kerjasma ::..</option>
                    @foreach($jenis_kerjasama as $key => $dt_jenis_kerjasama)
                        <option  value="{{ $dt_jenis_kerjasama->id }}">{{ $dt_jenis_kerjasama->nama_jenis_kerjasama }}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_mitra" autocomplete=off class='control-label'>Mitra <span class='text-danger'>*</span></label>
                <select name="id_mitra" id="id_mitra"  class="form-control select-mitra">
                    <option value="">..:: Pilih Nama Mitra ::..</option>
                    @foreach($mitra as $key => $dt_mitra)
                        <option  value="{{ $dt_mitra->id }}">{{ $dt_mitra->nama_mitra }}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_bentuk_kerjasama" autocomplete=off class='control-label'>Bentuk Kerjasama <span class='text-danger'>*</span></label>
                <select name="id_bentuk_kerjasama" id="id_bentuk_kerjasama"  class="form-control select-bentuk-kerjasama">
                    <option value="">..:: Pilih Bentuk Kerjasama ::..</option>
                    @foreach($bentuk_kerjasama as $key => $dt_bentuk_kerjasama)
                        <option  value="{{ $dt_bentuk_kerjasama->id }}">{{ $dt_bentuk_kerjasama->nama_bentuk_kerjasam_detail }}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_usul" autocomplete=off class='control-label'>Tanggal Usul <span class='text-danger'>*</span></label>
                <div class="input-group">
                    <input type="text" placeholder="Entri Tanggal Usul"  name='tanggal_usul' id='tanggal_usul' class='form-control datepicker'>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi" autocomplete=off class='control-label'>Deskripsi <span class='text-danger'>*</span></label>
                <input type="text"  placeholder="Entri Deskripsi" name='deskripsi' id='deskripsi' class='form-control'></input>
            </div>
            

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('usulan') }}" data-toggle='tooltip' title='Kembali ke Data Unit'><i class="fa fa-mail-reply"></i> Kembali</a>
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
        $('.select-unit').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Unit',
        });

        $('.select-jenis-kerjasama').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Jenis Kerjasama',
        });

        $('.select-mitra').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Mitra',
        });

        $('.select-bentuk-kerjasama').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Bentuk Kerjasama',
        });

        $('.datepicker').datepicker();

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
            url		: "{{ url('usulan/save') }}",
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
                        window.location.href = "{{ url('usulan') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('usulan') }}";
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