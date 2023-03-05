@extends("master_lte")
@section("title-page", "Dokumen Kerjasama")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Dokumen Kerjasama
    <small>Data</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-tags"></i> Dokumen Kerjasama</li>
  </ol>
</section>
@endsection


@section('konten')
@php
use App\Helpers\Custom as Custom;
$cek_menu_akses = Custom::cek_akses_menu('dokumen-ks',json_decode(Session::get('menu_akses'),true));
@endphp
<!-- Default box -->
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-archive text-success'></i> Data Dokumen Kerjasama</h3>
        <div class="box-tools pull-right">
            @if($cek_menu_akses['status_tambah'] == '1')
            <a  href="{{ url('dokumen-ks/add') }}" class='btn btn-sm btn-success' data-toggle='tooltip' title='Tambah Data Dokumen Kerjasama'><i class="fa fa-plus-square"></i> Tambah</a>
            @endif
        </div>
    </div>
    <div class="box-body">
        <div class='table-responsive'>
            <table class='table table-striped table-bordered' id="dokumen-ks">
                <thead>
                    <tr>
                        <th width='5px' class='text-center'>No</th>
                        <th class='text-center'>Nama Dokumen</th>
                        <th class='text-center'>Unit </th>
                        <th class='text-center'>Mitra</th>
                        <th class='text-center'>Jenis Kerjasama</th>
                        <th class='text-center'>Bentuk Kerjasama</th>
                        <th class='text-center'>Periode</th>
                        <th class='text-center'>Deskripsi</th>
                        <th class='text-center'>File</th>
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
       $('#dokumen-ks').DataTable({
            stateSave: true,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: "{{ url('dokumen-ks') }}",
            columns: [
                { data: 'id', className: "text-center",'searchable':false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'nama_dokumen', name: 'nama_dokumen' },
                { data: 'unit', name: 'unit',"orderable": false, 'searchable':false, render: function (data, type, row, meta) { 
                    return row.unit.nama_unit;
                }},
                
                { data: 'mitra', name: 'mitra',"orderable": false, 'searchable':false, render: function (data, type, row, meta) { 
                    return row.mitra.nama_mitra;
                }},
                { data: 'jenis_kerjasama', name: 'jenis_kerjasama',"orderable": false, 'searchable':false, render: function (data, type, row, meta) { 
                    return row.jenis_kerjasama.nama_jenis_kerjasama;
                }},
                { data: 'bentuk_kerjasama', name: 'bentuk_kerjasama',"orderable": false, 'searchable':false, render: function (data, type, row, meta) { 
                    return row.bentuk_kerjasama.nama_bentuk_kerjasam_detail;
                }},
                { data: 'id', className: "text-center",'searchable':false, "orderable": false, render: function (data, type, row, meta) {
                    return row.tgl_awal +" s/d "+row.tgl_akhir
                }},
                { data: 'deskripsi', name: 'deskripsi' },
                { data: 'file_publih',name:'file_publih',  className: "text-center",'searchable':false, "orderable": false, render: function (data, type, row, meta) {
                    return "<a data-toggle='tooltip' title='"+row.nama_dokumen+"' target='_blank' class='label label-success' href='{{ url('public/dokumen/kerjasama/') }}/"+row.file_publih+"'><i class='fa fa-file-pdf-o'></i></a>";
                }},
                @if($cek_menu_akses['status_edit'] == '1' || $cek_menu_akses['status_hapus'] == '1')
                { data: 'id', name: 'aksi',"orderable": false, className: "text-center", 'searchable':false, render: function (data, type, row, meta) {
                    var edit = "";
                    var hapus = "";
                    @if($cek_menu_akses['status_edit'] == '1')
                        var edit = "<div class='btn btn-group'><a class='btn btn-xs btn-primary' data-toggle='tooltip' href='{{ url('dokumen-ks/ubah') }}/"+row.id+"' title='Edit Data'><i class='fa fa-pencil'></i></a> ";
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
                    url		: "{{ url('dokumen-ks/delete') }}/"+id,
                    data	: "_method=DELETE&_token="+tokenCSRF,
                    success	:function(data) {
                        swal(
                            {
                                title: data.status,
                                text: data.messages,
                                type: "success",
                            },
                        function(){
                            var table = $('#dokumen-ks').DataTable();
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