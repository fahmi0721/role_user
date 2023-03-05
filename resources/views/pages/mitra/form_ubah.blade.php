@extends("master_lte")
@section("title-page", "Ubah Mitra")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Mitra
    <small>Ubah Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('mitra') }}"><i class="fa fa-tags"></i> Mitra</a></li>
    <li class="active"><i class="fa fa-plus-square"></i> Ubah Mitra</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-12">
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-plus-square text-success'></i> Ubah Data Mitra</h3>
        
    </div>
    <div class="box-body">
        <form action="javascript:void(0)" id='FormData'>
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nama_mitra" autocomplete=off class='control-label'>Nama Mitra <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->nama_mitra }}" placeholder="Entri Nama Mitra" name='nama_mitra' id='nama_mitra' class='form-control'>
            </div>
            <div class="form-group">
                <label for="id_jenis_mitra" autocomplete=off class='control-label'>Jenis Mitra <span class='text-danger'>*</span></label>
                <select name="id_jenis_mitra" id="id_jenis_mitra"  class="form-control select-jenis-mitra">
                    <option value="">..:: Pilih Jenis Mitra ::..</option>
                    @foreach($jenis_mitra as $key => $dt_jenis_mitra)
                        <option  value="{{ $dt_jenis_mitra->id }}" @if($dt_jenis_mitra->id == $data->id_jenis_mitra) selected @endif >{{ $dt_jenis_mitra->nama_jenis_mitra }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="email" autocomplete=off class='control-label'>Email <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->email }}" placeholder="Entri Email" name='email' id='email' class='form-control'>
            </div>

            <div class="form-group">
                <label for="no_tlp" autocomplete=off class='control-label'>No Telepon <span class='text-danger'>*</span></label>
                <input type="text" value="{{ $data->no_tlp }}" placeholder="Entri No Telepon" name='no_tlp' id='no_tlp' class='form-control'>
            </div>

            <div class="form-group">
                <label for="website" autocomplete=off class='control-label'>Website</label>
                <input type="text" value="{{ $data->website }}" placeholder="Entri Website" name='website' id='website' class='form-control'>
            </div>

            <div class="form-group">
                <label for="id_provinsi" autocomplete=off class='control-label'>Nama Provinsi <span class='text-danger'>*</span></label>
                <select name="id_provinsi" id="id_provinsi" onchange="get_kab_kota(this.value)"  class="form-control select-provinsi">
                    <option value="">..:: Pilih Nama Provinsi ::..</option>
                    @foreach($provinsi as $key => $dt_provinsi)
                        <option  value="{{ $dt_provinsi->id }}" @if($dt_provinsi->id == $data->id_provinsi) selected @endif>{{ $dt_provinsi->nama_provinsi }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_kab_kota" autocomplete=off class='control-label'>Nama Kabupaten <span class='text-danger'>*</span></label>
                <select name="id_kab_kota" id="id_kab_kota" onchange="get_kecamatan(this.value)"  class="form-control select-kab-kota">
                    <option value="">..:: Pilih Nama Kabupaten / Kota ::..</option>
                    @foreach($kab_kota as $key => $dt_kab_kota)
                        <option  value="{{ $dt_kab_kota->id }}" @if($dt_kab_kota->id == $data->id_kab_kota) selected @endif>{{ $dt_kab_kota->nama_kab_kota }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_kecamatan" autocomplete=off class='control-label'>Nama Kecamatan <span class='text-danger'>*</span></label>
                <select name="id_kecamatan" id="id_kecamatan" onchange="get_kel_desa(this.value)"  class="form-control select-kecamatan">
                    <option value="">..:: Pilih Nama Kecamatan ::..</option>
                    @foreach($kecamatan as $key => $dt_kecamatan)
                        <option  value="{{ $dt_kecamatan->id }}" @if($dt_kecamatan->id == $data->id_kecamatan) selected @endif>{{ $dt_kecamatan->nama_kecamatan }}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_kel_desa" autocomplete=off class='control-label'>Nama Kelurahan / Desa <span class='text-danger'>*</span></label>
                <select name="id_kel_desa" id="id_kel_desa"  class="form-control select-kel-desa">
                    <option value="">..:: Pilih Nama Kecamatan ::..</option>
                    @foreach($kel_desa as $key => $dt_kel_desa)
                        <option  value="{{ $dt_kel_desa->id }}" @if($dt_kel_desa->id == $data->id_kel_desa) selected @endif>{{ $dt_kel_desa->nama_kel_desa }}</option>

                    @endforeach
                </select>
            </div>
           

            <div class="form-group">
                <label for="alamat" autocomplete=off class='control-label'>Alamat <span class='text-danger'>*</span></label>
                <input type="text" placeholder="Entri Alamat" value="{{ $data->alamat }}" name='alamat' id='alamat' class='form-control'>
            </div>
            

            <hr>
            <div class="form-group">
                <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-save'></i> Submit</button>
                <a class='btn btn-sm btn-danger' href="{{ url('mitra') }}" data-toggle='tooltip' title='Kembali ke Master Menu'><i class="fa fa-mail-reply"></i> Kembali</a>
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

        $('.select-jenis-mitra').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Jenis Mitra',
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

        $('.select-kel-desa').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kelurahan / Desa',
        });

    });

    function get_kab_kota(id){
        $(".select-kab-kota").val("").trigger("change");
        $(".select-kecamatan").val("").trigger("change");
        $(".select-kel-desa").val("").trigger("change");
        $(".select-kab-kota").select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kabupaten / Kota',
            ajax: {
                url: "{{ url('mitra/get_kab_kota') }}/"+id,
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
        $(".select-kel-desa").val("").trigger("change");
        $(".select-kecamatan").select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kecamatan',
            ajax: {
                url: "{{ url('mitra/get_kecamatan') }}/"+id_prov+"/"+id_kab,
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

    function get_kel_desa(id_kec){
        var id_prov = $("#id_provinsi").val();
        var id_kab = $("#id_kab_kota").val();
        $(".select-kel-desa").val("").trigger("change");
        $(".select-kel-desa").select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Nama Kelurahan / Desa',
            ajax: {
                url: "{{ url('mitra/get_kel_desa') }}/"+id_prov+"/"+id_kab+"/"+id_kec,
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
            url		: "{{ url('mitra/update/'.$id) }}",
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
                        window.location.href = "{{ url('mitra') }}";
                    });
                }else{
                    swal(
                    {
                            title: "warning",
                            text: data,
                            type: "warning",
                        },
                    function(){
                        window.location.href = "{{ url('mitra') }}";
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