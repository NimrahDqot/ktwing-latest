<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\VidhanaSabha;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;
use Hash;

class VidhanaSabhaController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index() {
        $vidhanasabhas = VidhanaSabha::orderBy('created_at')->paginate(10);

        return view('admin.vidhanasabha.view', compact('vidhanasabhas'));
    }

    public function create() {
        return view('admin.vidhanasabha.create');
    }

    public function store(Request $request) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $vidhanasabha = new VidhanaSabha();
        $data = $request->only($vidhanasabha->getFillable());

        $request->validate([
            'name'=> 'required|unique:vidhana_sabhas,name|string|max:255',
            'code'=> 'required|unique:vidhana_sabhas,code|string|max:255',

        ]);

        $vidhanasabha->fill($data)->save();
        return redirect()->route('admin_vidhanasabha_view')->with('success', SUCCESS_ACTION);
    }

    public function edit($id) {
        $vidhanasabha = VidhanaSabha::findOrFail($id);

        return view('admin.vidhanasabha.edit', compact('vidhanasabha'));
    }

    public function update(Request $request, $id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $vidhanasabha = VidhanaSabha::findOrFail($id);
        $data = $request->only($vidhanasabha->getFillable());

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vidhana_sabhas')->ignore($id),
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vidhana_sabhas')->ignore($id),
            ]
        ]);
        $vidhanasabha->fill($data)->save();
        return redirect()->route('admin_vidhanasabha_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $vidhanasabha = VidhanaSabha::findOrFail($id);
        $vidhanasabha->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }


        public function change_status($id) {
            $customer = VidhanaSabha::find($id);
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
