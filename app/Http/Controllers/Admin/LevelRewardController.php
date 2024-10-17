<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\LevelReward;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class LevelRewardController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin:admin');
    }

    public function index() {
        $level_rewards = LevelReward::paginate(10);
        return view('admin.level_rewards.view', compact('level_rewards'));
    }
    public function create() {
        return view('admin.level_rewards.create');
    }
    public function store(Request $request) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $level_reward = new LevelReward();
        $data = $request->only($level_reward->getFillable());

        $request->validate([
            'level_name'=>  'required|string|unique:level_rewards,level_name',
            'min_points'=> 'required|unique:level_rewards,min_points',
            'max_points'=> 'required|unique:level_rewards,max_points',
            'awards_amount'=> 'required|unique:level_rewards,awards_amount',
            'awads_gifts'=> 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Optional image validation
            // 'status'=> 'required',
            'min_users_for_level' => 'numeric|unique:level_rewards,min_users_for_level'
        ]);
        if($request->hasFile('image')){
            $rand_value = md5(mt_rand(11111111,99999999));
            $ext = $request->file('image')->extension();
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/level_rewards/'), $final_name);
            unset($data['image']);
            $data['image'] = $final_name;
        }

        $level_reward->fill($data)->save();
        return redirect()->route('admin_level_reward_view')->with('success', SUCCESS_ACTION);
    }

    public function edit($id) {
        $level_reward = LevelReward::findOrFail($id);
        return view('admin.level_rewards.edit', compact('level_reward'));
    }

    public function update(Request $request, $id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $banner = LevelReward::findOrFail($id);
        $data = $request->only($banner->getFillable());
        $request->validate([
            'level_name' => [
                'required',
                'string',
                Rule::unique('level_rewards')->ignore($id),
            ],
            'min_points' => [
                'required',
                Rule::unique('level_rewards')->ignore($id),
            ],
            'max_points' => [
                'required',
                Rule::unique('level_rewards')->ignore($id),
            ],
            'awards_amount' => [
                'required',
                Rule::unique('level_rewards')->ignore($id),
            ],
            'min_users_for_level' => [
                'required',
                Rule::unique('level_rewards')->ignore($id),
            ],

        ]);
        if($request->image){
            @unlink(public_path('uploads/level_rewards/'.$request->image));
            $ext = $request->file('image')->extension();
            $rand_value = md5(mt_rand(11111111,99999999));
            $final_name = $rand_value.'.'.$ext;
            $request->file('image')->move(public_path('uploads/level_rewards/'), $final_name);

            unset($data['image']);
            $data['image'] = $final_name;
        }
        $banner->fill($data)->save();
        return redirect()->route('admin_level_reward_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $level_reward = LevelReward::findOrFail($id);
        $level_reward->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }


public function change_status($id) {
    $event = LevelReward::find($id);
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
