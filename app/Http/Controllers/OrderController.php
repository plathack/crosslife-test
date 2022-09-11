<?php

namespace App\Http\Controllers;

use App\Actions\ApproveOrderAction;
use App\Actions\CreateOrderAction;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\ReservedProduct;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request, CreateOrderAction $createOrderAction)
    {
        $data = $request->validate([
            'status' => ['required', 'string'],
            'user_id' => ['required'],
            'products' => ['required', 'array']
        ]);

        $order = $createOrderAction($data);

        return new OrderResource([
            'result' => $order,
        ]);
    }

    public function approve(Request $request, ApproveOrderAction $approveOrderAction)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'order_id' => ['required']
        ]);

        $result = $approveOrderAction($data);

        return new OrderResource([
            'result' => $result
        ]);
    }
}
