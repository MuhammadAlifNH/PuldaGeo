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

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #495057;
            font-weight: bold;
            text-align: center;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            background-color: #ffffff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100%; /* Agar elemen di dalamnya memenuhi tinggi kartu */
        }

        .card h5 {
            margin-bottom: auto; /* Dorong elemen lainnya ke bawah */
            font-size: 1.25rem;
            color: #007bff;
        }

        .card p {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }

        /* Button Styles */
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 1rem;
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

            .card {
                margin-bottom: 20px;
            }

            .card p {
                font-size: 2.5rem;
            }
        }
    </style>

    <h1>Admin Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Kategori</h5>
                    <p class="display-4">{{ $categoryCount }}</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Atur Kategori</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Fasilitas Umum</h5>
                    <p class="display-4">{{ $facilityCount }}</p>
                    <a href="{{ route('facilities.index') }}" class="btn btn-primary">Atur Fasilitas Umum</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
