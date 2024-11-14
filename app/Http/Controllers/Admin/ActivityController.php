<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SocialYouTubeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    public function index()
    {
        $social_media = SocialYouTubeItem::get();
        return view('admin.admin_activity_view', compact('social_media'));
    }

    public function create()
    {
        return view('admin.admin_activity_create');
    }

    public function store(Request $request)
    {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $social_media = new SocialYouTubeItem();
        $data = $request->only($social_media->getFillable());

        $request->validate([
            'video_url' => 'required',
            'thumbnail_url' => 'required',
            'title' => 'required',
        ]);
        if($request->thumbnail_url){
            $rand_value = md5(mt_rand(11111111,99999999));
            $ext = $request->file('thumbnail_url')->extension();
            $final_name = $rand_value.'.'.$ext;
            $request->file('thumbnail_url')->move(public_path('uploads/you_tube/'), $final_name);
            unset($data['thumbnail_url']);
            $data['thumbnail_url'] = $final_name;
        }

        $social_media->fill($data)->save();
        return redirect()->route('admin_activity_view')->with('success', SUCCESS_ACTION);
    }

    public function edit($id)
    {
        $social_media = SocialYouTubeItem::findOrFail($id);
        return view('admin.admin_activity_edit', compact('social_media'));
    }

    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $social_media = SocialYouTubeItem::findOrFail($id);
        $data = $request->only($social_media->getFillable());

        $request->validate([
            'video_url' => 'required',

            'title' => 'required',
        ]);
        if($request->thumbnail_url){
            @unlink(public_path('uploads/you_tube/'.$request->thumbnail_url));
            $ext = $request->file('thumbnail_url')->extension();
            $rand_value = md5(mt_rand(11111111,99999999));
            $final_name = $rand_value.'.'.$ext;
            $request->file('thumbnail_url')->move(public_path('uploads/you_tube/'), $final_name);

            unset($data['thumbnail_url']);
            $data['thumbnail_url'] = $final_name;
        }
        $social_media->fill($data)->save();
        return redirect()->route('admin_activity_view')->with('success', SUCCESS_ACTION);
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $social_media = SocialYouTubeItem::findOrFail($id);
        $social_media->delete();
        return Redirect()->back()->with('success', SUCCESS_ACTION);
    }
}
