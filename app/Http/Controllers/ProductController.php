<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
            });
        }

        $products = $query->paginate(10);

        $currentPage = $products->currentPage();
        $perPage = $products->perPage();
        $offset = ($currentPage - 1) * $perPage;

        if ($request->ajax()) {
            return view('products.partials.product_table', compact('products', 'offset'))->render();
        }

        return view('products.index', [
            'products' => $products,
            'categories' => Category::all(),
            'offset' => $offset
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:products,name|max:255',
            'purchase_price' => 'required|string|min:0',
            'sale_price' => 'required|string|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $imageName);
                $imagePath = 'products/' . $imageName;
            } else {
                $imagePath = null;
            }

            $purchase = str_replace(',', '', $request->purchase_price);
            $sale = str_replace(',', '', $request->sale_price);

            $data = [
                $request->category_id,
                $request->name,
                $purchase,
                $sale,
                $request->stock,
                $imagePath,
            ];

            DB::insert(
                'INSERT INTO products (category_id, name, purchase_price, sale_price, stock, image, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())',
                $data
            );

            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Produk gagal ditambahkan: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:products,name,' . $product->id . '|max:255',
            'purchase_price' => 'required|string|min:0',
            'sale_price' => 'required|string|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if ($request->hasFile('image')) {
                $oldImage = DB::table('products')->where('id', $product->id)->value('image');
                if ($oldImage && file_exists(public_path($oldImage))) {
                    unlink(public_path($oldImage));
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $imageName);
                $imagePath = 'products/' . $imageName;
            } else {
                $imagePath = DB::table('products')->where('id', $product->id)->value('image');
            }

            $purchase = str_replace(',', '', $request->purchase_price);
            $sale = str_replace(',', '', $request->sale_price);

            $data = [
                $request->category_id,
                $request->name,
                $purchase,
                $sale,
                $request->stock,
                $imagePath,
                $product->id
            ];

            DB::update(
                'UPDATE products SET category_id = ?, name = ?, purchase_price = ?, sale_price = ?, stock = ?, image = ?, updated_at = NOW() WHERE id = ?',
                $data
            );

            return redirect()->route('products.index')->with('success', 'Produk berhasil diedit.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Produk gagal diedit: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                if ($product->image) {
                    $imagePath = public_path($product->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                DB::statement('DELETE FROM products WHERE id = :id', ['id' => $product->id]);
            });

            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Produk gagal dihapus: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $search = $request->get('search');
        $categoryId = $request->get('category');

        $query = Product::query();

        if ($categoryId && $categoryId != 'all') {
            $query->where('category_id', $categoryId);
        }

        if ($search) {
            $search = strtolower($search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
            });
        }

        $products = $query->with('category')->get();
        return Excel::download(new ProductsExport($products), "products_" . time() . ".xlsx");
    }
}
