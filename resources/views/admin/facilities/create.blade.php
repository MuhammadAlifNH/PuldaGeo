@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 700px;
        margin: auto;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
        font-family: 'Arial', sans-serif;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #555;
    }

    .form-control, .form-group select {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        font-size: 16px;
        width: 100%;
    }

    .form-control:focus, .form-group select:focus {
        border-color: #28a745;
        outline: none;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color:rgb(235, 248, 56);
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-secondary:hover {
        background-color:rgb(228, 255, 76);
    }

    .d-flex {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 20px;
    }
</style>

<div class="container mt-4">
    <h1>Tambah Fasilitas Umum</h1>

    <form action="{{ route('facilities.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Fasilitas</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="latitude">Lintang</label>
            <input type="text" name="latitude" id="latitude" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="longitude">Bujur</label>
            <input type="text" name="longitude" id="longitude" class="form-control" required>
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
