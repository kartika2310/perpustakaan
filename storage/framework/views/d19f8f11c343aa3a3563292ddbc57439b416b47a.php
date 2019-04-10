<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('vendors/bower_components/lightgallery/dist/css/lightgallery.min.css')); ?>">

<style type="text/css">
  .table thead tr th{
    vertical-align: middle;
    text-align: center;
  }
  .table tbody tr td{
    vertical-align: middle;
    text-align: center;
  }

  #data th, #data td {
    font-size: 11px;
  }
  .text-danger 
  {
    text-transform:capitalize;
  }
  .fc-time{
      display: none;
  }
</style>
<style type="text/css">
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    Data Siswa
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <h2 class="card-header"> Daftar Siswa
                <div class="float-right">
                    <button class="btn btn-xs btn-primary" onclick="add()">
                        <i class="zmdi zmdi-file-plus"></i>
                        Tambah</button>
                </div>
            </h2>
            <div class="card-body">
               <form action="<?php echo e(url('delete_multiple')); ?>" method="post" enctype="multipart/formdata">
    <?php echo e(csrf_field()); ?>

                <table id="myTable" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>No Absen</th>
                            <th>No Induk</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><input type="checkbox" name="del_id[]" value="<?php echo e($data->id); ?>"></td>
                <td><?php echo e($data->id); ?></td>
                <td><?php echo e($data->no_absen); ?></td>
                <td><?php echo e($data->no_induk); ?></td>
                <td><?php echo e($data->nama); ?></td>
                <td><?php echo e($data->kelas->kelas); ?></td>
                <td><a onclick="edit('. $data->id .')" class="btn btn-warning btn-xs"><i class="zmdi zmdi-edit"></i> Ubah</a>
                  <a onclick="del('. $data->id .')" class="btn btn-danger btn-xs"><i class="zmdi zmdi-delete"></i> Hapus</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                 <button type="submit" class="btn btn-danger"> Hapus Semua</button>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('siswa._modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<!-- Vendors: Data tables -->
<script src="<?php echo e(asset('vendors/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/bower_components/jszip/dist/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/bower_components/lightgallery/dist/js/lightgallery-all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.uploadPreview.min.js')); ?>"></script>
<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  var url = {
      list: '<?php echo e(url('list/siswa')); ?>',
      action: '<?php echo e(url('action/siswa')); ?>'
  }

  var table = $('#myTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: url.list,
      columns: [
       {data: 'checkbox', name: 'checkbox'},
        {data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
        {data: 'no_absen', name: 'no_absen'},
        {data: 'no_induk', name: 'no_induk'},
        {data: 'nama', name: 'nama'},
        {data: 'kelas.kelas', name: 'kelas.kelas'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ],
      aaSorting: [],
  });

  function add() {
    clear_error();
    $('#reset').click();
    $('#m_form').modal('show');
    $('#type').val('create');
    $('.modal-title').html('Tambah Siswa');
  }

  function edit(id){
    clear_error();
    $('#reset').click();
    $.post(url.action,{
      'type': 'show',
      'id': id ,
  },function(data){
      $('#id').val(data.id);
      $('#no_absen').val(data.no_absen);
      $('#no_induk').val(data.no_induk);
      $('#nama').val(data.nama);
      $('#kelas').val(data.kelas);
      $('#type').val('update');
      $('.modal-title').html('Ubah Siswa');
      $('#m_form').modal('show');
    }); 
  }

  function del(id){
    swal({
      title: 'Apakah kamu yakin?',
      text: 'Data akan terhapus.',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.value) {
       $.post(url.action,{
        'type': 'delete',
        'id': id 
       },function(data){
          table.ajax.reload();
          toast({
            type: 'success',
            title: data.message
          })
       });
      }
    })
  }

  function save(){
    blockUI();
    clear_error();
    $.ajax({
      url: url.action,
      method: 'POST',
      data: $('#f_siswa').serialize(),
      dataType: 'JSON',
      success: function(data){
          $('#m_form').modal('hide');

          toast({
            type: 'success',
            title: data.message
          })

          table.ajax.reload();

          $.unblockUI();
      },
      error:function(xhr){
        let error = xhr.responseJSON.errors;
        for(let key in error){
          let el = $('#'+key);
          el.addClass('is-invalid');
          el.after('<span class="text-danger">'+error[key][0]+'</span>');

          $.unblockUI();
        }
      }
    })
  }

  function clear_error(){
    $('.text-danger').remove();
    $('.is-invalid').removeClass('is-invalid');
  }

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>