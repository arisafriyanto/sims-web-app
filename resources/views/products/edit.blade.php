@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item me-1"><a href="{{ route('products.index') }}">Daftar Produk</a></li>
                            <li class="breadcrumb-item">
                                <i class="fa-solid fa-angle-right" style="font-size: 14px;"></i>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
                        </ol>
                    </nav>
                </div>

                <form id="productForm" action="{{ route('products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select class="form-select form-select-lg" name="category_id" id="category_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Barang</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg"
                                    value="{{ old('name', $product->name) }}" placeholder="Masukan nama barang">

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="purchase_price" class="form-label">Harga Beli</label>
                                <input type="text" name="purchase_price" id="purchase_price"
                                    class="form-control form-control-lg"
                                    value="{{ old('purchase_price', formatRupiah($product->purchase_price)) }}">

                                @error('purchase_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sale_price" class="form-label">Harga Jual</label>
                                <input type="text" name="sale_price" id="sale_price" class="form-control form-control-lg"
                                    value="{{ old('sale_price', formatRupiah($product->sale_price)) }}" readonly>

                                @error('sale_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stok Barang</label>
                                <input type="number" name="stock" id="stock" class="form-control form-control-lg"
                                    value="{{ old('stock', $product->stock) }}" placeholder="Masukan jumlah stok barang">

                                @error('stock')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image</label>

                                <div id="image-upload" class="image-upload-area">
                                    <input type="file" name="image" id="image" class="form-control"
                                        accept=".jpg,.png" style="display:none;">
                                    <div id="image-preview" onclick="document.getElementById('image').click();">
                                        @if ($product->image)
                                            <img src="{{ asset($product->image) }}" alt="Uploaded Image"
                                                class="uploaded-image mb-3" id="uploaded-image"
                                                style="width: 80px; height: 80px;">
                                        @else
                                            <img id="image-icon" src="{{ asset('images/image.png') }}" alt="Image Icon">
                                            <p id="upload-text">Upload gambar disini</p>
                                        @endif
                                    </div>
                                    <p id="image-name"></p>
                                </div>

                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <button type="reset" class="btn btn-outline-primary px-5 me-3">Batalkan</button>
                        <button type="submit" class="btn btn-primary px-5">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @include('products.partials.script')
@endsection
