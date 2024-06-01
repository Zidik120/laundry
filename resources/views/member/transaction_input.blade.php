@extends('member.template.main')

@section('css')
    <link href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Pesanan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.transactions.session.store') }}" method="post">
                                @csrf
                                <!-- <div class="form-group row">
                                    <label for="id-member" class="col-sm-2 col-form-label">ID Member</label>
                                    <div class="col-sm-2">
                                        <input type="number" min="1" class="form-control" id="id-member"
                                            name="member-id"
                                            @if (isset($memberIdSessionTransaction)) value="{{ $memberIdSessionTransaction }}"
                                        disabled title="Harap selesaikan transaksi yang ada untuk mengganti id member" @endif
                                            required>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="barang" class="col-sm-2 col-form-label">Barang</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="barang" name="item">
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="servis" class="col-sm-2 col-form-label">Servis</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="servis" name="service">
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="kategori" name="category">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Penjemputan</label>

                                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
                                <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

                                <style>
                                    html, body {
                                        height: 100%;
                                        margin: 0;
                                    }
                                    .leaflet-container {
                                        height: 400px;
                                        width: 600px;
                                        max-width: 100%;
                                        max-height: 100%;
                                    }
                                </style>

                                <style>body { padding: 0; margin: 0; } #map { height: 100%; width: 100vw; }</style>
                                </head>
                                <body>

                                <div id="map"></div>
                                <script>
                                var map = L.map('map').fitWorld().setView([51.505, -0.09], 13);
                                var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA', {
                                    maxZoom: 18,
                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                    id: 'mapbox/streets-v11',
                                    tileSize: 512,
                                    zoomOffset: -1
                                }).addTo(map);
                                var marker = L.marker([51.5, -0.09]).addTo(map)
                                    .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();
                                var circle = L.circle([51.508, -0.11], {
                                    color: 'red',
                                    fillColor: '#f03',
                                    fillOpacity: 0.5,
                                    radius: 500
                                }).addTo(map).bindPopup('I am a circle.');
                                var polygon = L.polygon([
                                    [51.509, -0.08],
                                    [51.503, -0.06],
                                    [51.51, -0.047]
                                ]).addTo(map).bindPopup('I am a polygon.');
                                var popup = L.popup()
                                    .setLatLng([51.513, -0.09])
                                    .setContent('I am a standalone popup.')
                                    .openOn(map);
                                function onMapClick(e) {
                                    popup
                                        .setLatLng(e.latlng)
                                        .setContent('You clicked the map at ' + e.latlng.toString())
                                        .openOn(map);
                                }
                                map.on('click', onMapClick);
                                </script>
                                </div>
                                <div class="form-group row">
                                    <label for="banyak" class="col-sm-2 col-form-label">Banyak</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number"
                                                    data-type="minus" data-field="">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity"
                                                class="form-control input-number" value="1" min="1"
                                                max="100">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-right-plus btn btn-success btn-number" data-type="plus"
                                                    data-field="">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" id="tambah-transaksi" class="btn btn-primary">Tambah
                                            Pesanan</button>
                                    </div>
                                </div>
                            </form>
                            <table id="tbl-input-transaksi" class="table mt-2 dt-responsive nowrap" style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>Servis</th>
                                        <th>Kategori</th>
                                        <th>Banyak</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                            @if (isset($sessionTransaction))
                                <button id="btn-bayar" class="btn btn-success" data-toggle="modal"
                                    data-target="#paymentModal">Bayar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('modals')
    <x-admin.modals.payment-modal :$serviceTypes :vouchers="$vouchers ?? []" :totalPrice="$totalPrice ?? '0'" :show="isset($sessionTransaction)" />
@endsection

@section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tbl-input-transaksi').DataTable({
                "searching": false,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": false,
                "bInfo": false
            });
        });
    </script>

    @if (session('id_trs'))
        <script type="text/javascript">
            window.open('{{ route('admin.transactions.print.index', ['transaction' => session('id_trs')]) }}', '_blank');
        </script>
    @endif
@endsection
