<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;
use Hash;

class StateController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index() {
        $state = State::orderBy('created_at')->paginate(10);

        return view('admin.state.view', compact('state'));
    }

    public function create() {
        return view('admin.state.create');
    }

    public function store(Request $request) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $state = new State();
        $data = $request->only($state->getFillable());

        $request->validate([
            'name'=> 'required|unique:states,name|string',
            'code'=> 'required|unique:states,code|string',

        ]);

        $state->fill($data)->save();
        return redirect()->route('admin_state_view')->with('success', SUCCESS_ACTION);
    }

    public function edit($id) {
        $state = State::findOrFail($id);

        return view('admin.state.edit', compact('state'));
    }

    public function update(Request $request, $id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $state = State::findOrFail($id);
        $data = $request->only($state->getFillable());

        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('states')->ignore($id),
            ],
            'code' => [
                'required',
                'string',
                Rule::unique('states')->ignore($id),
            ]
        ]);
        $state->fill($data)->save();
        return redirect()->route('admin_state_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $state = State::findOrFail($id);
        $state->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }


        public function change_status($id) {
            $customer = State::find($id);
            if($customer->status == '1') {
                if(env('PROJECT_MODE') == 0) {
                    $message=env('PROJECT_NOTIFICATION');
                } else {
                    $customer->status = '0';
                    $message=SUCCESS_ACTION;
                    $customer->save();
                }
            } else {
                if(env('PROJECT_MODE') == 0) {
                    $message=env('PROJECT_NOTIFICATION');
                } else {
                    $customer->status = '1';
                    $message=SUCCESS_ACTION;
                    $customer->save();
                }
            }
            return response()->json($message);
        }

}
