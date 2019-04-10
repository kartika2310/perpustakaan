@extends('layouts.backend')

@push('styles')
<link rel="stylesheet" href="{{asset('vendors/bower_components/lightgallery/dist/css/lightgallery.min.css')}}">

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
@endpush

@section('title')
    Import Siswa
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <h2 class="card-header">Import Siswa
            </h2>
            <div class="card-body">
              <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{  url('importsiswa/Import/siswa') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
              <input type="file" name="import_file" />
              <button class="btn btn-primary"><i class="zmdi zmdi-upload"></i> Import File </button>
              </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

<!-- Vendors: Data tables -->
<script src="{{asset('vendors/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/lightgallery/dist/js/lightgallery-all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jquery.uploadPreview.min.js')}}"></script>
<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  var url = {
      importsiswa: '{{ url('importsiswa/Import/siswa') }}'
  }

</script>
@endpush


