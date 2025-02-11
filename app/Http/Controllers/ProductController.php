<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('content.products.allproducts', compact('products'));
    }

    public function addProduct()
    {
        $categories = Product_category::all();
        return view('content.products.add-products', compact('categories'));
    }

    public function editProduct($pid)
    {
        $product = Product::find($pid);
        $categories = Product_category::all();
        return view('content.products.edit-product', compact('product', 'pid', 'categories'));
    }

    public function storeProduct(Request $request) {
        $validatedData = $request->validate([
            'pname' => 'required|max:200',
            'pdesc' => 'required|max:1000',
            'pprice' => 'required|max:200',
            'pdetail' => 'string',
            'uploadImg' => 'image|mimes:jpeg,png|max:20480',
        ]);
        try {
            // savefile
            $fileName = '';
            if ($request->hasFile('uploadImg')) {
                // Get the file from the request
                $file = $request->file('uploadImg');

                // Generate a new filename based on the current datetime
                $fileName = now()->format('dmYHis') . '.' . $file->getClientOriginalExtension();

                // Store the file in the 'public' disk with the generated name
                $path = Storage::disk('local')->putFileAs('uploads/product', $file, $fileName);
            }
            $product = Product::create([
                'name' => $validatedData['pname'],
                'desc' => $validatedData['pdesc'],
                'category' => "",
                'price' => $validatedData['pprice'],
                'detail' => $validatedData['pdetail'],
                'create_by' => $request->user()->id,
                'img' => $fileName,
            ]);
            $request->session()->flash('status', 'success!');

            return redirect()->route('admin-products');
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash('error', 'fail!');
            return redirect()->back();
        }
    }

    public function addCate(Request $request)
    {
        $validatedData = $request->validate([
            'cate' => 'required|max:200',
            'prefix' => 'required|max:200',
        ]);

        Product_category::create([
            'name' => $validatedData['cate'],
            'prefix' => $validatedData['prefix'],
        ]);
        return response()->json(['success' => true, 'data' => $request->all()]);
    }

    public function updateProduct(Request $request, $pid) {
        $validatedData = $request->validate([
            'pname' => 'required|max:200',
            'pdesc' => 'required|max:1000',
            'pprice' => 'required|max:200',
            'pdetail' => 'string',
            'uploadImg' => 'image|mimes:jpeg,png|max:20480',
        ]);
        try {
            // savefile
            $fileName = '';
            $product = Product::find($pid);
            if ($request->hasFile('uploadImg')) {
                // Get the file from the request
                $file = $request->file('uploadImg');

                // Generate a new filename based on the current datetime
                $fileName = now()->format('dmYHis') . '.' . $file->getClientOriginalExtension();

                // Store the file in the 'public' disk with the generated name
                $path = Storage::disk('local')->putFileAs('uploads/product', $file, $fileName);

                $filePath = 'uploads/product/'.$product->img;
                if (Storage::disk('local')->exists($filePath)) {
                    Storage::disk('local')->delete($filePath);
                }
            }
            $product->update([
                'name' => $validatedData['pname'],
                'desc' => $validatedData['pdesc'],
                'category' => "",
                'price' => $validatedData['pprice'],
                'detail' => $validatedData['pdetail'],
                'img' => $fileName,
            ]);
            $request->session()->flash('status', 'success!');

            return redirect()->route('admin-products');
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash('error', 'fail!');
            return redirect()->back();
        }
    }

    public function delProduct($pid)
    {
        $product = Product::find($pid);

        $filePath = 'uploads/product/'.$product->img;

        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        }

        $product->delete();

        return response()->json(['success' => true, 'data' => "Product is deleted!"]);
    }
}
