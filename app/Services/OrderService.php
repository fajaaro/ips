<?php 

namespace App\Services;

use App\Models\Bundle;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class OrderService
{
	public function create($request)
	{
		if ($request->order_type == 'single') {
			$buyer = User::find($request->user_id);
			if ($buyer->hasCourse($request->course_id)) return false;
			
			$order = $this->createOrder($request, $request->course_id);
	
			if ($order->payment_status == 'paid') {
				$this->createCourseUser($order->id, $order->course_id, $order->user_id);
			}				
		} else if ($request->order_type == 'bundle') {
			$order = $this->createOrder($request, null, $request->bundle_id);

			if ($order->payment_status == 'paid') {
				$courses = Bundle::find($request->bundle_id)->courses;

				foreach ($courses as $course) {
					$this->createCourseUser($order->id, $course->id, $order->user_id);
				}
			}
		}

		return $order;
	}

	private function createOrder($request, $courseId = null, $bundleId = null)
	{
		$order = new Order(); 
		$order->user_id = $request->user_id;
		
		if ($courseId) {
			$order->course_id = $courseId;
			$order->total_price = Course::find($courseId)->price;
		} else if ($bundleId) {
			$order->bundle_id = $bundleId;
			$order->total_price = Bundle::find($bundleId)->price;
		}

		$order->invoice_number = $this->getInvoiceNumber();

		if ($request->from == 'admin') {
			$order->payment_status = $request->payment_status;

			if ($request->payment_status == 'paid') $order->paid_at = now();
		}

		$order->save();

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

	private function setOrderToPaid($id)
	{
		$order = Order::find($id);
		$order->payment_status = 'paid';
		$order->paid_at = now();
		$order->save();

		return $order;		
	}

	private function getInvoiceNumber()
	{
		$order = Order::latest()->first();

		if ($order) return ++$order->invoice_number;
		else return 'IPSLYS2014000001';		
	}

	public function update($request, $orderId)
	{
		if ($request->payment_status == 'paid') {
			$order = $this->setOrderToPaid($orderId);

			if ($order->course_id) {
				$this->createCourseUser($order->id, $order->course_id, $order->user_id);
			} else {
				$courses = Bundle::find($order->bundle_id)->courses;

				foreach ($courses as $course) {
					$this->createCourseUser($order->id, $course->id, $order->user_id);
				}
			}

			return $order;			
		} 
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