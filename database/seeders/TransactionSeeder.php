<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // stock_out
        $trxStockOut = Transaction::create([
            'type' => 'stock_out'
        ]);

        $products = Product::limit(3)->get();
        foreach ($products as $p) {
            $trxStockOut->products()->attach($p->id, ['quantity' => 2]);
            $p->update([
                'stock' => $p->stock - 2
            ]);
        }

        // stock_in
        $trxStockIn = Transaction::create([
            'type' => 'stock_in'
        ]);
        foreach ($products as $p) {
            $trxStockIn->products()->attach($p->id, ['quantity' => 2]);
            $p->update([
                'stock' => $p->stock + 2
            ]);
        }
    }
}
