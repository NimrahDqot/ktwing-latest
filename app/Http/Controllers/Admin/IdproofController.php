<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Volunteer;
use App\Models\Role;
use App\Models\Village;
use App\Models\Visitor;
use App\Models\User;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;
use Hash;
use App\Mail\VolunteerNotificationMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
class IdproofController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }



    // public function index(Request $request) {
    //     $teams = Volunteer::query();
    //     $users = User::query();
    //     if (isset($request->filter)) {
    //         if($request->filter == 'participant'){
    //             $users = User::where('id', $request->participant_id);
    //         }
    //         if($request->filter == 'team'){
    //             $users = User::where('id', $request->team_id);
    //         }
    //     }
    //     $teams = $teams->get();
    //     $users = $users->get();
    //     return view('admin.id_card.view', compact('teams','users'));
    // }

    public function index(Request $request) {
        // Get all teams
        $teams = Volunteer::all();

        // Initialize the user query
        $users = User::all();
        $selectedTeam = null;
        $selectedParticipant = null;

        // Check if the filter is set
        if ($request->has('filter')) {
            if ($request->filter == 'participant') {
                // Filter users based on the selected participant
                $selectedParticipant = User::find($request->participant_id);
            } elseif ($request->filter == 'team') {
                // Filter users based on the selected team
                $selectedTeam = Volunteer::find($request->team_id); // Assuming you want to get the team details

            }
        }


        return view('admin.id_card.view', compact('teams','users', 'selectedTeam', 'selectedParticipant'));
    }

    // public function download_pdf($id, $filter){
    //       // Check if the filter is set
    //       if ($filter) {
    //         if ($filter == 'participant') {
    //             // Filter users based on the selected participant
    //             $data = User::find($id);
    //         } elseif ($filter == 'team') {
    //             // Filter users based on the selected team
    //             $data = Volunteer::find($id); // Assuming you want to get the team details

    //         }
    //     }
    //     $volunteer = $data;
    //     $pdf = Pdf::loadView('admin.id_card.id_card', compact('volunteer'));
    //     $filename = 'volunteer_id_card_' . $volunteer->id . '.pdf';
    //     return $pdf->download($filename);
    //     // dd($data);
    // }

    public function download_pdf($id, $filter) {

// Use a more efficient way to retrieve data
        $data = null;

        if ($filter === 'participant') {
            $data = User::find($id);
            $type = 'user';
        } elseif ($filter === 'team') {
            $type = 'team';
            $data = Volunteer::find($id);
        }

        // Check if data is found
        if (!$data) {
            return redirect()->back()->withErrors('Data not found.');
        }
        $volunteer = $data;
        // Construct the image URL manually
        $imagePath = $volunteer->image;

        // Extract only the image name (e.g., '35ce80e0112560d7575c66d0af7407a9.jpg')
        $imageUrl = basename($imagePath); // This will give you just the file name
        $imageType = pathinfo($imageUrl, PATHINFO_EXTENSION) === 'jpg' ? 'jpeg' : 'png'; // Determine the image type
        $options = new Options();
        $options->set('defaultFont', 'Courier'); // Set default font
        $options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
        $dompdf = new Dompdf($options);

        $html = view('admin.id_card.id_card', compact('volunteer', 'imageUrl', 'imageType', 'type'))->render(); // Your Blade view
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Stream the PDF as a downloadable file
        return $dompdf->stream('id_card.pdf', ['Attachment' => true]); // true for download
    }

    public function preview_pdf($id, $filter) {
        // Use a more efficient way to retrieve data
        $data = null;

        if ($filter === 'participant') {
            $data = User::find($id);
            $type='user';
        } elseif ($filter === 'team') {
            $type='team';

            $data = Volunteer::find($id);
        }

        // Check if data is found
        if (!$data) {
            return redirect()->back()->withErrors('Data not found.');
        }

        $volunteer = $data;
         // Construct the image URL manually
         $imagePath = $volunteer->image;
         $imagePath = $volunteer->image;

         // Extract only the image name (e.g., '35ce80e0112560d7575c66d0af7407a9.jpg')
         $imageUrl = basename($imagePath); // This will give you just the file name
        //  $imageType = pathinfo($imageUrl, PATHINFO_EXTENSION);
         $imageType = pathinfo($imageUrl, PATHINFO_EXTENSION) === 'jpg' ? 'jpeg' : 'png';    // Construct the image URL


        $options = new Options();
        $options->set('defaultFont', 'Courier'); // Set default font
        $options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
        $dompdf = new Dompdf($options);

        $html = view('admin.id_card.id_card', compact('volunteer','imageUrl','imageType','type'))->render(); // Your Blade view
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    return $dompdf->stream('id_card.pdf', ['Attachment' => false]); // false for inline display
    // $dompdf->stream('id_card.pdf');
    }




    public function create() {
        $roles = Role::active()->orderBy('created_at','desc')->get();
        $villages = Village::active()->orderBy('created_at','desc')->with('SubDistrictVillage')->get();
        $team_categories = TeamCategory::orderBy('created_at', 'desc')->get();
        return view('admin.id_card.create', compact('roles','villages','team_categories'));
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
            'team_category_id' => 'required|numeric',
            'phone' => 'required|digits:10|unique:volunteers,phone',
            "father_name" => 'nullable|String',
            "address" => 'nullable|String',
            "designation" => 'nullable|String',
            'experience' => 'required',
            'blood_group' => 'nullable|max:10',
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
        // if (is_array($request->social_icon) && is_array($request->social_url)) {
        //     foreach ($request->social_icon as $index => $url) {
        //         // Combine FAQ question and answer into an array
        //         $metaData['social_link'][] = [
        //             'social_icon' => $url,
        //             'social_url' => $request->social_url[$index] ?? '' // Default to empty string if no corresponding answer
        //         ];
        //     }
        // }
        if (is_array($request->social_icon) && is_array($request->social_url)) {
            foreach ($request->social_icon as $index => $icon) {
                $url = $request->social_url[$index] ?? '';
                // Only add the social link if both icon and URL are provided
                if (!empty($icon) && !empty($request->social_url[$index])) {
                    $metaData['social_link'][] = [
                        'social_icon' => $icon,
                        'social_url' => $url,
                    ];
                }
            }
        }

        $data['village_id'] = implode(',', $request->village_id);
        $data['social_link'] = isset($metaData) ? json_encode($metaData) : null;
        // dd($data);
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
        $villages = Village::active()->orderBy('created_at','desc')->with('SubDistrictVillage')->get();
        $roles = Role::orderBy('created_at','desc')->get();
        $team_categories = TeamCategory::orderBy('created_at', 'desc')->get();
        $social_links  = json_decode($volunteer->social_link);
        return view('admin.id_card.edit', compact('volunteer','roles','villages','team_categories','social_links'));
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
            'blood_group' => 'nullable|max:10',

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
        // if (is_array($request->social_icon) && is_array($request->social_url)) {
        //     foreach ($request->social_icon as $index => $url) {
        //         // Combine FAQ question and answer into an array
        //         $metaData['social_link'][] = [
        //             'social_icon' => $url,
        //             'social_url' => $request->social_url[$index] ?? '' // Default to empty string if no corresponding answer
        //         ];
        //     }
        // }
        // dd($request->all());
        if (is_array($request->social_icon) && is_array($request->social_url)) {
            foreach ($request->social_icon as $index => $icon) {
                $url = $request->social_url[$index] ?? '';
                // Only add the social link if both icon and URL are provided
                if (!empty($icon) && !empty($request->social_url[$index])) {
                    $metaData['social_link'][] = [
                        'social_icon' => $icon,
                        'social_url' => $url,
                    ];
                }
            }
        }
        if($request->filled('password')) {
            $data['password'] = Hash::make($request->password); // Hash the password
        } else {
            unset($data['password']); // Do not update password if it's not provided
        }
        $data['social_link'] = isset($metaData) ? json_encode($metaData) : null;
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

    // public function volunteer_id_card_download($id){
    //     // $volunteer = Volunteer::findOrFail($id);
    //     // return view('admin.id_card.id_card',compact('volunteer'));
    //     $volunteer = Volunteer::findOrFail($id);

    //     // Load the view and pass the volunteer data to it
    //     $pdf = Pdf::loadView('admin.id_card.id_card', compact('volunteer'));

    //     // Set the download filename
    //     $filename = 'volunteer_id_card_' . $volunteer->id . '.pdf';

    //     // Return the generated PDF as a download
    //     return $pdf->download($filename);
    // }

    // public function volunteer_id_card_download($id)
    // {
    //     // Retrieve the volunteer data
    //     $volunteer = Volunteer::findOrFail($id);

    //     // Load the view and pass the volunteer data to it
    //     $pdf = Pdf::loadView('admin.id_card.id_card', compact('volunteer'));

    //     // Set the filename for display purposes
    //     $filename = 'volunteer_id_card_' . $volunteer->id . '.pdf';

    //     // Stream the generated PDF for in-browser viewing
    //     return $pdf->stream($filename);
    // }

    public function volunteer_id_card_download($id)
    {
        // Extend the execution time to 300 seconds (5 minutes) or any preferred duration
        set_time_limit(300);

        $volunteer = Volunteer::where('id', $id)
        ->select('image', 'id', 'name', 'designation', 'father_name', 'phone', 'email', 'address')
        ->firstOrFail();
        $pdf = Pdf::loadView('admin.id_card.id_card', compact('volunteer'));
        $filename = 'volunteer_id_card_' . $volunteer->id . '.pdf';

        return $pdf->stream($filename);
    }
    public function clearAllCaches()
    {
        try {
            // Clear application cache
            Artisan::call('cache:clear');
            echo "Application cache cleared.<br>";

            // Clear route cache
            Artisan::call('route:clear');
            echo "Route cache cleared.<br>";

            // Clear view cache
            Artisan::call('view:clear');
            echo "View cache cleared.<br>";

            // Clear config cache
            Artisan::call('config:clear');
            echo "Config cache cleared.<br>";

            // Optional: Re-optimize the application by caching routes and config
            Artisan::call('config:cache');
            echo "Config cached.<br>";

            Artisan::call('route:cache');
            echo "Route cached.<br>";

            Artisan::call('view:cache');
            echo "View cached.<br>";

            return "All caches cleared and optimized successfully!";
        } catch (\Exception $e) {
            dd($e);
            return "Error clearing caches: " . $e->getMessage();
        }
    }

}
