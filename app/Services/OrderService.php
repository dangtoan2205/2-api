<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    public function getRepository()
    {
        return OrderRepositoryInterface::class;
    }

    public function checkout($data)
    {
        $data['order_date'] = Carbon::now('Asia/Ho_Chi_Minh');
        $data['order_number'] = rand(100000000, 1000000000000);
        $order =  $this->repository->store($data);
        $carts =  $data['cart'];
        $detail = [];
        foreach ($carts as $cart) {
            $detail[] = [
                'product_id' => $cart['id'],
                'total' => $cart['price'] * $cart['quantity'],
                'price' => $cart['price'],
                'quantity' => $cart['quantity']
            ];
        }
        $order->products()->attach($detail);
    }
    public function getInvoice($order)
    {
        $result = DB::table('orders')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->select('products.name', 'order_details.total', 'order_details.price', 'order_details.quantity')
            ->where('orders.id', $order)
            ->get();
        return $result;
    }

}
