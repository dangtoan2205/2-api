<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function checkout(OrderRequest $request)
    {
        try {
            $result = $this->orderService->checkout($request->all());
            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
    public function getOrder()
    {
        try {
            $orders = $this->orderService->getAll($paginate = true);
            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
    public function getOrderDetails($order)
    {
        try {
            $detail = $this->orderService->find($order);
            $products = $this->orderService->getInvoice($order);
            return response()->json(
                [
                    'detail' => $detail,
                    'products' => $products
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }

}

