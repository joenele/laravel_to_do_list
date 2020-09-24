<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>To-Do List Built with PHP Laravel</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <div class="container">


    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <p>Logged in as <b>{{ Auth::user()->name }}</b> <button type="submit" class="waves-effect waves-light btn">Logout</button></p>
    </form>

    @isAdmin
    @if($invitations->count()>0)
    <ul class="collapsible">
      <li>
        <div class="collapsible-header">
          <i class="material-icons">person_add</i>
          Invitations
          <span class="new badge orange">{{ $invitations->count() }}</span></div>
        <div class="collapsible-body">
          @foreach($invitations as $invitation)
          <p>
            <span class="red-text"><b>{{  $invitation->worker->name }}</b></span>
            <a href="{{ route('acceptInvitation',['id'=>$invitation->id]) }}">accept</a> | <a href="{{ route('denyInvitation',['id'=>$invitation->id]) }}">deny</a>
          </p>
          @endforeach
        </div>
      </li>
    </ul>
    @endif
    @endisAdmin

    <h1 class="center-align teal-text text-lighten-2"> To-do List</h1>

    @yield('content')

  </div>
  


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
      // Accordion expand effect
     document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });

 // Drop down List in form
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('select').formSelect();
  });
  </script>

  </body>
</html>