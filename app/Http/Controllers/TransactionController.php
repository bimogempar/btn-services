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
            $transactions = Transaction::with('product')->get();
            return $this->buildResponse(200, "Success", compact('transactions'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function newTransaction(RequestCreateTransaction $req)
    {
        try {
            $product = Product::where('id', $req->input('product_id'))->firstOrFail();
            $quantity = $req->input('quantity');
            $type = $req->input('type');

            switch ($type) {
                case 'stock_out':
                    if ($product->stock < $quantity) {
                        throw new Exception('Insufficient stock for stock_out', 422);
                    }
                    $trx = Transaction::create($req->all());
                    $product->update(['stock' => $product->stock - $trx->quantity]);
                    break;
                case 'stock_in':
                    $trx = Transaction::create($req->all());
                    $product->update(['stock' => $product->stock + $trx->quantity]);
                    break;
                default:
                    throw new Exception('Invalid transaction type: ' . $type, 400);
            }

            $product->available_stock = $product->stock;
            return $this->buildResponse(200, "Success", compact('product'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
}
