@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="d-flex mx-1 my-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2 mb-3">
                    <div>
                        <div class="d-flex gap-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text search-icon border-end-0 bg-white">
                                    <i class="fa-solid fa-magnifying-glass" style="color: #c7c7c7;"></i>
                                </span>
                                <input class="form-control form-control-sm search border-start-0" type="text"
                                    placeholder="Cari barang" aria-label="Cari barang">
                            </div>

                            <div class="input-group input-group-sm" style="width: 58%;">
                                <span class="input-group-text category-icon border-end-0 bg-white">
                                    <i class="fa-solid fa-table-list"></i>
                                </span>

                                <select class="form-select category form-select-sm border-start-0">
                                    <option value="all" selected>Semua</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex gap-4">
                            <a href="{{ route('products.export') }}" target="_blank" class="btn btn-success btn-sm">
                                <img src="{{ asset('images/excel.png') }}" alt="Logo Excel">
                                Export Excel
                            </a>
                            <a href="{{ route('products.create') }}" class="btn btn-danger btn-sm">
                                <img src="{{ asset('images/plus-circle.png') }}" alt="Logo Plus">
                                Tambah Produk
                            </a>

                        </div>
                    </div>
                </div>
                <div id="productTable">
                    @include('products.partials.product_table', [
                        'products' => $products,
                        'offset' => $offset,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('input', '.search', function() {
                fetchProducts();
                updateExportUrl();
            });

            $(document).on('change', '.category', function() {
                fetchProducts();
                updateExportUrl();
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                const url = $(this).attr('href');
                fetchProducts(url);
            });

            function fetchProducts(url = "{{ route('products.index') }}") {
                const search = $('.search').val();
                const category = $('.category').val();

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        search: search,
                        category: category
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        $('#productTable').html(data);
                    },
                    error: function(xhr) {
                        console.error('Terjadi kesalahan saat memuat data:', xhr);
                    }
                });
            }

            function updateExportUrl() {
                const search = $('.search').val();
                const category = $('.category').val();
                const exportUrl = "{{ route('products.export') }}?search=" + search + "&category=" + category;
                $('a[href^="{{ route('products.export') }}"]').attr('href', exportUrl);
            }
        });
    </script>
@endsection
