<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\EventContract;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\BaseController;
use Auth;
use Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventExport;
use App\Models\EventType;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class EventController extends BaseController
{
    /**
     * @var EventContract
     */
    protected $eventRepository;


    /**
     * EventController constructor.
     * @param EventContract $eventRepository
     *
     */
    public function __construct(EventContract $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (isset($request->type) || isset($request->from) ||isset($request->to) || isset($request->keyword)) {
            $type = !empty($request->type) ? $request->type : '';
            $from = !empty($request->from) ? $request->from : '';
            $to = !empty($request->to) ? $request->to : '';
            $keyword = !empty($request->keyword) ? $request->keyword : '';
            $events = $this->eventRepository->searchEventsData($from,$to,$type,$keyword);
        }else{
            $events = Event::orderby('title')->paginate(25);
        }
        $categories = $this->eventRepository->listCategory();
        $this->setPageTitle('Event', 'List of all event');
        return view('admin.event.index', compact('events','categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->eventRepository->listCategory();
        $this->setPageTitle('Event', 'Create Event');
        return view('admin.event.create', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       // dd($request->all());

        $this->validate($request, [
            'category' =>  'required|integer',
            'title'      =>  'required|string|min:1|max:255',
            'description' =>  'required|string',
            'host' =>  'required|string|min:1|max:255',
            'other_host_name' =>  'nullable|string|min:1|max:255',
            'type' =>  'required',
            'start_date' =>  'required',
            'start_time' =>  'required',
            'end_date' =>  'required',
            'end_time' =>  'required',
            'link' =>  'nullable|url',
            'event_cost' =>  'nullable',
            'location' =>  'nullable|url',
            'image'     =>  'required|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        $params = $request->except('_token');

        $event = $this->eventRepository->createEvent($params);

        if (!$event) {
            return $this->responseRedirectBack('Error occurred while creating event.', 'error', true, true);
        }
        return $this->responseRedirect('admin.event.index', 'Event has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $event = $this->eventRepository->findEventById($id);
       //dd($event->cost);
        $categories = $this->eventRepository->listCategory();
        $this->setPageTitle('Event', 'Edit Event : '.$event->title);
        return view('admin.event.edit', compact('event','categories'));
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
            'category' =>  'required|integer',
            'title'      =>  'required|string|min:1|max:255',
            'description' =>  'required|string',
            'host' =>  'required|string|min:1|max:255',
            'type' =>  'required',
            'start_date' =>  'required',
            'start_time' =>  'required',
            'end_date' =>  'required',
            'end_time' =>  'required',
            'address' =>  'required',
            'pin' =>  'required',
          //  'link' =>  'nullable|url',
            'cost' =>  'nullable',
           // 'location' =>  'nullable|url',
            //'image'     =>  'nullable|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        $params = $request->except('_token');

        $event = $this->eventRepository->updateEvent($params);

        if (!$event) {
            return $this->responseRedirectBack('Error occurred while updating event.', 'error', true, true);
        }
        return $this->responseRedirectBack('Event has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $event = $this->eventRepository->deleteEvent($id);

        if (!$event) {
            return $this->responseRedirectBack('Error occurred while deleting event.', 'error', true, true);
        }
        return $this->responseRedirect('admin.event.index', 'Event has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $event = $this->eventRepository->updateEventStatus($params);

        if ($event) {
            return response()->json(array('message'=>'Event status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $events = $this->eventRepository->detailsEvent($id);
        $event = $events[0];

        $this->setPageTitle('Event', 'Event Details : '.$event->title);
        return view('admin.event.details', compact('event'));
    }

    public function csvStore(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'admin/uploads/csv';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database



                    foreach ($importData_arr as $importData) {

                        $commaSeperatedCats = '';

                            $catExistCheck = EventType::where('title', $importData[1])->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new EventType();
                                $dirCat->title = $importData[1];
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedCats .= $insertDirCatId . ',';
                            }

                        $count = 0;
                        $commaSeperatedSubCats = '';
                         $count = $total = 0;
                        $successArr = $failureArr = [];



                        if (!empty($importData[0])) {
                            // dd($importData[0]);
                            $titleArr = explode(',', $importData[0]);

                            // echo '<pre>';print_r($titleArr);exit();

                            foreach ($titleArr as $titleKey => $titleValue) {
                                // slug generate
                                $slug = Str::slug($titleValue, '-');
                                $slugExistCount = DB::table('events')->where('title', $titleValue)->count();
                                if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                                $insertData = array(
                                    "title" => $titleValue,
                                    "content" => isset($importData[7]) ? $importData[7] : null,
                                    "meta_title" => isset($importData[8]) ? $importData[8] : null,
                                    "meta_key" => isset($importData[6]) ? $importData[6] : null,
                                    "article_category_id" => isset($commaSeperatedCats) ? $commaSeperatedCats : null,
                                    "article_sub_category_id" => isset($commaSeperatedSubCats) ? $commaSeperatedSubCats : null,
                                    "article_tertiary_category_id" => isset($commaSeperatedSublevelCats) ? $commaSeperatedSublevelCats : null,
                                    "slug" => $slug,
                                    "meta_description" => isset($importData[8]) ? $importData[8] : null,

                                );

                                $resp =Event::insertData($insertData, $count,$successArr,$failureArr);
                                $count = $resp['count'];
                                $successArr = $resp['successArr'];
                                $failureArr = $resp['failureArr'];
                                $total++;
                            }
                        }
                    }
                    //Session::flash('message', 'Import Successful.');
                        if($count==0){
                            FacadesSession::flash('csv', 'Already Uploaded. ');
                        }
                        else{
                             FacadesSession::flash('csv', 'Import Successful. '.$count.' Data Uploaded');
                        }
                } else {
                    FacadesSession::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                FacadesSession::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            FacadesSession::flash('message', 'No file found.');
        }
        return redirect()->route('admin.event.index');
    }
    // csv upload

    public function export()
    {
        return Excel::download(new EventExport, 'event.xlsx');
    }
}
