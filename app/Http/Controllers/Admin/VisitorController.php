<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class VisitorController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index(Request $request) {
        $query = User::query();
        $volunteers = Volunteer::orderBy('id','desc')->select('name','id')->get();
        if (isset($request->volunteer)) {
            $query->where('volunteer_id', $request->volunteer);
        }
        if (isset($request->status)) {
            $query->where('status', $request->status);
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'DESC');
        $per_page = $request->input('per_page', 5); // Default to 5 if not specified
        $query->orderBy($sortBy, $sortDirection);
           if ($per_page === 'all') {
            // Fetch all records if 'all' is selected
            $visitors = $query->paginate($query->count());
        } else {
            // Paginate results otherwise
            $visitors = $query->paginate($per_page);
        }
        return view('admin.visitor.view', compact('visitors','volunteers'));
    }




    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $faq = User::findOrFail($id);
        $faq->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }

    public function change_status($id) {
        $event = User::find($id);
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
}
