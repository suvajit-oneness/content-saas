<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\WorkExperienceContract;
use Illuminate\Http\Request;
use App\Models\Employment;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class ExperienceController extends BaseController
{
  /**
     * @var WorkExperienceRepository
     */
    protected $WorkExperienceRepository;


    /**
     * ExperienceController constructor.
     * @param WorkExperienceContract $WorkExperienceRepository
     */
    public function __construct(WorkExperienceContract $WorkExperienceRepository)
    {
        $this->WorkExperienceRepository = $WorkExperienceRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Experience', 'Create experience');
        return view('front.portfolio.experience.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'occupation' => 'required|string|min:1',
            'company_title' => 'required|string|min:1',
        ]);
        $params = $request->except('_token');

        $experience = $this->WorkExperienceRepository->createExperience($params);

        if (!$experience) {
            return $this->responseRedirectBack('Error occurred while creating experience.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'work experience has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $experience = $this->WorkExperienceRepository->findExperienceById($id);

        $this->setPageTitle('work experience', 'Edit work experience : ' . $experience->occupation);
        return view('front.portfolio.experience.edit', compact('experience'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'occupation' => 'required|string|min:1',
            'company_title' => 'required|string|min:1',


        ]);
        $params = $request->except('_token');
        $experience = $this->WorkExperienceRepository->updateExperience($params);

        if (!$experience) {
            return $this->responseRedirectBack('Error occurred while updating work experience.', 'error', true, true);
        }
        return $this->responseRedirectBack('work experience has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $experience = $this->WorkExperienceRepository->deleteExperience($id);

        if (!$experience) {
            return $this->responseRedirectBack('Error occurred while deleting Experience.', 'error', true, true);
        }
        return redirect()->back()->with('success','Experience has been deleted successfully', 'success', false, false);
    }

}
