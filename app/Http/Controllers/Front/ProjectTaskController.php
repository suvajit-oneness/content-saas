<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectTask;

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

    // public function detail(Request $request, $slug)
    // {
    //     $data = Project::where('slug', $slug)->first();
    //     $tasks = ProjectTask::where('project_id', $data->id)->get();

    //     return view('front.project.detail', compact('data', 'tasks'));
    // }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'project_id' => 'required|integer|min:1',
            'project_slug' => 'required|string|min:2|max:255',
            'title' => 'required|string|min:2|max:255',
            'short_desc' => 'required|string|min:2',
            'status' => 'required|string|min:2',
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

            $project->external_links = $links;
        } else {
            $project->external_links = '';
        }

        $project->status = $request->status;
        $project->created_by = auth()->guard('web')->user()->id;
        $project->save();

        return redirect()->route('front.project.detail', $request->project_slug)->with('success', 'Task added successfully');
    }

    // public function delete(Request $request, $id)
    // {
    //     Project::where('id', $id)->where('created_by', auth()->guard('web')->user()->id)->update([
    //         'deleted_at' => date('Y-m-d H:i:s')
    //     ]);
    //     return redirect()->back()->with('success', 'Project removed successfully');
    // }

    // public function edit(Request $request, $id)
    // {
    //     $data = Project::findOrFail($id);
    //     $status = ProjectStatus::orderBy('position', 'asc')->get();

    //     return view('front.project.edit', compact('data', 'status'));
    // }

    // public function update(Request $request, $id)
    // {
    //     // dd($request->all());

    //     $request->validate([
    //         'title' => 'required|string|min:2|max:255',
    //         'short_desc' => 'nullable|string|min:2',
    //         'document' => 'nullable'
    //     ]);

    //     $project = Project::findOrFail($id);
    //     $project->title = $request->title;
    //     $project->slug = slugGenerate($request->title, 'projects');
    //     $project->short_desc = $request->short_desc ?? '';

    //     if (!empty($request->document)) {
    //         $project->document = imageUpload($request->document, 'project-document');
    //     } else {
    //         $project->document = '';
    //     }

    //     if (!empty($request->status)) {
    //         $project->status = $request->status;
    //     }

    //     // $project->created_by = auth()->guard('web')->user()->id;

    //     $project->save();

    //     return redirect()->route('front.project.index')->with('success', 'Project updated successfully');
    // }
}
