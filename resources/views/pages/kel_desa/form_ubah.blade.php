@extends("master_lte")
@section("title-page", "Ubah Master Kelurahan / Desa")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Kelurahan / Desa
    <small>Ubah Master Kelurahan / Desa</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('kel-desa') }}"><i class="fa fa-tags"></i> Kelurahan / Desa</a></li>
    <li class="active"><i class="fa fa-edit"></i> Ubah Master Kelurahan / Desa</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-edit text-success'></i> Ubah Data Kecamatan</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nama_kel_desa" autocomplete=off class='control-label'>Nama Kelurahan / Desa <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->nama_kel_desa }}" placeholder="Entri Nama Kelurahan / Desa" name='nama_kel_desa' id='nama_kel_desa' class='form-control'>
            </div>
            <div class="form-group">
                <label for="id_provinsi" autocomplete=off class='control-label'>Nama Provinsi <span class='text-danger'>*</span></label>
                <select name="id_provinsi" id="id_provinsi" onchange="get_kab_kota(this.value)"  class="form-control select-provinsi">
                    <option value="">..:: Pilih Nama Provinsi ::..</option>
                    @foreach($provinsi as $key => $dt_provinsi)
                        <option  value="{{ $dt_provinsi->id }}" @if($data->id_provinsi == $dt_provinsi->id) selected @endif>{{ $dt_provinsi->nama_provinsi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_kab_kota" autocomplete=off class='control-label'>Nama Kabupaten <span class='text-danger'>*</span></label>
                <select name="id_kab_kota" id="id_kab_kota" onchange="get_kecamatan(this.value)"  class="form-control select-kab-kota">
                    <option value="">..:: Pilih Nama Kabupaten / Kota ::..</option>
                    @foreach($kab_kota as $key => $dt_kab_kota)
                        <option  value="{{ $dt_kab_kota->id }}" @if($data->id_kab_kota == $dt_kab_kota->id) selected @endif>{{ $dt_kab_kota->nama_kab_kota }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_kecamatan" autocomplete=off class='control-label'>Nama Kecamatan <span class='text-danger'>*</span></label>
                <select name="id_kecamatan" id="id_kecamatan"  class="form-control select-kecamatan">
                    <option value="">..:: Pilih Nama Kecamatan ::..</option>
                    @foreach($kecamatan as $key => $dt_kecamatan)
                        <option  value="{{ $dt_kecamatan->id }}" @if($data->id_kecamatan == $dt_kecamatan->id) selected @endif>{{ $dt_kecamatan->nama_kecamatan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_pos" autocomplete=off class='control-label'>Kode Pos <span class='text-danger'>*</span></label>
                <input type="text" placeholder="Entri Nama Kecamatan" value="{{ $data->kode_pos}}" name='kode_pos' id='kode_pos' class='form-control'>
            </div>
            <div class="form-group">
                <label for="deskripsi" class='control-label'>Deskripsi</label>
                <textarea type="text" placeholder="Entri Deskripsi"  name='deskripsi' id='deskripsi' class='form-control' rows='5'>{{ $data->deskripsi }}</textarea>
            </div>

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('kel-desa') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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
        $('.select-provinsi').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Provinsi',
        });

        $('.select-kab-kota').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kabupaten / Kota',
        });

        $('.select-kecamatan').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kecamatan',
        });

    });

    function get_kab_kota(id){
        $(".select-kab-kota").val("").trigger("change");
        $(".select-kab-kota").select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kabupaten / Kota',
            ajax: {
                url: "{{ url('kel-desa/get_kab_kota') }}/"+id,
                dataType: 'json',
                data: function(params) {
                    return {
                        searchTerm: params.term
                    };
                },
                error: function (jqXHR, status, error) {
                    console.log(error + ": " + jqXHR.responseText);
                    // return { results: [] }; // Return dataset to load after error
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                
                
            }
        });
    }

    function get_kecamatan(id_kab){
        var id_prov = $("#id_provinsi").val();
        $(".select-kecamatan").val("").trigger("change");
        $(".select-kecamatan").select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kecamatan',
            ajax: {
                url: "{{ url('kel-desa/get_kecamatan') }}/"+id_prov+"/"+id_kab,
                dataType: 'json',
                data: function(params) {
                    return {
                        searchTerm: params.term
                    };
                },
                error: function (jqXHR, status, error) {
                    console.log(error + ": " + jqXHR.responseText);
                    // return { results: [] }; // Return dataset to load after error
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                
                
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
            url		: "{{ url('kel-desa/update/'.$id) }}",
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
                        window.location.href = "{{ url('kel-desa') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('kel-desa') }}";
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