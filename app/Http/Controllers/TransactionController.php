<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCreateTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getTransactions()
    {
        try {
            $transactions = Transaction::with('products')->get();
            return $this->buildResponse(200, "Success", compact('transactions'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function newTransaction(RequestCreateTransaction $req)
    {
        try {
            $products = $req->input('products');
            $type = $req->input('type');

            $trx = Transaction::create([
                'type' => $type,
            ]);

            foreach ($products as $productData) {
                $product = Product::where('id', $productData['product_id'])->firstOrFail();
                $quantity = $productData['quantity'];

                switch ($type) {
                    case 'stock_out':
                        if ($product->stock < $quantity) {
                            throw new \Exception("Insufficient stock for product ID {$product->id}", 422);
                        }
                        $product->update(['stock' => $product->stock - $quantity]);
                        break;
                    case 'stock_in':
                        $product->update(['stock' => $product->stock + $quantity]);
                        break;
                    default:
                        throw new \Exception('Invalid transaction type: ' . $type, 400);
                }

                $trx->products()->attach($product->id, ['quantity' => $quantity]);
            }
            $trx = Transaction::with('products')->where('id', $trx->id)->first();
            return $this->buildResponse(200, "Success", ['transaction' => $trx]);
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
}
