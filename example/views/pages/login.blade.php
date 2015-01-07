<!DOCTYPE html>
<html>
<head>
	<title>{{$title}}</title>
</head>
<body>
 @if(Session::has('alert'))
  <div class="alert alert-success">{{ Session::get('alert') }}</div>
  @endif

<h2>Login Form</h2>

{{Form::open(array('action' => 'LoginController@postLogin','class'=>'block')) }} 
	<div class="field">
		{{Form::label('useremail','Username or email')}}
		{{Form::text('useremail', '', array('class' => ''))}}
		{{ $errors->first('username') }} 
	</div>
	<div class="field">
		{{Form::label('password', 'Password') }} 
  		{{Form::password('password', array('class' => ''))}}
  		{{ $errors->first('password') }} 
	</div>
	<button type="submit">Login</button>
	
{{ Form::close() }}

  
 
</body>
</html>


      