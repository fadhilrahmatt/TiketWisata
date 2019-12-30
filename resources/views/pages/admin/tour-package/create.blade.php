@extends('layouts.admin')
@section('title','TOUR ADMIN')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Paket Wisata</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('tour-package.store') }}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" name="location" placeholder="Location" value="{{ old('location') }}">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                    <textArea name="about" rows="10" class="d-block w-100 form-control">{{ old('about') }}</textArea>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" placeholder="date" value="{{ old('date') }}">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" name="type" placeholder="Type" value="{{ old('type') }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" placeholder="Price" class="form-control" value="{{ old('price') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection
