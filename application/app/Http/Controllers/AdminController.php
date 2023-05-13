<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Task;
use App\Models\Project;
use App\Models\GroupProject;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin/index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'type'=>'required',
        ]);

        $input = array(
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'type'=>$request->type
        );

        User::create($input);
        return redirect()->back()->with('success', 'New User Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userShow(User $users)
    {
        $users = User::all();

        return view('admin/user', compact(['users']));
    }
    public function groupShow(GroupProject $group_projects)
    {
        $group_projects = GroupProject::all();

        return view('admin/group', compact(['group_projects']));
    }
    public function projectShow(Project $projects, GroupProject $group_projects)
    {   
        $projects = Project::all();

        return view('admin/project', compact(['group_projects', 'projects']));
    }
    public function taskShow(Task $tasks)
    {
        $tasks = Task::all();

        return view('admin/task', compact(['tasks']));
    }
    public function feedbackShow(Feedback $feedbacks)
    {
        $feedbacks = Feedback::all();

        return view('admin/feedback', compact(['feedbacks']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userUpdate(Request $request, User $users)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'type'=>'required',
        ]);

        $id = $request->input('id');
        $users = User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = bcrypt($request->input('password'));
        $users->type = $request->input('type');
        $users->save();

        return redirect()->back()->with('success', 'Updated User Successfully');
    }
    public function groupUpdate(Request $request, GroupProject $group_projects)
    {
        $request->validate([
            'id'=>'required',
            'title'=>'required',
            'subject'=>'required',
            'section'=>'required',
            'team'=>'required',
            'advisor'=>'required'
        ]);

        $id = $request->input('id');
        $group_projects = GroupProject::find($id);
        $group_projects->title = $request->input('title');
        $group_projects->subject = $request->input('subject');
        $group_projects->section = $request->input('section');
        $group_projects->team = $request->input('team');
        $group_projects->advisor = $request->input('advisor');
        $group_projects->save();

        return redirect()->back()->with('success', 'Updated Group Project Successfully');
    }
    public function taskUpdate(Request $request, Task $tasks)
    {
        $request->validate([
            'id'=>'required',
            'title'=>'required',
            'content'=>'required',
            'due_date'=>'required',
            'status'=>'required',
            'group_project_id'=>'required'
        ]);

        $id = $request->input('id');
        $tasks = Task::find($id);
        $tasks->title = $request->input('title');
        $tasks->content = $request->input('content');
        $tasks->due_date = $request->input('due_date');
        $tasks->status = $request->input('status');
        $tasks->save();

        return redirect()->back()->with('success', 'Updated Task Successfully');
    }
    public function feedbackUpdate(Request $request, Feedback $feedbacks)
    {
        $request->validate([
            'id'=>'required',
            'comment'=>'required',
            'project_id'=>'required'
        ]);

        $id = $request->input('id');
        $feedbacks = Feedback::find($id);
        $feedbacks->comment = $request->input('comment');
        $feedbacks->save();

        return redirect()->back()->with('success', 'Updated Feedback Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userDestroy(Request $request, User $users)
    {
        $id = $request->input('id');
        User::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Group Project Successfully');
    }
    public function groupDestroy(Request $request, GroupProject $group_projects)
    {
        $id = $request->input('id');
        GroupProject::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Group Project Successfully');
    }
    public function projectDestroy(Request $request, Project $projects)
    {
        $id = $request->input('id');
        Project::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Update Successfully');
    }
    public function taskDestroy(Request $request, Task $tasks)
    {
        $id = $request->input('id');
        Task ::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Task Successfully');
    }
    public function feedbackDestroy(Request $request, Feedback $feedbacks)
    {
        $id = $request->input('id');
        Feedback::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Feedback Successfully');
    }
}
