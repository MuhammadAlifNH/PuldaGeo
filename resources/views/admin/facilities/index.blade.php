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

        /* Highlight Row */
        .table-row-highlight {
            background-color: #d4edda !important;
            transition: background-color 0.3s ease;
        }

        /* Button Styles */
        .btn-primer {
            background-color: #007bff;
            border: none;
            color: #ffffff;
            padding: 5px 15px;
            font-size: 0.875rem;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .btn-primer:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .btn {
            font-weight: bold;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1rem;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
            z-index: 1;
        }

        .btn:hover::after {
            left: 0;
        }

        .btn-success {
            background: linear-gradient(90deg, #28a745, #218838);
            color: #ffffff;
            border: none;
            box-shadow: 0 4px 6px rgba(40, 167, 69, 0.3);
        }

        .btn-success:hover {
            background: linear-gradient(90deg, #218838, #28a745);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(40, 167, 69, 0.4);
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: #ffffff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #007bff);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 123, 255, 0.4);
        }

        .btn-warning {
            background: linear-gradient(90deg, #ffc107, #e0a800);
            color: #212529;
            border: none;
            box-shadow: 0 4px 6px rgba(255, 193, 7, 0.3);
        }

        .btn-warning:hover {
            background: linear-gradient(90deg, #e0a800, #ffc107);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(255, 193, 7, 0.4);
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

            .btn-primer {
                padding: 5px 10px;
                font-size: 0.8rem;
            }
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard Admin</a>
    </div>

    <h1>Daftar Fasilitas Umum</h1>

    <div id="map" class="mb-4" style="height: 300px;"></div>

    <div class="row">
        <div class="col">
            <h2>Data Fasilitas Umum</h2>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('facilities.create') }}" class="btn btn-success">Tambah Fasilitas Umum</a>
            </div>

            <div>
                <p> </p>
            </div>

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
                        <tr id="row-{{ $loop->iteration }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $facility->name }}</td>
                            <td>{{ $facility->category->name }}</td>
                            <td>{{ $facility->description }}</td>
                            <td>
                                Lintang: {{ $facility->latitude }}, Bujur: {{ $facility->longitude }}
                            </td>
                            <td>
                            <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Hapus</button>
                            </form>
                                <button class="btn btn-primer btn-sm" onclick="highlightRow('row-{{ $loop->iteration }}'); showOnMap('{{ $facility->latitude }}', '{{ $facility->longitude }}')">Lihat pada peta</button>
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

    // Function to highlight the clicked row
    function highlightRow(rowId) {
        // Remove highlight from all rows
        document.querySelectorAll('tr').forEach(row => row.classList.remove('table-row-highlight'));

        // Add highlight to the clicked row
        document.getElementById(rowId).classList.add('table-row-highlight');
    }
</script>
@endsection