<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\ProfileContract;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use App\Models\UserSocialMedia;
use App\Models\UserLanguage;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Session as FacadesSession;

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
        $data->user = User::where('slug', $request->slug)->first();
        $languages = UserLanguage::where('user_id', $data->user->id)->with('languageDetails')->get();
       // dd($languages);
        $language = Language::orderby('name')->get();
        $media = SocialMedia::all();
        $country = DB::table('countries')->orderby('country_name')->get();
        return view('front.portfolio.profile.create',compact('data','media','country','language','languages'));
    }



    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
        ]);
        $params = $request->except('_token');
        $profile = $this->ProfileRepository->updateProfile($params);

        if (!$profile) {
            return $this->responseRedirectBack('Error occurred while updating Basic Details.', 'error', true, true);
        }
        return $this->responseRedirectBack('Basic Details has been updated successfully', 'success', false, false);
    }


}
