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
            font-weight: bold;
            color: #495057;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Enhanced Button Styles */
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

        .btn-danger {
            background: linear-gradient(90deg, #dc3545, #c82333);
            color: #ffffff;
            border: none;
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(90deg, #c82333, #dc3545);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(220, 53, 69, 0.4);
        }

        /* Table Styles */
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
            text-align: left;
        }

        .thead-light th {
            background-color: #e9ecef;
            color: #495057;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .table th, .table td {
            padding: 15px;
            border: 1px solid #dee2e6;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .btn {
                padding: 10px;
                font-size: 0.875rem;
            }

            .table {
                font-size: 0.875rem;
            }

            .table th, .table td {
                padding: 10px;
            }
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard Admin</a>
    </div>

    <h1>Daftar Kategori</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Tambah Kategori</a>
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
