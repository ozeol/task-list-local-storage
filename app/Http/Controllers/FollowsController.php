<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Task;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   

    public function store(User $user, Task $task, Request $request)
    {
        // check if the authenticated user can complete the task
       
        $data = $this->validate($request, [
            'is_complete' => 'required|boolean',
        ]);


        
        Auth::user()->tasks()->where('id', $task->id)->update([
            'is_complete' => $data['is_complete']
        // mark the task as complete and save it
        ]);
       
      
    }


}
