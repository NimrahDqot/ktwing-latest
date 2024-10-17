<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;
use Hash;

class DistrictController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index() {
        $districts = District::orderBy('created_at')->paginate(10);

        return view('admin.district.view', compact('districts'));
    }

    public function create() {
        return view('admin.district.create');
    }

    public function store(Request $request) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $district = new District();
        $data = $request->only($district->getFillable());

        $request->validate([
            'name'=> 'required|unique:districts,name|string',
            'code'=> 'required|unique:districts,code|string',

        ]);

        $district->fill($data)->save();
        return redirect()->route('admin_district_view')->with('success', SUCCESS_ACTION);
    }

    public function edit($id) {
        $district = District::findOrFail($id);

        return view('admin.district.edit', compact('district'));
    }

    public function update(Request $request, $id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $district = District::findOrFail($id);
        $data = $request->only($district->getFillable());

        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('districts')->ignore($id),
            ],
            'code' => [
                'required',
                'string',
                Rule::unique('districts')->ignore($id),
            ]
        ]);
        $district->fill($data)->save();
        return redirect()->route('admin_district_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $district = District::findOrFail($id);
        $district->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }


        public function change_status($id) {
            $customer = District::find($id);
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
