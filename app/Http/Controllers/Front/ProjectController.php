<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if (!empty(auth()->guard()->user()->id)) {
            $data = Project::where('created_by', auth()->guard()->user()->id)->latest('id')->where('deleted_at', null)->paginate(15);
            return view('front.project.index', compact('data'));
        } else {
            return redirect()->route('front.user.login');
        }
    }

    public function create(Request $request)
    {
        return view('front.project.create');
    }

    public function detail(Request $request)
    {
        return view('front.project.detail');
    }

    public function store(Request $request)
    {
        $request->validate([
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

        $project->created_by = auth()->guard('web')->user()->id;

        $project->save();

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
        return view('front.project.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
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
        } else {
            $project->document = '';
        }

        // $project->created_by = auth()->guard('web')->user()->id;

        $project->save();

        return redirect()->route('front.project.index')->with('success', 'Project updated successfully');
    }
}
