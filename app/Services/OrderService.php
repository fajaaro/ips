<?php 

namespace App\Services;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseUser;
use App\Models\Order;
use Carbon\Carbon;

class OrderService
{
	public function create($request)
	{
		if ($request->order_type == 'normal') {
			$order = $this->createOrder($request, $request->course_id);
		} else if ($request->order_type == 'bundle') {
			$courses = CourseCategory::find($request->course_category_id)->courses;

			foreach ($courses as $course) {
				$order = $this->createOrder($request, $course->id);
			}
		}

		return $order;
	}

	private function createOrder($request, $courseId)
	{
		$coursePurchased = Course::find($courseId);

		$order = new Order(); 
		$order->user_id = $request->user_id;
		$order->course_id = $courseId;
		$order->invoice_number = $this->getInvoiceNumber();
		$order->total_price = $coursePurchased->price;

		if ($request->from == 'admin') {
			$order->payment_status = $request->payment_status;

			if ($request->payment_status == 'paid') $order->paid_at = now();
		}

		if ($request->order_type == 'normal') $order->is_bundle = false;
		else if ($request->order_type == 'bundle') $order->is_bundle = true;

		$order->save();

		if ($request->from == 'admin') {
			if ($request->payment_status == 'paid') $this->createCourseUser($order->id, $order->course_id, $order->user_id);
		}

		return $order;
	}

	public function setOrderToPaid(Order $order)
	{
		$order->payment_status = 'paid';
		$order->paid_at = now();
		$order->save();

		$this->createCourseUser($order->id, $order->course_id, $order->user_id);

		return $order;		
	}

	private function createCourseUser($orderId, $courseId, $userId)
	{
		$courseUser = new CourseUser();
		$courseUser->order_id = $orderId;
		$courseUser->course_id = $courseId;
		$courseUser->user_id = $userId;
		$courseUser->expired_at = Carbon::now()->addYear();
		$courseUser->save();

		return $courseUser;						
	}

	private function getInvoiceNumber()
	{
		$order = Order::latest()->first();

		if ($order) return ++$order->invoice_number;
		else return 'IPSLYS2014000001';		
	}

	public function update($request, $orderId)
	{
		
	}

	public function destroy($id)
	{
		$order = Order::find($id);

		if ($order) {
			$order->delete();

			return true;
		} 

		return false;		
	}
}