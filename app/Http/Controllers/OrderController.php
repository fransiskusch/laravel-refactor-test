<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\OrderService;
use App\Http\Requests\StoreOrderRequest;


class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrderRequest $request)
    {
        try {
            $payload = $request->validated();
            $response = $this->orderService->CreateOrder($payload['user_id'], $payload['items']);
            return response()->json($response, 201);
        } catch (\Exception $e) {
            $message = $e->getMessage();

            if ($message == 'Product not found') {
                return response()->json(['error' => 'Product not found'], 404);
            }

            return response()->json(['error' => $message], 400);
        }
    }
}
