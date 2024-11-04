<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Admin;
use App\Models\Property;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Village;
use App\Models\Volunteer;
use App\Models\Attendees;

use App\Models\Module;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index(Request $request) {
        // echo date('Y-m-d h:i:s'); exit;
        $query = Event::query();
        $event_category = EventCategory::orderBy('created_at','desc')->get();
        $villages = Village::orderBy('created_at','desc')->get();
        $attendees = Attendees::orderBy('created_at','desc')->get();
        $volunteers = Volunteer::orderBy('created_at','desc')->get();
        $total_villages = Village::where('status', '1')->count();
        $total_volunteers = Volunteer::where('status', '1')->count();
        $total_completed_events = Event::where('event_status', 'Completed')->where('status', '1')->count();
        $total_upcoming_events = Event::where('event_status', 'Upcoming')->where('status', '1')->count();
        $total_pending_events = Event::where('event_status', 'Upcoming')->where('status', '1')->count();
        $modules = Module::with('subModules')->get();
        $events=array();
        if (isset($request->status)) {
            // echo $request->status;
            $query->where('status', $request->status);
        }
        if (isset($request->event_status)) {
            // echo $request->status;
            $query->where('event_status', $request->event_status);
        }

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        $query->whereDate('created_at','>=',date('Y-m-d h:i:s'));
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'DESC');
        $per_page = $request->input('per_page', 5); // Default to 5 if not specified
        $query->orderBy($sortBy, $sortDirection);
           if ($per_page === 'all') {
            // Fetch all records if 'all' is selected
            $events = $query->paginate($query->count());
        } else {
            // Paginate results otherwise
            $events = $query->paginate($per_page);
        }
        return view('admin.home', compact('events','event_category','villages','attendees','volunteers','total_villages','total_volunteers','total_completed_events','total_upcoming_events','total_pending_events','modules'));
    }


}
