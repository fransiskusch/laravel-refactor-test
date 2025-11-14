<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder(int $userId, array $items)
    {
        return DB::transaction(function () use ($userId, $items) {
            $total = 0;
            $order = Order::create([
                'user_id' => $userId,
                'total' => $total,
            ]);

            foreach ($items as $it) {
                $product = Product::where('id', $it['product_id'])
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    return response()->json(['error' => 'Product not found'], 404);
                }

                if ($product->stock < $it['quantity']) {
                    DB::rollBack();
                    return response()->json(['error' => 'Out of stock'], 400);
                }

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $it['product_id'],
                    'quantity' => $it['quantity'],
                    'price' => $product->price,
                ]);

                $product::find($it['product_id'])->decrement('stock', $it['quantity']);

                $total += $orderItem->price * $orderItem->quantity;
            }
            $order->update(['total' => $total]);

            return $order;
        });
    }
}
