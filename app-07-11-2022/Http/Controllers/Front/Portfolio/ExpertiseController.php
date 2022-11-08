<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\ExpertiseContract;
use Illuminate\Http\Request;
use App\Models\Employment;
use App\Http\Controllers\BaseController;
use App\Models\Speciality;
use App\Models\UserSpeciality;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class ExpertiseController extends BaseController
{
    /**
     * @var ExpertiseContract
     */
    protected $ExpertiseRepository;


    /**
     * ExpertiseController constructor.
     * @param ExpertiseContract $ExpertiseRepository
     */
    public function __construct(ExpertiseContract $ExpertiseRepository)
    {
        $this->ExpertiseRepository = $ExpertiseRepository;
    }
    public function index(Request $request)
    {
        $this->setPageTitle('Expertise', 'Expertise');
        $data = (object)[];
        $user_id = auth()->guard('web')->user()->id;
        $data->specialities = UserSpeciality::where('user_id', $user_id)->with('specialityDetails')->get();
       // $category=ArticleCategory::orderby('title')->get();
        return view('front.portfolio.expertise.index',compact('data'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Expertise', 'Create Expertise');
        $expertise=Speciality::orderby('name')->get();
        return view('front.portfolio.expertise.create',compact('expertise'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'speciality_id' => 'required',
            'description' => 'required|string|min:1',
        ]);
        $params = $request->except('_token');

        $expertise = $this->ExpertiseRepository->createExpertise($params);

        if (!$expertise) {
            return $this->responseRedirectBack('Error occurred while creating Speciality.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'Speciality has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        /*
        $expertise = $this->ExpertiseRepository->findExpertiseById($id);
        $expertise=Speciality::orderby('name')->get();
        $this->setPageTitle('Expertise', 'Edit Expertise : ' . $expertise->occupation);
        return view('front.portfolio.expertise.edit', compact('expertise','speciality'));
        */

        $expertise = $this->ExpertiseRepository->findExpertiseById($id);
        $speciality=Speciality::orderby('name')->get();
        $this->setPageTitle('Expertise', 'Edit Expertise : ');
        return view('front.portfolio.expertise.edit', compact('expertise','speciality'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'speciality_id' => 'required',
            'description' => 'required|string|min:1',
        ]);
        $params = $request->except('_token');
        $expertise = $this->ExpertiseRepository->updateExpertise($params);

        if (!$expertise) {
            return $this->responseRedirectBack('Error occurred while updating Speciality.', 'error', true, true);
        }
        // dd($expertise);
        // return $this->responseRedirectBack('Speciality has been updated successfully', 'success', false, false);
        return redirect()->back()->with('success', 'Speciality has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $expertise = $this->ExpertiseRepository->deleteExpertise($id);

        if (!$expertise) {
            return $this->responseRedirectBack('Error occurred while deleting Speciality.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'Speciality has been deleted successfully', 'success', false, false);
    }
}
