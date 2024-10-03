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
            $products = Product::get();
            return $this->buildResponse(200, "Success", compact('products'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function storeProduct(RequestStoreProduct $req)
    {
        try {
            $products = Product::create($req->all());
            return $this->buildResponse(200, "Success", compact('products'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function updateProduct(RequestUpdateProduct $req)
    {
        try {
            $product = Product::find($req->input('id'))->first();
            if (!$product) {
                throw new \Exception('Not found');
            }
            $product->update([
                'name' => $req->input('name'),
                'description' => $req->input('description'),
                'stock' => $req->input('stock'),
            ]);
            return $this->buildResponse(200, "Success", compact('product'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function deleteProduct(Request $req)
    {
        try {
            $product = Product::find($req->input('id'))->first();
            if (!$product) {
                throw new \Exception('Not found');
            }
            $product->delete();
            return $this->buildResponse(200, "Success", compact('product'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
}
