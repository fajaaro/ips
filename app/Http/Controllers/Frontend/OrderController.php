<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
	public function store(Request $request, OrderService $orderService)
	{
		$order = $orderService->create($request);

		if ($order) {
			return redirect()->route('frontend.orders.checkout', ['id' => $order->id]);
		} else {
			return back()->with('failed', 'Gagal melakukan order.');
		}
	}

    public function checkout($id)
    {
    	$order = Order::find($id);

    	if ($order->user_id != Auth::user()->id) return response('Unauthorized.', 401);

    	return view('frontend.orders.checkout', compact('order'));
    }
}
