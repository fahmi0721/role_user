@extends("master_lte")
@section("title-page", "Master Role")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Role
    <small>Master Role</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-group"></i> Role</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-group text-success'></i> Data Role</h3>
        <div class="box-tools pull-right">
            <a  href="{{ url('role/add') }}" class='btn btn-sm btn-success' data-toggle='tooltip' title='Tmbah Data Menu'><i class="fa fa-plus-square"></i> Tambah</a>
        </div>
    </div>
    <div class="box-body">
        <div class='table-responsive'>
            <table class='table table-striped table-bordered' id="role-table">
                <thead>
                    <tr>
                        <th width='5px' class='text-center'>No</th>
                        <th class='text-center'>Nama Role</th>
                        <th class='text-center'>Deskripsi</th>
                        <th width='20px' class='text-center'>Status</th>
                        <th width='80px' class='text-center'>Aksi</th>
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
       $('#role-table').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: "{{ url('role') }}",
            columns: [
                { data: 'id', className: "text-center",'searchable':false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'nama_role', name: 'nama_role' },
                { data: 'deskripsi', name: 'deskripsi',"orderable": false },
                { data: 'status', name: 'status',"orderable": false, className: "text-center", render: function (data, type, row, meta) {
                    return row.status == 1 ? "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','0')\"><small data-toggle='tooltip' title='Klik untuk menonaktifkan' class='label label-success'><i class='fa fa-unlock'></i></small></a>" : "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','1')\"><small class='label label-danger' data-toggle='tooltip' title='Klik untuk mengaktifkan'><i class='fa fa-lock'></i></small></a>";
                }},

                { data: 'id', name: 'aksi',"orderable": false, className: "text-center", 'searchable':false, render: function (data, type, row, meta) {
                    return "<div class='btn btn-group'><a class='btn btn-xs btn-primary' data-toggle='tooltip' href='{{ url('role/ubah') }}/"+row.id+"' title='Edit Data'><i class='fa fa-pencil'></i></a> <a class='btn btn-xs btn-danger' data-toggle='tooltip' onclick=\"delete_data('"+row.id+"')\" title='Hapus Data'><i class='fa fa-trash'></i></a></div>";
                }},
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
                    url		: "{{ url('role/delete') }}/"+id,
                    data	: "_method=DELETE&_token="+tokenCSRF,
                    success	:function(data) {
                        swal(
                            {
                                title: data.status,
                                text: data.messages,
                                type: "success",
                            },
                        function(){
                            window.location.reload();
                        });
                       
                    },
                    error: function(er){
                        console.log(er);
                    }
                });
            }
        });
    }

    function update_status(id,status) {
        var pesan = status == 0 ? "apakah anda yakin untuk menonaktifkan menu ini?" : "apakah anda yakin untuk mengaktifkan menu ini?";
        swal({
            title 	: 'Konfirmasi!',
            text  	: pesan,
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
                    url		: "{{ url('role/update_status') }}/"+id,
                    data	: "_method=PUT&_token="+tokenCSRF+"&status="+status,
                    success	:function(data) {
                        swal(
                            {
                                title: data.status,
                                text: data.messages,
                                type: "success",
                            },
                        function(){
                            var table = $('#role-table').DataTable();
                            table.ajax.reload();
                        });
                       
                    },
                    error: function(er){
                        console.log(er);
                    }
                });
            }
        });
    }
</script>
@endsection