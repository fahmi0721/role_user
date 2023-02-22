@extends("master_lte")
@section("title-page", "Master Kelurahan / Desa")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Kelurahan / Desa
    <small>Master Kelurahan / Desa</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-tags"></i> Kelurahan / Desa</li>
  </ol>
</section>
@endsection


@section('konten')
@php
use App\Helpers\Custom as Custom;
$cek_menu_akses = Custom::cek_akses_menu('kel-desa',json_decode(Session::get('menu_akses'),true));
@endphp
<!-- Default box -->
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-archive text-success'></i> Data Kelurahan / Desa</h3>
        <div class="box-tools pull-right">
            @if($cek_menu_akses['status_tambah'] == '1')
            <a  href="{{ url('kel-desa/add') }}" class='btn btn-sm btn-success' data-toggle='tooltip' title='Tambah Data Kelurahan / Desa'><i class="fa fa-plus-square"></i> Tambah</a>
            @endif
        </div>
    </div>
    <div class="box-body">
        <div class='table-responsive'>
            <table class='table table-striped table-bordered' id="kab-kota-table">
                <thead>
                    <tr>
                        <th width='5px' class='text-center'>No</th>
                        <th class='text-center'>Nama Kelurahan / Desa</th>
                        <th class='text-center'>Kode Pos</th>
                        <th class='text-center'>Deskripsi</th>
                        <th class='text-center'>Nama Provinsi</th>
                        <th class='text-center'>Nama Kabupaten</th>
                        <th class='text-center'>Nama Kecamatan</th>
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
       $('#kab-kota-table').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: "{{ url('kel-desa') }}",
            columns: [
                { data: 'id', className: "text-center",'searchable':false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'nama_kel_desa', name: 'nama_kel_desa' },
                { data: 'kode_pos', name: 'kode_pos' },
                { data: 'deskripsi', name: 'deskripsi',"orderable": false },
                { data: 'provinsi', name: 'provinsi',"orderable": false, 'searchable':false, render: function (data, type, row, meta) {
                    return row.provinsi.nama_provinsi;
                }},
                { data: 'kab_kota', name: 'kab_kota',"orderable": false, 'searchable':false, render: function (data, type, row, meta) {
                    return row.kab_kota.nama_kab_kota;
                }},
                { data: 'kecamatan', name: 'kecamatan',"orderable": false, 'searchable':false, render: function (data, type, row, meta) {
                    return row.kecamatan.nama_kecamatan;
                }},
                @if($cek_menu_akses['status_edit'] == '1' || $cek_menu_akses['status_hapus'] == '1')
                { data: 'id', name: 'aksi',"orderable": false, className: "text-center", 'searchable':false, render: function (data, type, row, meta) {
                    var edit = "";
                    var hapus = "";
                    @if($cek_menu_akses['status_edit'] == '1')
                        var edit = "<div class='btn btn-group'><a class='btn btn-xs btn-primary' data-toggle='tooltip' href='{{ url('kel-desa/ubah') }}/"+row.id+"' title='Edit Data'><i class='fa fa-pencil'></i></a> ";
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
                    url		: "{{ url('kel-desa/delete') }}/"+id,
                    data	: "_method=DELETE&_token="+tokenCSRF,
                    success	:function(data) {
                        swal(
                            {
                                title: data.status,
                                text: data.messages,
                                type: "success",
                            },
                        function(){
                            var table = $('#kab-kota-table').DataTable();
                            table.ajax.reload();
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