<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeamCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class TeamCategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index() {
        $teams = TeamCategory::orderBy('created_at', 'desc')->get();

        return view('admin.team_category.view', compact('teams'));
    }


    public function create() {
        return view('admin.team_category.create');
    }

    public function store(Request $request) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $team = new TeamCategory();
        $data = $request->only($team->getFillable());

        $request->validate([
            'name' => [
                'required',
                Rule::unique('team_categories')->whereNull('deleted_at'), // Ignore soft deleted records
            ],
            'designation' => [
                'required',
                Rule::unique('team_categories')->whereNull('deleted_at'), // Ignore soft deleted records
            ],
        ]);

        $team->fill($data)->save();
        return redirect()->route('admin_team_category_view')->with('success', SUCCESS_ACTION);
    }

    public function edit($id) {
        $team_category = TeamCategory::findOrFail($id);
        return view('admin.team_category.edit', compact('team_category'));
    }

    public function update(Request $request, $id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $role = TeamCategory::findOrFail($id);
        $data = $request->only($role->getFillable());

            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('team_categories')->whereNull('deleted_at')->ignore($id), // Ignore soft deleted records
                ],
                'designation' => [
                    'required',
                    Rule::unique('team_categories')->whereNull('deleted_at')->ignore($id), // Ignore soft deleted records
                ],
            ]);

        $role->fill($data)->save();
        return redirect()->route('admin_team_category_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $role = TeamCategory::findOrFail($id);
        $role->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }

    public function change_status($id){
        $role = TeamCategory::find($id);
        if($role->status == '1') {
            if(env('PROJECT_MODE') == 0) {
                $message=env('PROJECT_NOTIFICATION');
            } else {
                $role->status = '0';
                $message=SUCCESS_ACTION;
                $role->save();
            }
        } else {
            if(env('PROJECT_MODE') == 0) {
                $message=env('PROJECT_NOTIFICATION');
            } else {
                $role->status = '1';
                $message=SUCCESS_ACTION;
                $role->save();
            }
        }
        return response()->json($message);
    }
}
