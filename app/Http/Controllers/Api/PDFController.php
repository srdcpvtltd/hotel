<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdvanceBooking;
use App\Models\Booking;
use App\Models\HotelProfile;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function download_invoice(Request $request)
    {
        // Retrieve hotel profile associated with the authenticated user
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
    
        // Redirect if no hotel profile exists
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create a hotel profile first.");
        }
    
        // Fetch the booking details along with related data
        $booking = Booking::where('user_id', Auth::id())
            ->where('id', $request->booking_id)
            ->with(['country', 'state', 'city', 'rooms', 'accompanies', 'nationalityName', 'p_country', 'p_city', 'p_state'])
            ->first();
    
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }
    
        // Retrieve advance booking details
        $advance_booking = AdvanceBooking::where('hotel_id', $hotel->id)
            ->where('from_date', $booking->arrival_date)
            ->where('name', $booking->gues_name)
            ->where('phone_number', $booking->mobile_number)
            ->orderBy('id', 'DESC')
            ->first();
    
        // Retrieve associated orders
        $orders = Order::where('hotel_id', $hotel->id)
            ->where('booking_id', $request->booking_id)
            ->where('status', 1)
            ->get();
    
        // Prepare data for the PDF
        $data = [
            'booking' => $booking,
            'advance_booking' => $advance_booking,
            'orders' => $orders,
            'hotel' => $hotel,
        ];
    
        // Generate the PDF using a view
        $pdf = Pdf::loadView('pdf.invoice', $data);
    
        // Save the PDF to a public path
        $filePath = public_path("invoices/invoice_{$request->booking_id}.pdf");
        $pdf->save($filePath);
    
        // Serve the PDF as a download
        if (file_exists($filePath)) {
            return response()->download($filePath, "invoice_{$request->booking_id}.pdf", [
                'Content-Type' => 'application/pdf',
            ])->deleteFileAfterSend(true); // Deletes the file after it's served
        } else {
            return redirect()->back()->with('error', 'Failed to generate the invoice.');
        }
    } 
}
