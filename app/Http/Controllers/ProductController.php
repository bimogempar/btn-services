<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreProduct;
use App\Http\Requests\RequestUpdateProduct;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts()
    {
        try {
            $products = Product::with('categoryProduct')->get();
            return $this->buildResponse(200, "Success", compact('products'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function storeProduct(RequestStoreProduct $req)
    {
        try {
            $body = $req->all();
            $product = Product::create($body);
            return $this->buildResponse(200, "Success", compact('product'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function updateProduct(RequestUpdateProduct $req)
    {
        try {
            $product = Product::where('id', $req->input('id'))->firstOrFail();
            $product->update([
                'name' => $req->input('name'),
                'description' => $req->input('description') ?? $product->description,
                'stock' => $req->input('stock') ?? $product->stock,
                'category_id' => $req->input('category_id') ?? $product->category_id,
            ]);
            return $this->buildResponse(200, "Success", compact('product'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function deleteProduct(Request $req)
    {
        try {
            $product = Product::where('id', $req->input('id'))->firstOrFail();
            $product->delete();
            return $this->buildResponse(200, "Success", null);
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
}
