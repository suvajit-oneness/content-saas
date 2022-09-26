<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\TestimonialContract;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class TestimonialController extends BaseController
{
     /**
     * @var TestimonialContract
     */
    protected $PortfolioRepository;


    /**
     * TestimonialController constructor.
     * @param TestimonialContract $TestimonialRepository
     */
    public function __construct(TestimonialContract $TestimonialRepository)
    {
        $this->TestimonialRepository = $TestimonialRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Testimonial', 'Create Testimonial');
        return view('front.portfolio.testimonial.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_name' => 'required',
            'occupation' => 'required',
        ]);
        $params = $request->except('_token');

        $testimonial = $this->TestimonialRepository->createTestimonial($params);

        if (!$testimonial) {
            return $this->responseRedirectBack('Error occurred while creating Testimonial.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'Testimonial has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $testimonial = $this->TestimonialRepository->findTestimonialById($id);

        $this->setPageTitle('Testimonial', 'Edit Testimonial : ' . $testimonial->occupation);
        return view('front.portfolio.testimonial.edit', compact('testimonial'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'client_name' => 'required',
            'occupation' => 'required',
        ]);
        $params = $request->except('_token');
        $testimonial = $this->TestimonialRepository->updateTestimonial($params);

        if (!$testimonial) {
            return $this->responseRedirectBack('Error occurred while updating Testimonial.', 'error', true, true);
        }
        return $this->responseRedirectBack('Testimonial has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $testimonial = $this->TestimonialRepository->deleteTestimonial($id);

        if (!$testimonial) {
            return $this->responseRedirectBack('Error occurred while deleting Testimonial.', 'error', true, true);
        }
        return redirect()->back()->with('success','Testimonial has been deleted successfully', 'success', false, false);
    }
}
