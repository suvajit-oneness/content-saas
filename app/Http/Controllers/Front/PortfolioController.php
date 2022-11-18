<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSocialMedia;
use App\Models\UserLanguage;
use App\Models\SocialMedia;
use App\Models\UserSpeciality;
use App\Models\Portfolio;
use App\Models\Employment;
use App\Models\Client;
use App\Models\Education;
use App\Models\Testimonial;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use App\Contracts\UserContract;
use App\Feedback;
use App\Http\Controllers\BaseController;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PortfolioController extends BaseController
{
    protected $UserRepository;

    /**
     * UserManagementController constructor.
     * @param UserRepository $UserRepository
     */

    public function __construct(UserContract $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function index(Request $request, $slug)
    {
        $data = (object)[];
        $data->user = User::where('slug', $slug)->first();
        $data->socialMedias = UserSocialMedia::where('user_id', $data->user->id)->with('socialMediaDetails')->get();
        $data->languages = UserLanguage::where('user_id', $data->user->id)->with('languageDetails')->get();
        $data->specialities = UserSpeciality::where('user_id', $data->user->id)->with('specialityDetails')->get();
        $data->portfolios = Portfolio::where('user_id', $data->user->id)->get();
        $data->employments = Employment::where('user_id', $data->user->id)->get();
        $data->clients = Client::where('user_id', $data->user->id)->get();
        $data->educations = Education::where('user_id', $data->user->id)->orderBy('position')->get();
        $data->testimonials = Testimonial::where('user_id', $data->user->id)->get();
        $data->certificates = Certificate::where('user_id', $data->user->id)->get();
        $data->feedback = Feedback::where('user_id', $data->user->id)->get();

        return view('front.portfolio.index', compact('data'));
    }

    public function edit(Request $request)
    {
        // dd('here');
        $data = (object)[];

        // $slug = auth()->guard('web')->user()->slug;
        // $data->user = User::where('slug', $slug)->first();
        $user_id = auth()->guard('web')->user()->id;

        $data->socialMedias = UserSocialMedia::where('user_id', $user_id)->with('socialMediaDetails')->get();
        $data->languages = UserLanguage::where('user_id', $user_id)->with('languageDetails')->get();
        $data->specialities = UserSpeciality::where('user_id', $user_id)->with('specialityDetails')->get();
        $data->portfolios = Portfolio::where('user_id', $user_id)->get();
        $data->employments = Employment::where('user_id', $user_id)->get();
        $data->clients = Client::where('user_id', $user_id)->get();
        $data->educations = Education::where('user_id', $user_id)->orderBy('position')->get();
        $data->testimonials = Testimonial::where('user_id', $user_id)->get();
        $data->certificates = Certificate::where('user_id', $user_id)->get();
        $data->feedback = Feedback::where('user_id', $user_id)->get();
        return view('front.portfolio.edit', compact(('data')));
    }

    public function basicprofile(Request $request, $slug)
    {
        $data = (object)[];
        $data->user = User::where('slug', $slug)->first();
        $languages = UserLanguage::where('user_id', $data->user->id)->with('languageDetails')->get();
        // dd($languages);
        $language = Language::orderby('name')->get();
        $media = SocialMedia::all();
        $country = DB::table('countries')->orderby('country_name')->get();
        return view('front.portfolio.basic-details', compact('data', 'media', 'country', 'language', 'languages'));
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'first_name' => 'required|string|min:1',
        ]);
        $params = $request->except('_token');

        $targetprofile = $this->UserRepository->userprofile($params);

        if (!$targetprofile) {
            return back()->with('Error occurred while updating Profile.', 'error', true, true);
        }
        return back()->with('Profile has been updated successfully', 'success', false, false);
    }

    public function showMyCourses()
    {
        $course = Order::where('user_id', auth()->guard('web')->user()->id)->with('orderProducts')->get();
        //dd($course);
        return view('front.profile.my-course', compact('course'));
    }

    public function changePassword()
    {
        return view('front.portfolio.profile.changePassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        $check_old_pass = Auth::attempt(['email' => auth()->guard('web')->user()->email, 'password' => $request->old_password]);

        if (!$check_old_pass) {
            return redirect()->back()->with('success', 'Old Password is not correct', 'error', true, true);
        }

        $new_pass = Hash::make($request->new_password);

        User::where('email', auth()->guard('web')->user()->email)->update(['password' => $new_pass]);

        Auth::guard('web')->logout();
        return redirect()->back();
    }

    public function cancelSubscription(Request $request)
    {
        $update = User::where('id',Auth::guard('web')->user()->id)->update(['subscription_id'=>null]);
        return redirect()->back()->with('success', 'Subscription cancelled!', 'error', true, true);
    }
}
