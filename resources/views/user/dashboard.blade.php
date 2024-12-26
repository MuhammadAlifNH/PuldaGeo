@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <style>
        /* General Styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            color: #343a40;
        }

        .container {
            padding: 20px;
        }

        h1, h2 {
            font-weight: bold;
            color: #495057;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        h2 {
            font-size: 1.75rem;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        /* Map Styles */
        #map {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Table Styles */
        .table {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .thead-light th {
            background-color: #e9ecef;
            color: #495057;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        /* Button Styles */
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #ffffff;
            padding: 5px 15px;
            font-size: 0.875rem;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .table {
                font-size: 0.875rem;
            }

            .btn-primary {
                padding: 5px 10px;
                font-size: 0.8rem;
            }
        }
    </style>

    <h1>User Dashboard</h1>
    
    <div id="map" class="mb-4" style="height: 300px;"></div>

    <div class="row">
        <div class="col">
            <h2>Daftar Fasilitas Umum</h2>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Tempat</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facilities as $facility)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $facility->name }}</td>
                        <td>{{ $facility->category->name }}</td>
                        <td>{{ $facility->description }}</td>
                        <td>
                            Lintang: {{ $facility->latitude }}, Bujur: {{ $facility->longitude }}
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="showOnMap('{{ $facility->latitude }}', '{{ $facility->longitude }}')">Lihat pada peta</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

<script>
    // Initialize the map
    var map = L.map('map').setView([-6.695972404882771, 110.71963782959877], 15);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 15,
    }).addTo(map);

    // Load GeoJSON files
    fetch('/maps/batas_desa.geojson')
        .then(response => response.json())
        .then(data => {
            L.geoJSON(data, {
                style: { color: 'lime', weight: 2, dashArray: '5,5' }
            }).addTo(map);
        });

    fetch('/maps/garis_sungai.geojson')
        .then(response => response.json())
        .then(data => {
            L.geoJSON(data, {
                style: { color: 'blue', weight: 1 }
            }).addTo(map);
        });

    fetch('/maps/garis_jalan.geojson')
        .then(response => response.json())
        .then(data => {
            L.geoJSON(data, {
                style: { color: 'gray', weight: 2 }
            }).addTo(map);
        });

    // Marker variable
    var marker;

    // Function to show marker on the map
    function showOnMap(lat, lng) {
        if (marker) {
            map.removeLayer(marker);
        }
        map.setView([lat, lng], 15);
        marker = L.marker([lat, lng]).addTo(map);
    }
</script>
@endsection
