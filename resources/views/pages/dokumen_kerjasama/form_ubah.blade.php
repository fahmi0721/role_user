@extends("master_lte")
@section("title-page", "Ubah Dokumen Kerjasama")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Dokumen Kerjasama
    <small>Ubah Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dokumen-ks') }}"><i class="fa fa-tags"></i> Dokumen Kerjasama</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Dokumen Kerjasama</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Dokumen Kerjasama</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="id_usulan" autocomplete=off class='control-label'>Usulan <span class='text-danger'>*</span></label>
                <select name="id_usulan" id="id_usulan"  class="form-control select-usulan" onchange="get_detail_data_usulan(this.value)">
                    <option value="">..:: Pilih  Usulan ::..</option>
                    @foreach($usulan as $key => $dt_usulan)
                        <option  value="{{ $dt_usulan->id }}" @if($data->id_usulan == $dt_usulan->id) selected @endif>{{ $dt_usulan->deskripsi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="unit" autocomplete=off class='control-label'>Unit</label>
                <input type="text" placeholder="Entri Unit" value="{{ $data->unit->nama_unit }}" readonly name='unit' id='unit' class='form-control'>
            </div>

            <div class="form-group">
                <label for="mitra" autocomplete=off class='control-label'>Mitra</label>
                <input type="text" placeholder="Entri Mitra" value="{{ $data->mitra->nama_mitra }}" readonly name='mitra' id='mitra' class='form-control'>
            </div>

            <div class="form-group">
                <label for="bentuk_kerjasama" autocomplete=off class='control-label'>Bentuk Kerjasama</label>
                <input type="text" value="{{ $data->bentuk_kerjasama->nama_bentuk_kerjasam_detail }}" placeholder="Entri Bentuk Kerjasama" readonly name='bentuk_kerjasama' id='bentuk_kerjasama' class='form-control'>
            </div>

            <div class="form-group">
                <label for="jenis_kerjasama" autocomplete=off class='control-label'>Jenis Kerjasama</label>
                <input type="text" value="{{ $data->jenis_kerjasama->nama_jenis_kerjasama }}" placeholder="Entri Jenis Kerjasama" readonly name='jenis_kerjasama' id='jenis_kerjasama' class='form-control'>
            </div>
            
            <div class="form-group">
                <label for="nama_dokumen" autocomplete=off class='control-label'>Nama Dokumen <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->nama_dokumen }}" placeholder="Entri Nama Dokumen" name='nama_dokumen' id='nama_dokumen' class='form-control'>
            </div>

            <div class="form-group">
                <label for="periode" autocomplete=off class='control-label'>Periode Kerjasama<span class='text-danger'>*</span></label>
                <div class="input-group">
                    <span class='input-group-addon'><i class='fa fa-calendar'></i></span>
                    <input type="text" value="{{ $data->tgl_awal }}" placeholder="Entri Tanggal Dari" name='tgl_awal' id='tgl_awal' class='form-control date_awal'>
                    <span class='input-group-addon'>S/D</span>
                    <input type="text" value="{{ $data->tgl_akhir }}" placeholder="Entri Tanggal Sampai" name='tgl_akhir' id='tgl_akhir' class='form-control date_akhir'>
                    <span class='input-group-addon'><i class='fa fa-calendar'></i></span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="deskripsi" autocomplete=off class='control-label'>Deskripsi <span class='text-danger'>*</span></label>
                <textarea type="text" placeholder="Entri Deskripsi" rows='4' name='deskripsi' id='deskripsi' class='form-control'>{{ $data->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label for="file_publih" autocomplete=off class='control-label'>File <span class='text-danger'>*</span></label>
                <input type="file" accept=".pdf" placeholder="Entri File" name='file_publih' id='file_publih' class='form-control'>
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
    $(document).ready(function() {

        $('.select-usulan').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Usulan Kerjasama',
        });

        $('.date_awal').datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('.date_akhir').datepicker('setStartDate', minDate);
        });

        $('.date_akhir').datepicker()
        .on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('.date_awal').datepicker('setEndDate', maxDate);
        });
    });
    

    function get_detail_data_usulan(id_usulan){
        console.log(id_usulan);
        $("#unit").val("");
        $("#mitra").val("");
        $("#bentuk_kerjasama").val("");
        $("#jenis_kerjasama").val("");
        $.ajax({
            type	: "POST",
            dataType: "json",
            url		: "{{ url('dokumen-ks/get_usulan') }}/"+id_usulan,
            data	: "_method=GET&_token="+tokenCSRF,
            beforeSend: function () { 
                // in_load();
            },
            success	:function(data) {
                console.log(data);
                $("#unit").val(data.data.unit.nama_unit);
                $("#mitra").val(data.data.mitra.nama_mitra);
                $("#bentuk_kerjasama").val(data.data.bentuk_kerjasama.nama_bentuk_kerjasam_detail);
                $("#jenis_kerjasama").val(data.data.jenis_kerjasama.nama_jenis_kerjasama);
                
            },
            error: function (error) {
                error_detail(error);
            }
        });
    }
 
    $("#FormData").submit(function(e){
        e.preventDefault();
        SubmitData();
    })


    function SubmitData() {
        var idata =new FormData($('#FormData')[0]);
        $.ajax({
            type	: "POST",
            dataType: "json",
            url		: "{{ url('dokumen-ks/update/'.$id) }}",
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
                        window.location.href = "{{ url('dokumen-ks') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('dokumen-ks') }}";
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