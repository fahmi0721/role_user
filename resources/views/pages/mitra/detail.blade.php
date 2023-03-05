@extends("master_lte")
@section("title-page", "Mitra")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Mitra
    <small>Data</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-tags"></i> Mitra</li>
  </ol>
</section>
@endsection


@section('konten')
@php
use App\Helpers\Custom as Custom;
$cek_menu_akses = Custom::cek_akses_menu('mitra',json_decode(Session::get('menu_akses'),true));
@endphp
<!-- Default box -->
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-archive text-success'></i> Data Mitra</h3>
        <div class="box-tools pull-right">
            @if($cek_menu_akses['status_tambah'] == '1')
            <a  href="{{ url('mitra/add') }}" class='btn btn-sm btn-success' data-toggle='tooltip' title='Tambah Data Mitra'><i class="fa fa-plus-square"></i> Tambah</a>
            @endif
        </div>
    </div>
    <div class="box-body">
        <div class='table-responsive'>
            <table class='table table-striped table-bordered' id="mitra">
                <thead>
                    <tr>
                        <th width='5px' class='text-center'>No</th>
                        <th class='text-center'>Nama Mitra</th>
                        <th class='text-center'>Jenis Mitra</th>
                        <th class='text-center'>Email</th>
                        <th class='text-center'>No Telepon</th>
                        <th class='text-center'>Website</th>
                        <th class='text-center'>Alamat</th>
                        @if($cek_menu_akses['status_edit'] == '1' || $cek_menu_akses['status_hapus'] == '1')
                        <th width='80px' class='text-center'>Aksi</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div><!-- /.box-body -->
   
    </div><!-- /.box -->
@endsection

@section('script')
<script>
    $(function() {
       $('#mitra').DataTable({
            stateSave: true,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: "{{ url('mitra') }}",
            columns: [
                { data: 'id', className: "text-center",'searchable':false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'nama_mitra', name: 'nama_mitra' },
                { data: 'jenis_mitra', name: 'jenis_mitra',"orderable": false, 'searchable':false, render: function (data, type, row, meta) { 
                    return row.jenis_mitra.nama_jenis_mitra;
                }},
                { data: 'email', name: 'email',"orderable": false },
                { data: 'no_tlp', name: 'no_tlp',"orderable": false },
                { data: 'website', name: 'website',"orderable": false },
                { data: 'alamat', name: 'alamat',"orderable": false, 'searchable':false, render: function (data, type, row, meta) {
                    var html ="";
                    html += row.alamat;
                    html += "<br><small>Provinsi : "+row.provinsi.nama_provinsi+"</small>";
                    html += "<br><small>Kabupaten/Kota : "+row.kab_kota.nama_kab_kota+"</small>";
                    html += "<br><small>Kecamatan : "+row.kecamatan.nama_kecamatan+"</small>";
                    html += "<br><small>Kelurahan/Desa : "+row.kel_desa.nama_kel_desa+"</small>";
                    return html;
                }},
                @if($cek_menu_akses['status_edit'] == '1' || $cek_menu_akses['status_hapus'] == '1')
                { data: 'id', name: 'aksi',"orderable": false, className: "text-center", 'searchable':false, render: function (data, type, row, meta) {
                    var edit = "";
                    var hapus = "";
                    @if($cek_menu_akses['status_edit'] == '1')
                        var edit = "<div class='btn btn-group'><a class='btn btn-xs btn-primary' data-toggle='tooltip' href='{{ url('mitra/ubah') }}/"+row.id+"' title='Edit Data'><i class='fa fa-pencil'></i></a> ";
                    @endif
                    @if($cek_menu_akses['status_hapus'] == '1')
                        var hapus = "<a class='btn btn-xs btn-danger' data-toggle='tooltip' onclick=\"delete_data('"+row.id+"')\" title='Hapus Data'><i class='fa fa-trash'></i></a></div>";
                    @endif
                    return edit+hapus;
                }},
                @endif
            ],
        });
        $('div#menu-table_filter input').attr('placeholder', 'Find data here...');
    });

    function delete_data(id) {
        swal({
            title 	: 'Konfirmasi Hapus!',
            text  	: "apakah anda yakin ingin menghapus data ini?",
            icon 	: 'info',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
            dangerMode: false,
            showLoaderOnConfirm :true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type	: "POST",
                    dataType: "json",
                    url		: "{{ url('mitra/delete') }}/"+id,
                    data	: "_method=DELETE&_token="+tokenCSRF,
                    success	:function(data) {
                        swal(
                            {
                                title: data.status,
                                text: data.messages,
                                type: "success",
                            },
                        function(){
                            var table = $('#mitra').DataTable();
                            table.ajax.reload(null, false);
                        });
                       
                    },
                    error: function(error){
                        error_detail(error);
                    }
                });
            }
        });
    }

</script>
@endsection