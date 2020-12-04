<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Bundle;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('backend.orders.index', compact('orders'));
    }

    public function create()
    {
        $courses = Course::all();
        $users = User::all();

        $bundles = Bundle::all();

        return view('backend.orders.create', compact('courses', 'users', 'bundles'));
    }

    public function store(Request $request, OrderService $orderService)
    {
        $order = $orderService->create($request);

        if ($order) {
            return redirect()->route('backend.orders.index')->with('success', 'Berhasil membuat order baru untuk ' . $order->user->first_name . ' ' . $order->user->last_name . '!');
        } else {
            $buyer = User::find($request->user_id);

            return back()->with('failed', 'Gagal membuat order baru.');
        }
    }

    public function show($id)
    {
        $order = Order::with([
            'user', 
            'course', 
            'bundle', 
            'courseUser'
        ])->where('id', $id)->first();

        return view('backend.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $courses = Course::all();
        $users = User::all();

        return view('backend.orders.edit', compact('order', 'courses', 'users'));
    }

    public function update(Request $request, $id, OrderService $orderService)
    {
        $updatedOrder = $orderService->update($request, $id);

        if ($updatedOrder) {
            return redirect()->route('backend.orders.index')->with('success', 'Berhasil memperbarui data orderan milik ' . $updatedOrder->user->first_name . ' ' . $updatedOrder->user->last_name . '!');                                
        } else {
            return redirect()->route('backend.orders.index')->with('failed', 'Gagal memperbarui data orderan!');
        }
    }

    public function destroy($id, OrderService $orderService)
    {
        $deletedOrder = Order::find($id);    

        if ($orderService->destroy($id)) {
            return redirect()->route('backend.orders.index')->with('success', 'Berhasil menghapus orderan milik ' . $deletedOrder->user->first_name . ' ' . $deletedOrder->user->last_name . '!');            
        } else {
            return redirect()->route('backend.orders.index')->with('failed', 'Gagal menghapus orderan milik ' . $deletedOrder->user->first_name . ' ' . $deletedOrder->user->last_name . '!');                        
        }
    }
}
