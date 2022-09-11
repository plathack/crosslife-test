<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Product;
use App\Models\ReservedProduct;


class CreateOrderAction
{
    public function __invoke(array $data): Order|string
    {
        foreach ($data['products'] as $k => $e) {
            $product = Product::where('id', $e['id'])->get();

            if ($e['count'] > $product[0]['count']) {
                return 'Не хавтает товара на складе';
            }
        }

        $reservedProducts = [];

        $order = Order::create($data);

        foreach ($data['products'] as $k => $e) {
            $reservedProducts[$k] = ['order_id' => $order['id'], 'product_id' => $e['id'], 'price' => Product::where('id', $e)->get('price')[0]['price'], 'count' => $e['count']];

            $product = Product::where('id', $e['id'])->get();

            Product::where('id', $e['id'])->update(['count' => $product[0]['count'] - $e['count']]);
        }

        ReservedProduct::insert($reservedProducts);

        return $order;
    }
}
