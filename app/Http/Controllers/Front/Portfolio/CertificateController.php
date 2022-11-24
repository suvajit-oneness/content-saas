<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\CertificationContract;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class CertificateController extends BaseController
{
     /**
     * @var CertificationContract
     */
    protected $CertificationRepository;


    /**
     * CertificateController constructor.
     * @param CertificationContract $CertificationRepository
     */
    public function __construct(CertificationContract $CertificationRepository)
    {
        $this->CertificationRepository = $CertificationRepository;
    }
    public function index(Request $request)
    {
        $this->setPageTitle('Certificate', ' Certificate');
        $data = (object)[];
        $user_id = auth()->guard('web')->user()->id;
        $data->certificates = Certificate::where('user_id', $user_id)->get();
       // $category=ArticleCategory::orderby('title')->get();
        return view('front.portfolio.certificate.index',compact('data'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Certificate', 'Create Certificate');
        return view('front.portfolio.certificate.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'certificate_title' => 'required',
            'certificate_type' => 'required|string|min:1',
            'file' => 'required|mimes:jpeg,jpg,png,gif|required|max:50'
        ]);
        $params = $request->except('_token');

        $certificate = $this->CertificationRepository->createCertification($params);

        if (!$certificate) {
            return $this->responseRedirectBack('Error occurred while creating Certificate.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'Certificate has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $certificate = $this->CertificationRepository->findCertificationById($id);

        $this->setPageTitle('Certificate', 'Edit Certificate : ' . $certificate->occupation);
        return view('front.portfolio.certificate.edit', compact('certificate'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'certificate_title' => 'required',
            'certificate_type' => 'required|string|min:1',
            'file' => 'required|mimes:jpeg,jpg,png,gif|required|max:50'
        ]);
        $params = $request->except('_token');
        $certificate = $this->CertificationRepository->updateCertification($params);

        if (!$certificate) {
            return $this->responseRedirectBack('Error occurred while updating Certificate.', 'error', true, true);
        }
        // return $this->responseRedirectBack('Certificate has been updated successfully', 'success', false, false);
        return redirect()->back()->with('success', 'Certificate has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $certificate = $this->CertificationRepository->deleteCertification($id);

        if (!$certificate) {
            return $this->responseRedirectBack('Error occurred while deleting Certificate.', 'error', true, true);
        }
        return redirect()->back()->with('success','Certificate has been deleted successfully', 'success', false, false);
    }
}
