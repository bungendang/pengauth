<!DOCTYPE html>
<html>
<head>
	<title>{{$title}}</title>
</head>
<body>
 @if(Session::has('pesan'))
  <div class="alert">{{ Session::get('pesan') }}</div>
  @endif    
<h2>Register Form</h2>

{{Form::open(['url' => 'register']) }} 
	<div class="field">
		{{Form::label('username','Username')}}
		{{Form::text('username', '', array('class' => ''))}}
		{{ $errors->first('username') }} 
	</div>
	<div class="field">
		{{Form::label('email', 'Email') }} 
  		{{Form::text('email', '', array('class' => ''))}} 
  		{{ $errors->first('email') }}
	</div>

  	
	<div class="field">
		{{Form::label('password', 'Password') }} 
  		{{Form::password('password', array('class' => ''))}}
  		{{ $errors->first('password') }} 
	</div>
	<button type="submit">Signup</button>
	
{{ Form::close() }}
already signup? just sign in <a href="{{URL::to('login')}}">here</a>

  
  
 
</body>
</html>


      