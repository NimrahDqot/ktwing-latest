<?php
namespace App\Http\Controllers\Api;

use App\Models\TermItem;
use App\Models\Testimonial;

use Illuminate\Http\Request;
use DB;
// use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\PrivacyItem;

use Validator;
use Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends BaseController
{


    public function policyOrTerm()
    {
        // Retrieve the first PrivacyItem
        $privacyItem = PrivacyItem::select('name', 'detail')->first();

        // Retrieve the first TermItem
        $termItem = TermItem::select('name', 'detail')->first();

        // Prepare the content to be passed to the view
        $content = view('api.privacy_or_term', [
            'privacyItem' => $privacyItem,
            'termItem' => $termItem,
        ])->render();

        return response($content);
    }

    public function privacy_policy()
    {
        // Retrieve the first PrivacyItem
        $privacyItem = PrivacyItem::select('name', 'detail')->first();

        // Retrieve the first TermItem
        $termItem = TermItem::select('name', 'detail')->first();

        // Prepare the content to be passed to the view
        $content = view('api.privacy_policy', [
            'privacyItem' => $privacyItem,
            'termItem' => $termItem,
        ])->render();

        return response($content);
    }

    public function about_us()
    {
        // Retrieve the first PrivacyItem
        $privacyItem = PrivacyItem::select('name', 'detail')->first();

        // Retrieve the first TermItem
        $termItem = TermItem::select('name', 'detail')->first();

        // Prepare the content to be passed to the view
        $content = view('api.about_us', [
            'privacyItem' => $privacyItem,
            'termItem' => $termItem,
        ])->render();

        return response($content);
    }
    public function term_condition()
      {
          // Retrieve the first PrivacyItem
          $privacyItem = PrivacyItem::select('name', 'detail')->first();

          // Retrieve the first TermItem
          $termItem = TermItem::select('name', 'detail')->first();

          // Prepare the content to be passed to the view
          $content = view('api.term_condition', [
              'privacyItem' => $privacyItem,
              'termItem' => $termItem,
          ])->render();

          return response($content);
      }

      public function delete_account(){
          return view('admin.delete_account');
    }

    public function testimonial(){
        $testimonials = Testimonial::select('id', 'name', 'image', 'email', 'phone')->get();
        return $this->sendResponse($testimonials, 'Testimonial list retrieved successfully.');
  }


}
