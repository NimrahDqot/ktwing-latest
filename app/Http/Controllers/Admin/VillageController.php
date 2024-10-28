<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\SubDistrict;
use App\Models\SubDistrictVillage;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;
use Hash;

class VillageController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index() {
        $village = Village::orderBy('created_at')->with('events','SubDistrict','District','SubDistrictVillage','StateInfo')->paginate(10);

        return view('admin.village.view', compact('village'));
    }

    public function create() {
        $roles = Role::orderBy('created_at','desc')->get();
        $states = State::orderBy('created_at','desc')->where('country_id',101)->select('id','name')->get();
        $cities = City::orderBy('created_at','desc')->get();
        return view('admin.village.create', compact('roles','states','cities'));
    }

    public function store(Request $request) {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $village = new Village();
        $data = $request->only($village->getFillable());
    
        $request->validate([
            'state_id'=> 'required|numeric',
            'district_id'=> 'required|numeric',
            'sub_district_id'=> 'required|numeric',
            'sub_district_village_id'=> 'required|numeric',
            'population'=> 'nullable',
            'language'=> 'nullable',
            'contact'=> 'nullable|digits:10'
        ]);

        $village->fill($data)->save();
        return redirect()->route('admin_village_view')->with('success', SUCCESS_ACTION);
    }

    // public function edit($id) {
    //     $village = Village::findOrFail($id);
    //     $states = State::orderBy('created_at','desc')->where('country_id',101)->select('id','name')->get();
    //     $districts = District::orderBy('created_at','desc')->select('id','name')->get();
    //     $subDistricts = SubDistrict::orderBy('created_at','desc')->select('id','name')->get();
    //     $subDistrictVillage = SubDistrictVillage::orderBy('created_at','desc')->select('id','name')->get();
    //     $roles = Role::orderBy('created_at','desc')->get();
    //     return view('admin.village.edit', compact('village','roles','states','districts','subDistricts','subDistrictVillage'));
    // }
    public function edit($id) {
        $village = Village::findOrFail($id);
        
        // Fetch states
        $states = State::orderBy('created_at','desc')->where('country_id', 101)->select('id', 'name')->get();
        
        // Fetch districts based on the village's state
        $districts = District::where('state_id', $village->state_id)->orderBy('created_at', 'desc')->select('id', 'name')->get();
        
        // Fetch sub-districts based on the village's district
        $subDistricts = SubDistrict::where('district_id', $village->district_id)->orderBy('created_at', 'desc')->select('id', 'name')->get();
        
        // Fetch villages based on the village's sub-district
        $subDistrictVillage = SubDistrictVillage::where('sub_district_id', $village->sub_district_id)->orderBy('created_at', 'desc')->select('id', 'name')->get();
        
        // Fetch roles if needed
        $roles = Role::orderBy('created_at', 'desc')->get();
    
        return view('admin.village.edit', compact('village', 'roles', 'states', 'districts', 'subDistricts', 'subDistrictVillage'));
    }
    
    public function update(Request $request, $id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
// dd($request->all());
        $village = Village::findOrFail($id);
        $data = $request->only($village->getFillable());

        $request->validate([
            'state_id'=> 'required|numeric',
            'district_id'=> 'required|numeric',
            'sub_district_id'=> 'required|numeric',
            'sub_district_village_id'=> 'required|numeric',
            'population'=> 'nullable',
            'language'=> 'nullable',
            'contact' => [
                'nullable',
                'digits:10',
                Rule::unique('villages')->ignore($id),
            ],
        ]);
        $village->fill($data)->save();
        return redirect()->route('admin_village_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $village = Village::findOrFail($id);
        $village->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }
    public function change_status($id) {
        $customer = Village::find($id);
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

    public function getCities($state_id) {
        $cities = District::select('id','name','state_id')->where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    public function getSubDistrict($district) {
        $sub_district = SubDistrict::select('id','name','district_id')->where('district_id', $district)->get();
        return response()->json($sub_district);
    }
    
    public function getSubDistrictVillage($sub_district) {
        $village = SubDistrictVillage::select('id','name','sub_district_id')->where('sub_district_id', $sub_district)->get();
        return response()->json($village);
    }
    
}
