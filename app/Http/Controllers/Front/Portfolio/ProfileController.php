<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\ProfileContract;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\BaseController;
use App\Models\Currency;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use App\Models\UserSocialMedia;
use App\Models\UserLanguage;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Auth;
class ProfileController extends BaseController
{
    /**
     * @var ProfileContract
     */
    protected $ProfileRepository;


    /**
     * ProfileContract constructor.
     * @param ProfileContract $ProfileRepository
     */
    public function __construct(ProfileContract $ProfileRepository)
    {
        $this->ProfileRepository = $ProfileRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->setPageTitle('Basic Details', 'Create Basic Details');
        $data = (object)[];
        $id=Auth::user()->id;
        $data->user = User::where('id', $id)->first();
        $country = DB::table('countries')->orderby('country_name')->get();

        // language
        $allLanguage = Language::orderby('name')->get();
        $userLanguages = UserLanguage::where('user_id', $data->user->id)->with('languageDetails')->get()->toArray();

        // social media
        $allSocialMedia = SocialMedia::all();
        $userSocialMedia = UserSocialMedia::where('user_id', $data->user->id)->get()->toArray();

        return view('front.portfolio.profile.create',compact('data', 'allSocialMedia', 'country', 'allLanguage', 'userLanguages', 'userSocialMedia'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function editProfile()
    {
        $country = DB::table('countries')->orderby('country_name')->get();
        $charges_limit = DB::table('charges_limit')->get();
        return view('front.profile.profile',compact('country','charges_limit'));
    }

    
    public function update(Request $request)
    {
        // dd($request->all());

        if($request->remove_profile){
            User::where('id',Auth::guard('web')->user()->id)->update(['image' => null]);
            return response()->json(array('message' => 'Profile picture has been successfully removed!'));
        }
        if($request->remove_intro){
            User::where('id',Auth::guard('web')->user()->id)->update(['intro_video' => null]);
            return response()->json(array('message' => 'Intro video has been successfully removed!'));
        }
        if($request->remove_banner){
            User::where('id',Auth::guard('web')->user()->id)->update(['banner_image' => null]);
            return response()->json(array('message' => 'Banner image has been successfully removed!'));
        }

        $request->validate([
           
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'mobile'        => 'required|integer',
            'country'       => 'required|string',
            'occupation'    => 'required|string',
            'short_desc'    => 'nullable|string',
            'intro_video'    => 'nullable|mimes:mp4,mov,ogg | max:20000',
            'language_id'   => 'required|array',
            'quote'         => 'nullable|string',
            'quote_by'      => 'nullable|string',
            'link'          => 'nullable|array',
            'color_scheme'  => 'nullable|string',
            'worked_for'    => 'required|string',
            'categories'    => 'required|string',
            'banner_image'         => 'required',
            'image'         => 'required',
            'charge'       => 'nullable',
            'duration'      => 'nullable',
        ]);

        $params = $request->except('_token');
        $profile = $this->ProfileRepository->updateProfile($params);

        if (!$profile) {
            return $this->responseRedirectBack('Error occurred while updating Basic Details.', 'error', true, true);
        }
        // return $this->responseRedirectBack('Basic Details has been updated successfully', 'success', false, false);
        return redirect()->back()->with('success', 'Basic Details has been updated successfully', 'success', false, false);
    }


}
