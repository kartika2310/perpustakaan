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
    Beranda
@endsection
@section('content')
<div class="row">
    <div class="col-12">
    
             <header class="content_title">
        <h1>Data Perpustakaan Per Bulan</h1>
      </header>

           <div class="row quick-stats">
                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-blue">
                            <div class="quick-stats__info">
                                <h2>{{$buku_dipinjam}}</h2>
                                <small>Buku Dipinjam</small>
                            </div>
                            <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                        </div>
                        
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-amber">
                            <div class="quick-stats__info">
                                <h2>{{$buku_dikembalikan}}</h2>
                                <small>Buku Dikembalikan</small>
                            </div>
                            <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-green">
                            <div class="quick-stats__info">
                                <h2>{{$pengunjung}}</h2>
                                <small>Pengunjung Perpustakaan</small>
                            </div>
                            <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                        </div>
                    </div>
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

@endpush
