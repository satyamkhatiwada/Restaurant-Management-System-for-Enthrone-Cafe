<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Table;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        $timeslots = Timeslot::all();
        $bookedDates = Booking::pluck('date')->toArray();

        return view('booking', compact('tables', 'timeslots','bookedDates'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'table_id' => 'required|exists:tables,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'date' => 'required|date',
        ]);

        $booking = new Booking();
        $booking->user_id = auth()->id(); // Assuming the user is authenticated
        $booking->name = $request->name;
        $booking->phone = $request->phone;
        $booking->email = $request->email;
        $booking->table_id = $request->table_id;
        $booking->time_slot_id = $request->time_slot_id;
        $booking->date = $request->date;
        $booking->status = 'pending'; // You can set the status as needed
        $booking->save();

        return redirect()->route('home')->with('success', 'Booking created successfully!');
    }

    public function viewBooking(){
        $bookings = Booking::all();
        return view('admin.viewbooking', compact('bookings'));
    }

    public function reschedule($id){
        $bookings = Booking::find($id);
        $tables = Table::all();
        $timeslots = Timeslot::all();
        
    
        return view('admin.reschedule', ['bookings' => $bookings, 'tables' => $tables, 'timeslots' => $timeslots]);
    }
    

    public function rescheduleBooking(Request $request, $id){

        $booking = Booking::find($id);

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'table_id' => 'required|exists:tables,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'date' => 'required|date',
        ]);

        $booking->update([
            'table_id' => $request->input('table_id'),
            'time_slot_id' => $request->input('time_slot_id'),
            'date' => $request->input('date'),
        ]);

        return redirect()->route('admin.booking')->with('success', 'Reservaton updated successfully');
    }

    public function updateBookingStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:pending,canceled,confirmed',
        ]);
        
        $booking = Booking::findOrFail($id);
        $booking->status = $request->input('status');
        $booking->save();
        
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function viewTable(){
        $tables =  Table::all();
        return view('admin.table', compact('tables'));
    }    

    public function viewTimeslot(){
        $timeslots =  Timeslot::all();
        return view('admin.timeslot', compact('timeslots'));
    }   

    public function addTable(){
        return view('admin.addTable');
    }

    public function addTimeslot(){
        return view('admin.addTimeslot');
    }

    public function deleteTable($id){
        $table = Table::find($id);

        if (!$table) {    
        }

        // Delete the category from the database
        $table->delete();

        return redirect()->route('admin.table')->with('success', 'Category deleted successfully');
    }

    public function storeTable(Request $request){
        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|integer',
        ]);
    
        // Create a new table instance and store it in the database
        $table = new Table();
        $table->name = $request->name;
        $table->capacity = $request->capacity;
        $table->save();
    
        // Redirect back with a success message
        return redirect()->route('admin.table')->with('success', 'Table created successfully!');
    }

    public function storeTimeslot(Request $request){
       
        $request->validate([
            'start' => 'required|date_format:H:i', 
            'end' => 'required|date_format:H:i',
        ]);
    
        // Create a new table instance and store it in the database
        $timeSlot = new Timeslot();
        $timeSlot->start_time = $request->start;
        $timeSlot->end_time = $request->end;
        $timeSlot->status = 'available';
        $timeSlot->save();
    
        // Redirect back with a success message
        return redirect()->route('admin.timeslot')->with('success', 'Table created successfully!');
    }

    public function deleteTimeslot($id)
    {
        $timeslot = Timeslot::find($id);
        if (!$timeslot) {
            return response()->json(['message' => 'Timeslot not found'], 404);
        }

        $timeslot->delete();

        return redirect()->route('admin.timeslot')->with('success', 'Category deleted successfully');
    }
    

}
