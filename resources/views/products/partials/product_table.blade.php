<div class="card">
    <div class="card-body px-0 py-0">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Image</th>
                    <th>Nama Produk</th>
                    <th>Kategori Produk</th>
                    <th>Harga Beli (Rp)</th>
                    <th>Harga Jual (Rp)</th>
                    <th>Stok Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                    <tr class="align-middle">
                        <td class="text-center">{{ $offset + $loop->iteration }}</td>
                        <td class="text-center" width="10%">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->image }}" class="img-fluid"
                                style="max-width: 20px;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ formatRupiah($product->purchase_price) }}</td>
                        <td>{{ formatRupiah($product->sale_price) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" title="Edit">
                                <img src="{{ asset('images/edit.png') }}" alt="Icon Edit">
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-white"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk?');">
                                    <img src="{{ asset('images/delete.png') }}" alt="Icon Delete">
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada produk tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

<div>
    {{ $products->links('pagination::bootstrap-5') }}
</div>
