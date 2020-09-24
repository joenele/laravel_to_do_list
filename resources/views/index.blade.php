@extends('layouts.master')
@section('content')
  <table>
    <thead>
      <tr>
          <th>Task</th>
          @isAdmin
          <th>Assigned to</th>
          @endisAdmin
          <th>Edit</th>
          <th>Delete</th>
      </tr>
    </thead>

    <tbody>
      @foreach($tasks as $task)
      <tr>
        <td><a class = 'teal-text text-lighten-2' 
        href="{{ route('updateStatus', $task->id) }}">
          @if(!$task->status)
          {{ $task->content}}
          @else
          <strike  class="grey-text">{{ $task->content}}</strike>
          @endif
        </a></td>
        @isAdmin
        <td>{{ $task->user->name }}</td>
        @endisAdmin
        <td><a title="edit" href="{{ route('edit', $task->id) }}"> <i class="small material-icons teal-text text-lighten-2">edit</i></a></td>
        <td><a title="delete" onclick= "return confirm('Delete?');" href="{{ route('delete', $task->id) }}"> <i class="small material-icons red-text">delete_forever</i></a></td>
      </tr>
      @endforeach

    </tbody>
  </table>

  <br><br>
  {{ $tasks->links('vendor.pagination.materialize') }}

  <!-- <ul class="pagination center-align">
    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
    <li class="active teal lighten-2"><a href="#!">1</a></li>
    <li class="waves-effect"><a href="#!">2</a></li>
    <li class="waves-effect"><a href="#!">3</a></li>
    <li class="waves-effect"><a href="#!">4</a></li>
    <li class="waves-effect"><a href="#!">5</a></li>
    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
  </ul> -->

  <form method="post" action="{{ route('store') }}" class="col s12">
    <div class="row">
      <div class="input-field col s12">
        <input name= "task" id="task" type="text" class="validate">
        <label for="task">New task</label>
      </div>
    </div>

    @include('partials.coworkers')

    <button type="submit" class="waves-effect waves-light btn">Add new task</button>
    @csrf
  </form>

  @isWorker
  <br><br><br>
  <form method="post" action="{{ route('sendInvitation') }}" col s12>
    <div class="input-field">
      <select name="admin">
          <option value="" disabled selected>Send invitation to:</option>
          @foreach($coworkers as $coworker)
          <option value="{{ $coworker->id }}">{{ $coworker->name }}</option>
          @endforeach
      </select>
      <label>Send invitation</label>
    </div>
    <button type="submit" class="waves-effect waves-light btn">Send invitation</button>
    @csrf
  </form>
  
  @endisWorker

  @isAdmin
  <br><br><br>
  <ul class="collection with-header">
    <li class="collection-header"><h4>My Coworkers</h4></li>
    @foreach($coworkers as $coworker)
    <li class="collection-item"><div>{{ $coworker->worker->name }}<a href="{{ route('deleteWorker', $coworker->id) }}" 
      class="secondary-content red-text">delete</a></div>
    </li>
    @endforeach
  </ul>
  @endisAdmin


@endsection