<?php

namespace App\Http\Controllers;

use App\Models\AdvanceBooking;
use App\Models\Booking;
use App\Models\HotelProfile;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function download_invoice($id)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();

        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $booking = Booking::where('user_id', Auth::id())->where('id', $id)->with(['country', 'state', 'city', 'rooms', 'accompanies', 'nationalityName', 'p_country', 'p_city', 'p_state'])->first();

        $advance_booking = AdvanceBooking::where('hotel_id', $hotel->id)->where('from_date', $booking->arrival_date)->where('name', $booking->gues_name)->where('phone_number', $booking->mobile_number)->orderBy('id', 'DESC')->first();
        
        $orders = Order::where('hotel_id', $hotel->id)->where('booking_id', $id)->where('status', 1)->get();

        $data = ['booking' => $booking, 'advance_booking' => $advance_booking, 'orders' => $orders, 'hotel' => $hotel];
        $pdf = Pdf::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');
    }
}
