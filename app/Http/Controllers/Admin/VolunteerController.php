<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Volunteer;
use App\Models\Role;
use App\Models\Village;
use App\Models\Visitor;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;
use Hash;
use App\Mail\VolunteerNotificationMail;
use Exception;
use Illuminate\Support\Facades\Mail;
class VolunteerController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }



    public function index(Request $request) {
        $query = Volunteer::query();

        if (isset($request->name)) {
            $query->where('name', 'like','%'.$request->name.'%');
        }
        if (isset($request->status)) {
            $query->where('status', $request->status);
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'DESC');
        $per_page = $request->input('per_page', 10); // Default to 5 if not specified
        $query->orderBy($sortBy, $sortDirection);
           if ($per_page === 'all') {
            // Fetch all records if 'all' is selected
            $volunteer = $query->paginate($query->count());
        } else {
            // Paginate results otherwise
            $volunteer = $query->paginate($per_page);
        }
        return view('admin.volunteer.view', compact('volunteer'));
    }

    public function create() {
        $roles = Role::active()->orderBy('created_at','desc')->get();
        $villages = Village::active()->orderBy('created_at','desc')->get();
        return view('admin.volunteer.create', compact('roles','villages'));
    }

    public function store(Request $request) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $volunteer = new Volunteer();
        $data = $request->only($volunteer->getFillable());
        $role = Role::where('name', 'like', '%volunteer%')->first();
        $data['role_id'] = $role->id;
        $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:10|unique:volunteers,phone',
            'experience' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'password' => 'required|confirmed|min:8',
            // 'role_id' => 'required',
            'village_id' => 'required',
            'email' => [
            'required',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            "unique:volunteers,email",
            ],

        ]);
        $data['password'] = Hash::make($request->password);

        if($request->hasFile('image')){

            $rand_value = md5(mt_rand(11111111,99999999));
            $ext = $request->file('image')->extension();
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/volunteer/'), $final_name);
            unset($data['image']);
            $data['image'] = $final_name;
        }
        $data['village_id'] = implode(',', $request->village_id);
        $volunteer->fill($data)->save();
        if($volunteer){

            // Generate the referral code after saving the volunteer
            $email = isset($request->email) ? strtoupper(substr($request->email, 0, 4)) : 'KTUSER';
            $timestamp = now()->format('Hi') . now()->format('s'); // Get the last 4 digits (HHMM + SS)
            $timestamp = substr($timestamp, -4); // Ensure you have only the last 4 digits
            // Combine to form the referral code
            $data['referal_code'] = $email . $volunteer->id . $timestamp;
            // Update the volunteer with the referral code
            $volunteer->referal_code = $data['referal_code'];
            $volunteer->save();
        }

        return redirect()->route('admin_volunteer_view')->with('success', SUCCESS_ACTION);
    }

    public function edit($id) {
        $volunteer = Volunteer::findOrFail($id);
        $villages = Village::orderBy('created_at','desc')->get();
        $roles = Role::orderBy('created_at','desc')->get();
        return view('admin.volunteer.edit', compact('volunteer','roles','villages'));
    }

    public function update(Request $request, $id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $volunteer = Volunteer::findOrFail($id);
        $data = $request->only($volunteer->getFillable());
        $role = Role::where('name', 'like', '%volunteer%')->first();
        $data['role_id'] = $role->id;
        $request->validate([
            'name' => 'required',
            'experience' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'password' => 'nullable|confirmed|min:8',
            'role_id' => 'required',
            'village_id' => 'required',
            'phone' => [
                'required',
                'digits:10',
                Rule::unique('volunteers')->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                Rule::unique('volunteers')->ignore($volunteer->id), // Ignore the current record's email
            ],
        ]);
        if($request->hasFile('image')){
            @unlink(public_path('uploads/volunteer/'.$volunteer->image)); // Unlink old image
            $ext = $request->file('image')->extension();
            $rand_value = md5(mt_rand(11111111,99999999));
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/volunteer/'), $final_name);

            $data['image'] = $final_name; // Update with new image name
        }
        if($request->filled('password')) {
            $data['password'] = Hash::make($request->password); // Hash the password
        } else {
            unset($data['password']); // Do not update password if it's not provided
        }
        $data['village_id'] = implode(',', $request->village_id);
        $volunteer->fill($data)->save();
        return redirect()->route('admin_volunteer_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $volunteer = Volunteer::findOrFail($id);
        $volunteer->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }

    public function submitRejectionReason(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required|integer',
            'rejection_reason' => 'required|string|max:255',
        ]);

        $model = Volunteer::find($validated['id']);
        if (!$model) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $model->rejection_reason = $validated['rejection_reason'];
        $model->status = '2';
        $model->save();

        return response()->json(['message' => 'Rejection reason submitted successfully.']);
    }

    public function changeStatus(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:0,1,2', // 0 for Pending, 1 for Approved, 2 for Rejected
        ]);


        $model = Volunteer::find($validated['id']);

        $model->status = $validated['status'];
        $model->save();

        return response()->json(['message' => 'Status changed successfully.']);
    }

    public function send_volunteer_notification(Request $request){
        $user_id =  $request->id;
        $type =  $request->type;
        $title =  $request->title;
        $description =  $request->description;

        $village = new Notification();
        $village->user_id =  $user_id;
        $village->type =  $type;
        $village->title =  $title;
        $village->description =  $description;
        // $village->save();
        $user = Volunteer::find($user_id);
        $email = $user->email; // Assuming the user's email is available
        // Send the email
        Mail::to($email)->send(new VolunteerNotificationMail($type, $title, $description));

        return redirect()->route('admin_village_view')->with('success', SUCCESS_ACTION);
    }

    public function refer_user($id) {

        $volunteer_data = Volunteer::where('id',$id)->select('name')->first();
        $volunteer = isset($volunteer_data->name) ? ucwords($volunteer_data->name).' Volunteer\'s All' : " Anonymus Volunteer\'s All";
          $users = User::where('refer_id',$id)->paginate(10);
        return view('admin.event.refer_user', compact('users','volunteer','id'));
    }
    public function user_refer_user($id) {
        $user = User::where('id',$id)->select('name')->first();

        $user_name = ucwords($user->name) ? ucwords($user->name)." User's All" : " Anonymus User's All";
        $user_id = isset($user) ? $user : 0;
        $users = User::where('users_refer_id',$id)->paginate(10);
        return view('admin.event.user_refer_user', compact('users','user','user_name','id'));
    }

    public function refer_visitor($id) {
        $volunteer = Volunteer::where('id',$id)->select('name')->first();
        $volunteer = isset($volunteer->name) ? ucwords($volunteer->name).' Volunteer\'s All' : " Anonymus Volunteer\'s All";
        $visitors = Visitor::where('volunteer_id',$id)->paginate(10);

        return view('admin.event.refer_visitor', compact('visitors','volunteer'));
    }

    public function admin_user_delete($id){
        try{
            $volunteer = User::findOrFail($id);
            $volunteer->delete();
            return Redirect()->back()->with('success', SUCCESS_ACTION);
        }catch(Exception $e){
            return redirect()->back()->with('error', 'User Id Not Found');

        }
    }

    public function user_status(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:0,1,2', // 0 for Pending, 1 for Approved, 2 for Rejected
        ]);


        $model = User::find($validated['id']);

        $model->status = $validated['status'];
        $model->save();

        return response()->json(['message' => 'Status changed successfully.']);
    }

    public function submitRejectionReasonUser(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required|integer',
            'rejection_reason' => 'required|string|max:255',
        ]);

        $model = User::find($validated['id']);
        if (!$model) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $model->rejection_reason = $validated['rejection_reason'];
        $model->status = '2';
        $model->save();

        return response()->json(['message' => 'Rejection reason submitted successfully.']);
    }

    public function user_list(Request $request){
        $users = User::with('Volunteer_info','user_info','level_info')->paginate(10);
        return view('admin.users.user_list',compact('users'));
    }
}

