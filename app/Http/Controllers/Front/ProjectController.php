<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Models\ProjectCommercial;
use App\Models\ProjectStatus;
use App\Models\ProjectTask;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if (!empty(auth()->guard()->user()->id)) {
            $data = Project::where('created_by', auth()->guard()->user()->id)->latest('id')->where('deleted_at', null);

            if(!empty($request->search_status))
                $data = $data->where('status','=',$request->search_status);
            
            if(!empty($request->keyword))
                $data = $data->where('title','like','%'.$request->keyword.'%');

            $data = $data->paginate(15);
            $status = ProjectStatus::orderBy('position', 'asc')->get();
            return view('front.project.index', compact('data','status'));
        } else {
            return redirect()->route('front.user.login');
        }
    }

    public function create(Request $request)
    {
        $status = ProjectStatus::orderBy('position', 'asc')->get();
        return view('front.project.create', compact('status'));
    }

    public function detail(Request $request, $slug)
    {
        // $data = Project::where('slug', $slug)->first();
        $data = Project::where('slug', $slug)->where('created_by', auth()->guard('web')->user()->id)->first();
        $tasks = ProjectTask::where('project_id', $data->id)->where('deleted_at', null)->latest('id');

        if(!empty($request->search_status))
            $tasks = $tasks->where('status','=',$request->search_status);
            
        if(!empty($request->keyword))
            $tasks = $tasks->where('title','like','%'.$request->keyword.'%');
        
        $tasks = $tasks->paginate(15);

        $status = ProjectStatus::orderBy('position', 'asc')->get();
       
        return view('front.project.detail', compact('data', 'tasks', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'status' => 'required|string|min:2|max:255',
            'title' => 'required|string|min:2|max:255',
            'short_desc' => 'nullable|string|min:2',
            'document' => 'nullable'
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->slug = slugGenerate($request->title, 'projects');
        $project->short_desc = $request->short_desc ?? '';

        if (!empty($request->document)) {
            $project->document = imageUpload($request->document, 'project-document');
        } else {
            $project->document = '';
        }

        // $project->status = $request->status;
        $project->created_by = auth()->guard('web')->user()->id;

        $project->save();
        // $status = new ProjectStatus();
        // $status->title = $project->status ?? '';
        // $status->slug = slugGenerate($project->status, 'project_statuses');
        // $status->icon = '<i class="fas fa-check"></i>';
        // $status->created_by = auth()->guard('web')->user()->id ?? '';
        // $status->position = count($status->position)+1 ?? '';
        // $status->save();

        return redirect()->route('front.project.index')->with('success', 'Project created successfully');
    }

    public function delete(Request $request, $id)
    {
        Project::where('id', $id)->where('created_by', auth()->guard('web')->user()->id)->update([
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->back()->with('success', 'Project removed successfully');
    }

    public function edit(Request $request, $id)
    {
        $data = Project::findOrFail($id);
        $status = ProjectStatus::where('created_by',null)->orWhere('created_by',Auth::guard('web')->user()->id)->orderBy('position', 'asc')->get();

        return view('front.project.edit', compact('data', 'status'));
    }

    public function update(Request $request, $id)
    {
         //dd($request->all());

        $request->validate([
            'title' => 'required|string|min:2|max:255',
            'short_desc' => 'nullable|string|min:2',
            'document' => 'nullable'
        ]);

        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->slug = slugGenerate($request->title, 'projects');
        $project->short_desc = $request->short_desc ?? '';

        if (!empty($request->document)) {
            $project->document = imageUpload($request->document, 'project-document');
        }

        // if (!empty($request->status)) {
        //     if($request['status'] == 'spare'){
        //         $status->title = $request['other_status'] ?? '';
        //         }
        //     else{
        //     $project->status = $request->status;
        //         }
        // }

        // $project->created_by = auth()->guard('web')->user()->id;

        $project->save();
        // if($request['status'] == 'spare')
        // $status = new ProjectStatus();
        // if($request['status'] == 'spare'){
        //     $status->title = $request['other_status'] ?? '';
        //     }
           
        // //$status->title = $request->other_status;
        // $status->slug = slugGenerate($request->other_status, 'project_statuses');
        // $status->icon = '<i class="fas fa-check"></i>';
        // $status->created_by = auth()->guard('web')->user()->id ?? '';
        // //$status->position = $status->position ?? '';
        // $status->save();
        return redirect()->back()->with('success', 'Project updated successfully');
    }

    public function updateStatus(Request $request)
    {
        if($request->spare){
            $status_slug = slugGenerate($request->status,'project_statuses');
            ProjectStatus::insert([
                'title' => $request->status,
                'slug' => slugGenerate($request->status,'project_statuses'),
                'icon' => '<i class="fas fa-check"></i>',
                'short_desc' => 'New Status Added by user!',
                'created_by' => Auth::guard('web')->user()->id,
            ]);
            $request->status = $status_slug;
        }

        $update = Project::where('id',$request->id)->update(['status' => $request->status]);
        if($update){
            return response()->json(array('message' => 'Project status has been successfully updated'));
        }else{
            return response()->json(array('message' => 'Error occoured!'));
        }
    }

    public function updateCommercial(Request $request)
    {
        $project_commercial = ProjectCommercial::where('project_id',$request->id)->get();
        if(count($project_commercial) > 0){
            ProjectCommercial::where('project_id',$request->id)->update([
                'charges_limit'=>$request->charges,
                'currency_id'=>$request->currency,
                'count'=>$request->count,
                'total_count'=>$request->total_count,
            ]);
            return response()->json(array('message' => 'Project commercial updated!'));
        }else{
            ProjectCommercial::insert([
                'project_id'=>$request->id,
                'charges_limit'=>$request->charges,
                'currency_id'=>$request->currency,
                'count'=>$request->count,
                'total_count'=>$request->total_count,
            ]);
            return response()->json(array('message' => 'Project commercial submitted!'));
        }
    }
}
