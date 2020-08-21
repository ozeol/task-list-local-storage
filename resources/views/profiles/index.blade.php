@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @can('update', $user->profile)

                    <div class="card card-new-task">
                        <div class="card-header">New Task</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('tasks.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off" />
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">Tasks</div>

                        <div class="card-body">
                            <table class="table table-striped">
                            @foreach ($user->tasks->sortBy('title') as $task)
                                    <tr>
                              
                                        <td class="text-left">


                                            <div class="d-flex  float-left">

                                             <!--   <form method="POST" style="padding-right:4px;" action="{{ route('task.complete', $task->id) }}">

                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-primary">Complete</button>
                                                </form>-->
                                                
                                                 <!--    <div class="h4">{{ $task->id }}</div>-->
                                                 
                                                 <follow-button style="padding-right:0px;" item-id="{{ $task->id }}" item="{{ $task }}"></follow-button>
                                                

                                                <form method="POST" style="padding-right:4px;" action="{{ route('task.delete', $task->id) }}">

                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                </form>

                                                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                <div>


                                                    <input id="task-title"
                                                           type="text"
                                                           class="form-control {{ $errors->has('title')? 'is-invalid' : ''}}"
                                                           name="title"
                                                           value="{{ old('title')?? $task->title }}">

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>

                                                    @endif
                                                </div>

                                                <div class="row pt-1 pr-3" style="float:right;">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>

</form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>


                        </div>
                    </div>

            </div>
            @endcan
        </div>
    </div>
@endsection
