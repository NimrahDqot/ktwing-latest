<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Village;
use App\Models\Volunteer;
use App\Models\Attendees;
use App\Models\Notification;
use App\Models\State;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\SubDistrictVillage;

use App\Models\EventCompleteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;
use App\Models\EventPhotoRequest;
use App\Models\EventVideoRequest;
use App\Models\EventAudioRequest;
use Validator;
use Helper;


class EventController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index(Request $request) {
        $query = Event::query();
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
        $event_category = EventCategory::orderBy('created_at','desc')->get();
        $villages = Village::orderBy('created_at','desc')->get();
        $attendees = Attendees::orderBy('created_at','desc')->get();
        $volunteers = Volunteer::orderBy('created_at','desc')->get();
        return view('admin.event.view', compact('events','event_category','villages','attendees','volunteers'));
    }

    public function create() {
        $states = State::orderBy('created_at','desc')->where('country_id',101)->select('id','name')->get();
        $event_category = EventCategory::active()->orderBy('created_at','desc')->get();
        $villages = Village::active()->orderBy('created_at','desc')->get();
        $attendees = Attendees::orderBy('created_at','desc')->get();
          return view('admin.event.create', compact('event_category','villages','attendees','states'));
    }


    public function show($id){
        $event = Event::findOrFail($id);
        $event_category = EventCategory::orderBy('created_at','desc')->get();
        $villages = Village::orderBy('created_at','desc')->get();
        $attendees = Attendees::orderBy('created_at','desc')->get();
        $photoRequests = EventPhotoRequest::where('event_id', $id)->where('status','1')
            ->select('id', 'volunteer_id', 'event_id', 'uploaded_photos', 'status')
            ->get();

        $videoRequests = EventVideoRequest::where('event_id', $id)->where('status','1')
            ->select('id', 'volunteer_id', 'event_id', 'uploaded_videos', 'status')
            ->get();

        $audioRequests = EventAudioRequest::where('event_id', $id)->where('status','1')
            ->select('id', 'volunteer_id', 'event_id', 'uploaded_audios', 'status')
            ->get();
        return view('admin.event.show', compact('event','event_category','villages','attendees','photoRequests','videoRequests','audioRequests'));

    }

    public function store(Request $request) {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        $event = new Event();
        $data = $request->only($event->getFillable());
        $request->validate([
            'event_category_id' => 'required',
            'name' => 'required|string|max:250',
            'description' => 'required|string',
            'village_id' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'event_duration' => 'required',
            'event_agenda' => 'required',
            'expected_attendance' => 'required',
            'resoure_list' => 'required',
            // 'attendees_id' => 'required|array',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120|dimensions:width=800,height=600',
        ]);

        if($request->hasFile('image')){

            $rand_value = md5(mt_rand(11111111,99999999));
            $ext = $request->file('image')->extension();
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/event/'), $final_name);
            unset($data['image']);
            $data['image'] = $final_name;
        }
        $event->fill($data)->save();

return redirect()->route('admin_event_view')->with('success', SUCCESS_ACTION);
    }

    public function edit($id) {
        $event = Event::findOrFail($id);
        $event_category = EventCategory::orderBy('created_at','desc')->get();
        $villages = Village::orderBy('created_at','desc')->get();
        $states = State::orderBy('created_at','desc')->where('country_id', 101)->select('id', 'name')->get();
        $attendees = Attendees::orderBy('created_at','desc')->get();
           // Fetch districts based on the village's state
           $districts = District::where('state_id', $event->state_id)->orderBy('created_at', 'desc')->select('id', 'name')->get();

           // Fetch sub-districts based on the village's district
           $subDistricts = SubDistrict::where('district_id', $event->district_id)->orderBy('created_at', 'desc')->select('id', 'name')->get();

           // Fetch villages based on the village's sub-district
           $subDistrictVillage = SubDistrictVillage::where('sub_district_id', $event->sub_district_id)->orderBy('created_at', 'desc')->select('id', 'name')->get();
            return view('admin.event.edit', compact('event','event_category','villages','attendees', 'states', 'districts', 'subDistricts', 'subDistrictVillage'));



    }

    public function update(Request $request, $id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $event = Event::findOrFail($id);
        $data = $request->only($event->getFillable());


        $request->validate([
            'event_category_id' => 'required',
            'name' => 'required|string|max:250',
            'description' => 'required|string',
            'village_id' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'event_duration' => 'required',
            'event_agenda' => 'required',
            'expected_attendance' => 'required',
            'resoure_list' => 'required',
            // 'attendees_id' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Optional image validation
        ]);

        if($request->hasFile('image')){
            @unlink(public_path('uploads/event/'.$event->image)); // Unlink old image
            $ext = $request->file('image')->extension();
            $rand_value = md5(mt_rand(11111111,99999999));
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/event/'), $final_name);
            $data['image'] = $final_name; // Update with new image name
        }
        $event->fill($data)->save();
        return redirect()->route('admin_event_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $event = Event::findOrFail($id);
        $event->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }

    public function change_status($id) {
        $event = Event::find($id);
        if($event->status == '1') {
            if(env('PROJECT_MODE') == 0) {
                $message=env('PROJECT_NOTIFICATION');
            } else {
                $event->status = '0';
                $message=SUCCESS_ACTION;
                $event->save();
            }
        } else {
            if(env('PROJECT_MODE') == 0) {
                $message=env('PROJECT_NOTIFICATION');
            } else {
                $event->status = '1';
                $message=SUCCESS_ACTION;
                $event->save();
            }
        }
        return response()->json($message);
    }

    public function assign_volunteer(Request $request) {
        // Validate incoming request
       $request->validate([
            'id' => 'required|exists:events,id', // Validate that the ID exists
            'volunteer_id' => 'required|array', // Ensure volunteer IDs are sent as an array
            'volunteer_id.*' => 'exists:volunteers,id', // Ensure each volunteer ID exists
        ]);

        $id = $request->id;
        $volunteer_id = $request->volunteer_id;

        if (!($volunteer_id)) {
            return response()->json(['error' => 'Record not found.'], 404);
        }
        // Find the event
        $event = Event::findOrFail($id);

        // Save volunteer IDs as comma-separated values
        $event->volunteer_id = implode(',', $volunteer_id);
        $event->save();

        // Fetch the assigned volunteers after saving
        $assignedVolunteers = Volunteer::whereIn('id', $volunteer_id)->get(); // Assuming you have a Volunteer model
        // Prepare notification details
        $title = 'New Event Assignment';
        $description = 'You have been assigned to a new event.';
        $type = '0';

        // Send notifications to each assigned volunteer
        foreach ($assignedVolunteers as $volunteer) {
            $this->send_notification($volunteer->id, $title, $description, $type);
        }

        return response()->json([
            'success' => true,
            'message' => 'Volunteers assigned successfully.',
            'assignedVolunteers' => $assignedVolunteers // Send the assigned volunteers in the response
        ]);
    }


    public function send_notification($user_id, $title, $description, $type = null){
    $notification = [
        'user_id' => $user_id,
        'title' => $title,
        'description' => $description,
        'type' => $type,
    ];

    // Create the notification record
    Notification::create($notification);

   // Fetch the user's FCM tokens
   $fcmTokens = Volunteer::where('id', $user_id)->pluck('fcm_token');

   // Send push notification to each device token
   foreach ($fcmTokens as $deviceToken) {
       if ($deviceToken) {
           // Send push notification
           Helper::sendPushNotification($deviceToken, $title, $description);
       }
   }
}

    public function storeAttendee(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $attendees = new Attendees();
        $data = $request->only($attendees->getFillable());

        $request->validate([
            'name' => 'required|string|max:39',
            'role' => 'required|string|max:39',
            'image' => 'nullable',
        ]);
        if($request->hasFile('image')){

            $rand_value = md5(mt_rand(11111111,99999999));
            $ext = $request->file('image')->extension();
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/attendees/'), $final_name);
            unset($data['image']);
            $data['image'] = $final_name;
        }
        $attendees->fill($data)->save();
        return response()->json([
            'success' => true,
            'message' => 'Attendee created successfully.',
            'attendee' => [
                'id' => $attendees->id,
                'name' => $attendees->name,
            ],
        ]);

    }

    public function assign_attendee(Request $request) {

        // Validate incoming request
        $request->validate([
            'id' => 'required|exists:events,id', // Validate that the ID exists
            'attendees_id' => 'required|array', // Ensure volunteer IDs are sent as an array
        ]);

        $id = $request->id;
        $attendees_id = $request->attendees_id;

        // Find the event
        $event = Event::find($id);

        if (!$attendees_id) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        // Save volunteer IDs as comma-separated values
        $event->attendees_id = implode(',', $attendees_id);
        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Attendees assigned successfully.',

        ]);
    }

    public function event_request(Request $request){
        // $users = Volunteer::all();
        $events = Event::where('event_status','Completed')->select('id','name','volunteer_id')->get();
        $volunteers = Volunteer::orderBy('created_at','desc')->get();

        return view('admin.event.event_request', compact('events','volunteers'));
        $users = Event::orderBy('created_at','desc')->where('event_status','Completed')->get();
            return view('admin.event.event_request', compact('users'));
    }


    public function user_media_details($userId)
    {
        // Fetch related media requests
        $photoRequests = EventPhotoRequest::where('event_id', $userId)
            ->select('id', 'volunteer_id', 'event_id', 'uploaded_photos', 'status')
            ->get();

        $videoRequests = EventVideoRequest::where('event_id', $userId)
            ->select('id', 'volunteer_id', 'event_id', 'uploaded_videos', 'status')
            ->get();

        $audioRequests = EventAudioRequest::where('event_id', $userId)
            ->select('id', 'volunteer_id', 'event_id', 'uploaded_audios', 'status')
            ->get();

        // Get the active tab from the request or default to 'photo'
        $activeTab = request()->get('activeTab', 'photo');

        return view('admin.event.user_media', compact('photoRequests', 'videoRequests', 'audioRequests', 'activeTab'));
    }


    public function updateMediaStatus($id, $type, $status)
    {
        // Determine which model to use based on the 'type' parameter
        switch ($type) {
            case 'photo':
                $mediaModel = new EventPhotoRequest();
                break;
            case 'video':
                $mediaModel = new EventVideoRequest();
                break;
            case 'audio':
                $mediaModel = new EventAudioRequest();
                break;
            default:
                return redirect()->back()->with('error', 'Invalid media type');
        }

        // Fetch the media by its ID
        $media = $mediaModel->find($id);

        if (!$media) {
            return redirect()->back()->with('error', ucfirst($type) . ' not found');
        }

        // Update the media status
        $media->status = $status;
        $media->save();

        // Redirect{{ ADD_NEW }}with success message and active tab
        return redirect()->route('user_media_details', [
            'id' => $media->event_id, // Assuming event_id corresponds to userId
            'activeTab' => $type
        ])->with('success', ucfirst($type) . ' status updated successfully');
    }



    public function update_event_status($id, $status)
    {
        // Validate the incoming status
        if (!in_array($status, ['Completed', 'Upcoming', 'Ongoing'])) {
            return response()->json(['message' => 'Invalid status'], 400);
        }

        // Find the event by ID and update its status
        $event = Event::findOrFail($id);
        $event->event_status = $status;
        $event->save();

        return response()->json(['message' => 'Status updated successfully'], 200);
    }

}
