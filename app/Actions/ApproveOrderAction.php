<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Product;
use App\Models\ReservedProduct;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ApproveOrderAction
{
    public function __invoke($data): string
    {
        $balance = User::where('id', $data['user_id'])->get('balance')[0]['balance'];

        $amount = ReservedProduct::where('order_id', $data['order_id'])->sum('price');

        if ($balance < $amount) {
            return 'Недостаточно средств на балансе';
        }

        User::where('id', $data['user_id'])->update(['balance' => $balance - $amount]);

        Order::where('id', $data['order_id'])
        ->where('user_id', $data['user_id'])
        ->update(['status' => 'approved']);

        return 'Заказ подтвержден';
    }
}


