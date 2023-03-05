@extends("master_lte")
@section("title-page", "Role Menu")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Role Menu
    <small>Role Menu</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-group"></i> Role Menu</li>
  </ol>
</section>
@endsection


@section('konten')
<!-- Default box -->
<div class="box box-success">
    <div class="box-header with-border ">
        <h3 class="box-title"><i class='fa fa-book text-success'></i> Data Role Menu</h3>
        <div class="box-tools pull-right">
            <a  href="{{ url('role-menu/add') }}" class='btn btn-sm btn-success' data-toggle='tooltip' title='Tmbah Data Menu'><i class="fa fa-plus-square"></i> Tambah</a>
        </div>
    </div>
    <div class="box-body">
        <div class='table-responsive'>
            <table class='table table-striped table-bordered' id="role-table">
                <thead>
                    <tr>
                        <th width='5px' class='text-center'>No</th>
                        <th class='text-center'>Nama Role</th>
                        <th class='text-center'>Nama Menu</th>
                        <th class='text-center'>Status Menu</th>
                        <th class='text-center'>Status Tambah</th>
                        <th class='text-center'>Status Edit</th>
                        <th class='text-center'>Status Hapus</th>
                        <th class='text-center'>Status Tampil</th>
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
            stateSave: true,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: "{{ url('role-menu') }}",
            columns: [
                { data: 'id', className: "text-center",'searchable':false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'role', name: 'role', render: function (data, type, row, meta) {
                    return row.role.nama_role
                }},
                { data: 'menu', name: 'menu', render: function (data, type, row, meta) {
                    return row.menu == null ? "-" : row.menu.nama_menu;
                }},
                { data: 'status', name: 'status',"orderable": false, className: "text-center", render: function (data, type, row, meta) {
                    return row.status == 1 ? "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','0','-')\"><small data-toggle='tooltip' title='Klik untuk menonaktifkan' class='label label-success'><i class='fa fa-unlock'></i></small></a>" : "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','1','-')\"><small class='label label-danger' data-toggle='tooltip' title='Klik untuk mengaktifkan'><i class='fa fa-lock'></i></small></a>";
                }},
                { data: 'status_tambah', name: 'status_tambah',"orderable": false, className: "text-center", render: function (data, type, row, meta) {
                    return row.status_tambah == 1 ? "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','0','tambah')\"><small data-toggle='tooltip' title='Klik untuk menonaktifkan' class='label label-success'><i class='fa fa-unlock'></i></small></a>" : "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','1','tambah')\"><small class='label label-danger' data-toggle='tooltip' title='Klik untuk mengaktifkan'><i class='fa fa-lock'></i></small></a>";
                }},
                { data: 'status_edit', name: 'status_edit',"orderable": false, className: "text-center", render: function (data, type, row, meta) {
                    return row.status_edit == 1 ? "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','0','edit')\"><small data-toggle='tooltip' title='Klik untuk menonaktifkan' class='label label-success'><i class='fa fa-unlock'></i></small></a>" : "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','1','edit')\"><small class='label label-danger' data-toggle='tooltip' title='Klik untuk mengaktifkan'><i class='fa fa-lock'></i></small></a>";
                }},
                { data: 'status_hapus', name: 'status_hapus',"orderable": false, className: "text-center", render: function (data, type, row, meta) {
                    return row.status_hapus == 1 ? "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','0','hapus')\"><small data-toggle='tooltip' title='Klik untuk menonaktifkan' class='label label-success'><i class='fa fa-unlock'></i></small></a>" : "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','1','hapus')\"><small class='label label-danger' data-toggle='tooltip' title='Klik untuk mengaktifkan'><i class='fa fa-lock'></i></small></a>";
                }},
                { data: 'status_tampil', name: 'statstatus_tampilus_hapus',"orderable": false, className: "text-center", render: function (data, type, row, meta) {
                    return row.status_tampil == 'all' ? "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','user_id','tampil')\"><small data-toggle='tooltip' title='Klik untuk menampilan berdasarkan user id' class='label label-success'>All</small></a>" : "<a href='javascript:void(0)' onclick=\"update_status('"+row.id+"','all','tampil')\"><small class='label label-warning' data-toggle='tooltip' title='Klik untuk menampilkan semua data'>User Id</small></a>";
                }},

                { data: 'id', name: 'aksi',"orderable": false, className: "text-center", 'searchable':false, render: function (data, type, row, meta) {
                    return "<div class='btn btn-group'><a class='btn btn-xs btn-primary' data-toggle='tooltip' href='{{ url('role-menu/ubah') }}/"+row.id+"' title='Edit Data'><i class='fa fa-pencil'></i></a> <a class='btn btn-xs btn-danger' data-toggle='tooltip' onclick=\"delete_data('"+row.id+"')\" title='Hapus Data'><i class='fa fa-trash'></i></a></div>";
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
                    url		: "{{ url('role-menu/delete') }}/"+id,
                    data	: "_method=DELETE&_token="+tokenCSRF,
                    success	:function(data) {
                        if(data.status){
                            swal(
                                {
                                    title: data.status,
                                    text: data.messages,
                                    type: "success",
                                },
                            function(){
                                window.location.reload();
                            });
                        }else{
                            swal({
                                title: "Warning",
                                text: data,
                                type: "warning",
                            });
                        }
                       
                    },
                    error: function(error){
                        error_detail(error);
                    }
                });
            }
        });
    }

    function update_status(id,status,field) {
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
                    url		: "{{ url('role-menu/update_status') }}/"+id,
                    data	: "_method=PUT&_token="+tokenCSRF+"&status="+status+"&field="+field,
                    success	:function(data) {
                        if(data.status){
                            swal(
                                {
                                    title: data.status,
                                    text: data.messages,
                                    type: "success",
                                },
                            function(){
                                var table = $('#role-table').DataTable();
                                table.ajax.reload(null,false);
                            });
                        }else{
                            swal(
                                {
                                    title: "warning",
                                    text: data,
                                    type: "warning",
                                }
                            );
                        }
                       
                    },
                    error: function(er){
                        error_detail(er);
                    }
                });
            }
        });
    }
</script>
@endsection