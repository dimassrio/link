<?php

class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['users'] = User::all();
        return View::make('users.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check()){
			return Redirect::to('dashboard');
		}
		
		$classes = Classroom::where('active','=',1)->get();
		$data['classes'] = array();
		foreach ($classes as $c) {
			$data['classes'][$c['id']] = $c['name'];
		}

        return View::make('users.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::check()){
			return Redirect::to('dashboard');
		}
		$validator = Validator::make(
			array(
				'username' => Input::get('username'),
				'password' => Input::get('password'),
				'nim' => Input::get('nim'),
				'email' => Input::get('email'),
				'realname' => Input::get('realname'),
				'class' => Input::get('class'),
				'phone' => Input::get('phone')
				),
			array(
				'username' => 'required|unique:users|min:6',
				'password' => 'required|min:6',
				'nim' => 'required|unique:users|numeric',
				'email' => 'required|email',
				'class' => 'required',
				'realname' =>'required',
				'phone' =>'required|numeric'
			)
		);

		if($validator->passes()){
			$user = new User;
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->nim = Input::get('nim');
			$user->email = Input::get('email');
			$user->realname = Input::get('realname');
			$user->classroom()->attach(Input::get('classroom'));
			$user->phone = Input::get('phone');
			$user->level = 3;	

			$user->save();

			$classroom = Classroom::find(Input::get('class'));

			$classroom->number = $classroom->number + 1;

			return Redirect::to('/')->with('message', 'Thanks for registering, please login to enter the dashboard');
		}else{
			return Redirect::to('users/create')->withErrors($validator);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data['user'] = User::find($id);
		$classes = Classroom::where('active','=',1)->get();
		$data['classes'] = array();
		foreach ($classes as $c) {
			$data['classes'][$c['id']] = $c['name'];
		}
        return View::make('users.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!Auth::check()){
			return Redirect::to('/');
		}
		$validator = Validator::make(
			array(
				'nim' => Input::get('nim'),
				'email' => Input::get('email'),
				'realname' => Input::get('realname'),
				'class' => Input::get('class'),
				'phone' => Input::get('phone')
				),	
			array(
				'nim' => 'required|numeric',
				'email' => 'required|email',
				'class' => 'required',
				'realname' =>'required',
				'phone' =>'required|numeric'
			)
		);

		if($validator->passes()){
			$user = User::find($id);
			$user->nim = Input::get('nim');
			$user->email = Input::get('email');
			$user->realname = Input::get('realname');
			$user->classroom = Input::get('class');
			$user->phone = Input::get('phone');

			$user->save();

			$classroom = Classroom::find($user->classroom);
			$classroom->number = $classroom->number - 1;
			$classroom->save();

			$class = Classroom::find(Input::get('class'));
			$class->number = $class->number + 1;
			$class->save();

			return Redirect::to('dashboard')->with('message', 'Thanks for registering, please login to enter the dashboard');
		}else{
			return Redirect::to('users/'.$id.'/edit')->withErrors($validator);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!Auth::check()){
			return Redirect::to('/');
		}

		$user = User::find($id);
		$user->delete();

		return Redirect::to('users')->with('message', 'User have been successfully deleted');
	}

	public function login()
	{
		if(Input::get('remember') == 1){
			if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')), true)) {
				return Redirect::to('dashboard')->with('message', 'You are logged in.');
			}else{
				return Redirect::to('/')->with('message', 'Your username/password is incorrect.');
			}
		}else{
			if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')), true)) {
				return Redirect::to('dashboard')->with('message', 'You are logged in.');
			}else{
				return Redirect::to('/')->with('message', 'Your username/password is incorrect.');
			}	
		}
		
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function goToDashboard()
	{
		$data['course'] = Course::all();
		return View::make('dashboard', $data);
	}

	public function showReset()
	{

	}

	public function processReset(){

	}

	public function completeReset(){

	}

	public function evaluation()
	{
		return Response::view('evaluation');

	}

	public function teacherIndex(){
		$user = Auth::user();
		$data['classroom'] = Classroom::where('teacher','=',$user->id)->get();
		
		return Response::view('users.teacher-index', $data);
	}
}
