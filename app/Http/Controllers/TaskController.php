<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index(User $user, Task $task)
    {
        // paginate the authorized user's tasks with 5 per page



        $follows = (auth()->user()) ? auth()->user()->following->contains($task->id) : true;








        $followersCount = Cache::remember(

            'count.followers.' . $user->id,

            now()->addSeconds(30),

            function () use ($user) {


            });



        $followingCount = Cache::remember(

            'count.following.' . $user->id,

            now()->addSeconds(30),

            function () use ($user) {

                return $user->following->count();

            });



        return view('tasks.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));






    }

    /**
     * Store a new incomplete task for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);

        // create a new incomplete task with the given title
        Auth::user()->tasks()->create([
            'title' => $data['title']
        ]);

        // flash a success message to the session
        session()->flash('status', 'Task Created!');

        // redirect to tasks index
        return redirect('/profile/' . auth()->user()->id);
    }

    /**
     * Mark the given task as complete and redirect to tasks index.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function complete(Task $task)
    {
        // check if the authenticated user can complete the task

        // mark the task as complete and save it
        $task->is_complete = true;
        $task->save();

        // flash a success message to the session
        session()->flash('status', 'Task Completed!');

        // redirect to tasks index
      //  return false;
    }

    public function update(User $user, Task $task, Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);
        Auth::user()->tasks()->find($task->id)->update([
            'title' => $data['title'],
            'is_complete' => false,

        ]);
        session()->flash('status', 'Task Updated!');

        return redirect('/profile/' . auth()->user()->id);
    }

    public function delete(Task $task)
    {
        // check if the authenticated user can complete the task

        // mark the task as complete and save it

        $task->delete();

        // flash a success message to the session
        session()->flash('status', 'Task Deleted!');

        // redirect to tasks index
        return redirect('/profile/' . auth()->user()->id);
    }




}
