<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\CourseSlideContract;
use Illuminate\Http\Request;
use App\Models\CourseSlide;
use App\Models\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CourseModule;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class CourseSlideController extends BaseController
{
/**
     * @var CourseSlideContract
     */
    protected $CourseSlideRepository;
    /**
     * CourseSlideController constructor.
     * @param CourseSlideContract $CourseSlideRepository
     */
    public function __construct(CourseSlideContract $CourseSlideRepository)
    {
        $this->CourseSlideRepository = $CourseSlideRepository;
    }
    public function index(){
        
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function create()
    {
        $this->setPageTitle('Course Slide', 'Create Course Slide');
        return view('admin.course.slide.create');
    }
    public function store(Request $request)
    {
    	//dd($request->all());
        $this->validate($request, [
           // 'slide_content'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');

        $category = $this->CourseSlideRepository->createSlide($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating Course slide.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'Course slide has been created successfully', 'success', false, false);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'slide_content'      =>  'required',

        ]);
        $params = $request->except('_token');
        $slide = $this->CourseSlideRepository->updateSlide($params);

        if (!$slide) {
            return $this->responseRedirectBack('Error occurred while updating Course slide.', 'error', true, true);
        }
        return $this->responseRedirectBack('Course slide has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $slide = $this->CourseSlideRepository->deleteSlide($id);

        if (!$slide) {
            return $this->responseRedirectBack('Error occurred while deleting Course slide.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'Course slide has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $slide = $this->CourseSlideRepository->updateSlideStatus($params);

        if ($slide) {
            return response()->json(array('message' => 'Course slide status has been successfully updated'));
        }
    }

}
