<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    // Constructor
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $task_list = Task::where('user_id', Auth::user()->id)->get();

        return Inertia::render('Task/Index', [
            'task_list' => $task_list,
        ]);
    }

    public function detail(Request $request)
    {
        $task_id = $request->task_id;
        $task_detail = Task::find($task_id);

        return Inertia::render('Task/Detail', [
            'task_detail' => $task_detail,
        ]);
    }

    public function form(Request $request)
    {
        $parameter = [
            'id' => '',
            'user_id' => Auth::user()->id,
            'task_name' => '',
            'description' => '',
            'status' => '1',
        ];
        $task_id = $request->task_id;
        if (!is_null($task_id)) {
            $task_detail = Task::where('id', $task_id)->first()->toArray();
            foreach ($task_detail as $key => $value) {
                if (isset($parameter[$key])) {
                    $parameter[$key] = $value;
                }
            }
        }
        return Inertia::render('Task/Form', [
            'user_detail' => Auth::user(),
            'parameter' => $parameter,
        ]);
    }

    public function done(Request $request)
    {
        $task_id = $request->task_id;
        $data = [
            'user_id' => $request->user_id,
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => $request->status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!is_null($task_id)) {
            Task::where('id', $task_id)->update($data);
        } else {
            $data['created_at'] = date('Y-m-d h:i:s');
            Task::insert($data);
        }

        return redirect('/task');
    }

    public function update(Request $request)
    {
        $task_id = $request->task_id;
        $status = $request->status;
        $updated_at = $status == 3 ? date('Y-m-d H:i:s') : null;
        Task::where('id', $task_id)->update([
            'status' => $status,
            'completed_at' => $updated_at,
            'updated_at' => $updated_at,
        ]);

        return redirect('/task');
    }

    public function delete_confirm(Request $request)
    {
        $task_id = $request->task_id;
        $task_detail = Task::where('id', $task_id)->first()->toArray();

        return Inertia::render('Task/Form', [
            'user_detail' => Auth::user(),
            'task_detail' => $task_detail,
        ]);
    }

    public function delete_done(Request $request)
    {
        $task_id = $request->task_id;
        Task::where('id', $task_id)->delete();

        return redirect('/task');
    }
}
