<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EventPage;
use Illuminate\Http\Request;

class EventPageController extends BaseController
{
    public function index(Request $request){
        $event_page = EventPage::all();
        $this->setPageTitle('Event page content', 'Event page html content!');
        return view('admin.eventpage.index',compact('event_page'));
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $event_page= EventPage::findOrfail($id);
        $this->setPageTitle('Event page content', 'Event page content');
        return view('admin.eventpage.edit', compact('event_page'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
       //dd($request->all());
        $this->validate($request, [
            'header_left' => 'required',
            'header_right' => 'required',
        ]);
       
        $event_page = EventPage::find($request->id);
        $event_page->header_left = $request->header_left;
        $event_page->header_right = $request->header_right;

        if (!$event_page->save()) {
            return $this->responseRedirectBack('Error occurred while updating Home Page.', 'error', true, true);
        }
        return $this->responseRedirectBack('Page has been updated successfully', 'success', false, false);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $event_page= EventPage::findOrfail($id);
        $this->setPageTitle('Event page content','Event page content');
        return view('admin.eventpage.details', compact('event_page'));
    }
}
