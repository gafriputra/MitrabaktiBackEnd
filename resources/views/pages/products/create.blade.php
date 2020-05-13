@extends('layouts.default');

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Tambah Barang</strong>
    </div>
    <div class="card-body card-block">
        <form action="{{route('products.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="name">Nama Barang</label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="" value="{{old('name')}}">
             @error('name') <div class="text-muted">{{$message}}</div> @enderror
            </div>
            <div class="form-group">
                <label for="type">Tipe Barang</label>
                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" placeholder="" value="{{old('type')}}">
                @error('type') <div class="text-muted">{{$message}}</div> @enderror

            </div>
            <div class="form-group">
                <label for="description">Deskripsi Barang</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control ckeditor @error('description') is-invalid @enderror">{{old('description')}}</textarea>
             @error('description') <div class="text-muted">{{$message}}</div> @enderror
            </div>
            <div class="form-group">
                <label for="price">Harga Barang</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="" value="{{old('price')}}">
               @error('price') <div class="text-muted">{{$message}}</div> @enderror
            </div>
            <div class="form-group">
                <label for="quantity">Kuantitas Barang</label>
                <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="" value="{{old('quantity')}}">
               @error('quantity') <div class="text-muted">{{$message}}</div> @enderror
            </div>
            <div class="form-gruop">
                <button class="btn btn-outline-primary" type="submit">+ Tambah Barang</button>
            </div>
        </form>
    </div>
</div>
@endsection
