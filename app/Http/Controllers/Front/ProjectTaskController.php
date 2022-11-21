<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectTask;
use App\Models\ProjectTaskCommercial;
use App\Models\TaskComment;
use Illuminate\Support\Facades\Auth;

// use Auth;
// Auth
class ProjectTaskController extends Controller
{
    // public function index(Request $request)
    // {
    //     if (!empty(auth()->guard()->user()->id)) {
    //         $data = Project::where('created_by', auth()->guard()->user()->id)->latest('id')->where('deleted_at', null)->paginate(15);
    //         return view('front.project.index', compact('data'));
    //     } else {
    //         return redirect()->route('front.user.login');
    //     }
    // }

    public function create(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        $status = ProjectStatus::orderBy('position', 'asc')->paginate(15);

        return view('front.project-task.create', compact('status', 'project'));
    }

    public function detail(Request $request, $slug)
    {
        $item = ProjectTask::where('slug', $slug)->where('created_by', auth()->guard('web')->user()->id)->first();
        // $tasks = ProjectTask::where('project_id', $data->id)->get();

        return view('front.project-task.detail', compact('item'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'project_id' => 'required|integer|min:1',
            'project_slug' => 'required|string|min:2|max:255',
            'title' => 'required|string|min:2|max:255',
            'short_desc' => 'required|string|min:2',
            // 'status' => 'required|string|min:2',
            'deadline' => 'required|string|min:2',
            'label' => 'required|string|min:2',
            'recurring' => 'required',
            'document' => 'nullable',
            'external_links' => 'nullable|array'
        ]);

        $project = new ProjectTask();
        $project->project_id = $request->project_id;
        $project->position = 1;
        $project->title = $request->title;
        $project->slug = slugGenerate($request->title, 'project_tasks');
        $project->short_desc = $request->short_desc;
        $project->deadline = $request->deadline;
        $project->label = $request->label;
        $project->recurring = $request->recurring;

        if (!empty($request->document)) {
            $project->document = imageUpload($request->document, 'project-task-document');
        } else {
            $project->document = '';
        }

        if (!empty($request->external_links)) {
            $links = '';
            foreach($request->external_links as $ext_link) {
                if (!empty($ext_link)) {
                    $links .= $ext_link.', ';
                }
            }

            $project->external_links = substr($links, 0, -2);
        } else {
            $project->external_links = '';
        }

        // $project->status = $request->status;
        $project->created_by = auth()->guard('web')->user()->id;
        $project->save();

        return redirect()->route('front.project.detail', $request->project_slug)->with('success', 'Task added successfully');
    }

    public function delete(Request $request, $id)
    {
        ProjectTask::where('id', $id)->where('created_by', auth()->guard('web')->user()->id)->update([
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->back()->with('success', 'Task removed successfully');
    }

    public function edit(Request $request, $id)
    {
        $data = ProjectTask::findOrFail($id);
        $status = ProjectStatus::where('created_by',null)->orWhere('created_by',Auth::guard('web')->user()->id)->orderBy('position', 'asc')->get();

        return view('front.project-task.edit', compact('data', 'status'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            // 'project_id' => 'required|integer|min:1',
            'project_slug' => 'required|string|min:2|max:255',
            'title' => 'required|string|min:2|max:255',
            'short_desc' => 'required|string|min:2',
            // 'status' => 'required|string|min:2',
            'deadline' => 'required|string|min:2',
            'label' => 'required|string|min:2',
            'recurring' => 'required',
            'document' => 'nullable',
            'external_links' => 'nullable|array'
        ]);

        $project = ProjectTask::findOrFail($id);
        /*
        $project->title = $request->title;
        $project->slug = slugGenerate($request->title, 'projects');
        $project->short_desc = $request->short_desc ?? '';

        if (!empty($request->document)) {
            $project->document = imageUpload($request->document, 'project-document');
        } else {
            $project->document = '';
        }

        if (!empty($request->status)) {
            $project->status = $request->status;
        }
        */
        $project->title = $request->title;
        $project->slug = slugGenerate($request->title, 'project_tasks');
        $project->short_desc = $request->short_desc;
        $project->deadline = $request->deadline;
        $project->label = $request->label;
        $project->recurring = $request->recurring;

        if (!empty($request->document)) {
            $project->document = imageUpload($request->document, 'project-task-document');
        } else {
            $project->document = '';
        }

        if (!empty($request->external_links)) {
            $links = '';
            foreach($request->external_links as $ext_link) {
                if (!empty($ext_link)) {
                    $links .= $ext_link.', ';
                }
            }

            $project->external_links = substr($links, 0, -2);
        } else {
            $project->external_links = '';
        }

        // $project->status = $request->status;
        $project->save();

        return redirect()->route('front.project.detail', $request->project_slug)->with('success', 'Task updated successfully');
    }

    //task comment add
    public function updateComment(Request $request, $id)
    {
         //dd($request->all());
        $request->validate([
            'comment' => 'required',
        ]);
        $project = new TaskComment();
        $project->comment = $request->comment ?? '';
        $project->user_id = Auth::guard('web')->user()->id;
        $project->task_id = $request->task_id;
        if (!empty($request->doc)) {
            $project->doc = imageUpload($request->doc, 'project-task-document');
        } else {
            $project->doc = '';
        }
        $project->save();

        return redirect()->back()->with('success', 'Task updated successfully');
    }

    public function updateStatus(Request $request)
    {
        if($request->spare){
            $status_slug = slugGenerate($request->status,'project_statuses');
            ProjectStatus::insert([
                'title' => $request->status,
                'slug' => $status_slug,
                'icon' => '<i class="fas fa-check"></i>',
                'short_desc' => 'New Status Added by user!',
                'created_by' => Auth::guard('web')->user()->id,
            ]);
            $request->status = $status_slug;
        }

        $update = ProjectTask::where('id',$request->id)->update(['status' => $request->status]);
        if($update){
            return response()->json(array('message' => 'Task status has been successfully updated'));
        }else{
            return response()->json(array('message' => 'Error occoured!'));
        }
    }
    public function updateCommercial(Request $request)
    {
        $project_commercial = ProjectTaskCommercial::where('project_task_id',$request->id)->get();
        if(count($project_commercial) > 0){
            ProjectTaskCommercial::where('project_task_id',$request->id)->update([
                'charges_limit'=>$request->charges,
                'currency_id'=>$request->currency,
                'count'=>$request->count,
                'total_count'=>$request->total_count,
            ]);
            return response()->json(array('message' => 'Project Task commercial updated!'));
        }else{
            ProjectTaskCommercial::insert([
                'project_task_id'=>$request->id,
                'charges_limit'=>$request->charges,
                'currency_id'=>$request->currency,
                'count'=>$request->count,
                'total_count'=>$request->total_count,
            ]);
            return response()->json(array('message' => 'Project Task commercial submitted!'));
        }
    }
}
