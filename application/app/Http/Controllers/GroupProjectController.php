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

class GroupProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   
        $user = auth()->user();
        $group_projects = GroupProject::where('user_id', $user->id)
        ->orWhereHas('members', function ($query) use ($user) 
        {$query->where('user_id', $user->id);})->get();

        if (auth()->user()->type == 'adviser') {
            return view('faculty/home', compact(['group_projects']));
        }else if (auth()->user()->type == 'teacher') {
            return view('teacher/home', compact(['group_projects']));
        }else if (auth()->user()->type == 'office') {
            return view('office/home', compact(['group_projects']));
        }else{
            return view('student/home', compact(['group_projects']));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function groupStore(Request $request, GroupProject $group_projects)
    {
        $group = $request->validate([
            'title'=>'required',
            'subject'=>'required',
            'section'=>'required',
            'team'=>'required',
            'advisor'=>'required',
        ]);

        $group_projects = new GroupProject;
        $group_projects->title = $group['title'];
        $group_projects->subject = $group['subject'];
        $group_projects->section = $group['section'];
        $group_projects->team = $group['team'];
        $group_projects->advisor = $group['advisor'];
        $group_projects->user_id = auth()->user()->id;
        $group_projects->save();

        $members = new Member();
        $members->group_project_id = $group_projects->id;
        $members->user_id = auth()->user()->id;
        $members->save();
        
        return redirect()->back()->with('success', 'Created Group Successfully.');
    }

    public function projectStore(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'file'=>'required',
            'description'=>'required',
            'group_project_id'=>'required'
        ]);

        $file = $request->file('file');
        $record = $file->getClientOriginalName();
        $name = pathinfo($record, PATHINFO_FILENAME);
        $extension = pathinfo($record, PATHINFO_EXTENSION);
        $fileName = time().'-'.$name.'.'.$extension;
        $file->move(public_path('files'), $fileName);

        $data = array(
            'title'=>$request->title,
            'file'=>$fileName,
            'description'=>$request->description,
            'group_project_id'=>$request->group_project_id
        );
        $data['user_id'] = auth()->user()->id;
        
        Project::create($data);
        return redirect()->back()->with('success', 'Posted Project Successfully.');
    }

    public function taskStore(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'content'=>'required',
            'due_date'=>'required',
            'status'=>'required',
            'group_project_id'=>'required'
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        Task::create($input);
        return redirect()->back()->with('success', 'Posted Task Successfully.');
    }

    public function memberStore(Request $request, GroupProject $group_projects)
    {   
        $members = $request->validate([
            'group_project_id' => 'required',
            'user_id' => 'required'
        ]);

        Member::create($members);

        return redirect()->back()->with('success', 'Member Added Successfully.');
    }

    public function feedbackStore(Request $request)
    {
        $request->validate([
            'comment'=>'required',
            'project_id'=>'required' 

        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        Feedback::create($input);
        return redirect()->back()->with('success', 'Feedback Posted.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupProject  $groupProject
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, GroupProject $group_projects, Project $projects, Task $tasks, Feedback $feedbacks, $id)
    {
        $group_projects = GroupProject::find($id);
        $projects = Project::all();
        $feedbacks = Feedback::all();

        if (Task::all()->where('group_project_id', $group_projects->id)->count() == 0){
            $tasks = Task::all();
        }else{
            $tasks = Task::all()->where('group_project_id', $group_projects->id)
            ->where('status','Finished')->count() / 
            Task::all()->where('group_project_id', $group_projects->id)->count() * 100;
        }
        
        if ($group_projects->user_id === auth()->user()->id) {  
            if (auth()->user()->type == 'adviser') {
                return view('faculty/project', compact(['group_projects', 'projects', 'tasks', 'feedbacks']));
            }else if (auth()->user()->type == 'teacher') {
                return view('teacher/project', compact(['group_projects', 'projects', 'tasks', 'feedbacks']));
            }else if (auth()->user()->type == 'office') {
                return view('office/project', compact(['group_projects', 'projects', 'tasks', 'feedbacks']));
            }else{
                return view('student/project', compact(['group_projects', 'projects', 'tasks', 'feedbacks']));
            }
        }else{
            $user = auth()->user();
            $members = $group_projects->members()->where('user_id', $user->id)->get();
            if ($members) {
                if (auth()->user()->type == 'adviser') {
                    return view('faculty/project', compact(['group_projects', 'projects', 'tasks', 'feedbacks']));
                }else if (auth()->user()->type == 'teacher') {
                    return view('teacher/project', compact(['group_projects', 'projects', 'tasks', 'feedbacks']));
                }else if (auth()->user()->type == 'office') {
                    return view('office/project', compact(['group_projects', 'projects', 'tasks', 'feedbacks']));
                }else{
                    return view('student/project', compact(['group_projects', 'projects', 'tasks', 'feedbacks']));
                }
            } else {
                abort(403, 'Unauthorized');
            }
        }

        
    }
    
    public function taskShow(GroupProject $group_projects, Task $tasks, $id)
    {
        $group_projects = GroupProject::find($id);

        if (Task::all()->where('group_project_id', $group_projects->id)->count() == 0){
            $tasks = Task::all();
        }else{
            $tasks = Task::all()->where('group_project_id', $group_projects->id)
            ->where('status','Finished')->count() / 
            Task::all()->where('group_project_id', $group_projects->id)->count() * 100;
        }
        
        if ($group_projects->user_id === auth()->user()->id) {  
            if (auth()->user()->type == 'adviser') {
                return view('faculty/task', compact(['group_projects', 'tasks']));
            }else if (auth()->user()->type == 'teacher') {
                return view('teacher/task', compact(['group_projects', 'tasks',]));
            }else if (auth()->user()->type == 'office') {
                return view('office/task', compact(['group_projects', 'tasks']));
            }else{
                return view('student/task', compact(['group_projects', 'tasks']));
            }
        }else{
            $user = auth()->user();
            $members = $group_projects->members()->where('user_id', $user->id)->first();
            if ($members) {
                if (auth()->user()->type == 'adviser') {
                    return view('faculty/task', compact(['group_projects', 'tasks']));
                }else if (auth()->user()->type == 'teacher') {
                    return view('teacher/task', compact(['group_projects', 'tasks',]));
                }else if (auth()->user()->type == 'office') {
                    return view('office/task', compact(['group_projects', 'tasks']));
                }else{
                    return view('student/task', compact(['group_projects', 'tasks']));
                }
            } else {
                abort(403, 'Unauthorized');
            }
        }

    }

    public function teamShow(GroupProject $group_projects, User $users, Member $members, $id)
    {
        $group_projects = GroupProject::findOrFail($id);        
        $users = User::all();
        $members = Member::all()->where('group_project_id', $group_projects->id);

        if ($group_projects->user_id === auth()->user()->id) {  
            if (auth()->user()->type == 'adviser') {
                return view('faculty/team', compact(['group_projects', 'users', 'members']));
            }else if (auth()->user()->type == 'teacher') {
                return view('teacher/team', compact(['group_projects', 'users', 'members']));
            }else if (auth()->user()->type == 'office') {
                return view('office/team', compact(['group_projects', 'users', 'members']));
            }
        }else{
            $user = auth()->user();
            $member = $group_projects->members()->where('user_id', $user->id)->first();
            if ($member) {
                if (auth()->user()->type == 'adviser') {
                    return view('faculty/team', compact(['group_projects', 'users', 'members']));
                }else if (auth()->user()->type == 'teacher') {
                    return view('teacher/team', compact(['group_projects', 'users', 'members']));
                }else if (auth()->user()->type == 'office') {
                    return view('office/team', compact(['group_projects', 'users', 'members']));
                }else{
                    return view('student/team', compact(['group_projects', 'users', 'members']));
                }
            } else {
                abort(403, 'Unauthorized');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupProject  $groupProject
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->back()->with('success', 'Updated Group Successfully');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupProject  $groupProject
     * @return \Illuminate\Http\Response
     */
    public function groupDestroy(Request $request, GroupProject $group_projects)
    {
        $id = $request->input('id');
        GroupProject::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Group Successfully');
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
        Task::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Task Successfully');
    }
    public function teamDestroy(Request $request, Member $members)
    {
        $id = $request->input('id');
        Member::find($id)->delete();

        return redirect()->back()->with('success', 'Removed Member Successfully');
    }
    public function feedbackDestroy(Request $request, Feedback $feedbacks)
    {
        $id = $request->input('id');
        Feedback::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Feedback Successfully');
    }
}
