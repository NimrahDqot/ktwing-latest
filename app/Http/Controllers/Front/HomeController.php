<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Attendees;
use DB;
use App\Models\User;
use App\Models\Banner;
use App\Models\Enquiry;
use App\Models\Event;
use App\Models\PageAboutItem;
use App\Models\SocialYouTubeItem;
use App\Models\Testimonial;
use App\Models\SocialMediaItem;

class HomeController extends Controller
{
    public function index()
    {

        $attendees = Attendees::orderBy('created_at','desc')->get();
        $testimonials = Testimonial::select('name', 'email', 'phone', 'description', 'image','designation')->get();
        $rewards = Banner::where('type','rewards')->select('image')->get();
        $about = PageAboutItem::select('detail')->get();
        $social_items = SocialMediaItem::get();
        $activities = SocialYouTubeItem::get();

        $query = Event::query();
        $events=array();
        if (isset($request->status)) {
            // echo $request->status;
            $query->where('status', $request->status);
        }
        if (isset($request->event_status)) {
            // echo $request->status;
            $query->where('event_status', $request->event_status);
        }
            $events = $query->orderby('id','desc')->paginate(10);

        return view('front.home', compact('events', 'attendees','rewards','testimonials','about','social_items','activities'));
        }


    }
