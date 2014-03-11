<?php

class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::isTeacher()){
			return Redirect::to('dashboard');
		}else{
			if (User::isAdmin()||User::isKoordinator()) {
				$data['users'] = User::all();
			}elseif(User::isTeacher()){
				$classroom = Classroom::find(Auth::user()->classroom->first()->id);//Auth::user()->classroom->first()->id);
				$data['users'] = $classroom->users;
			}
        	return View::make('users.index', $data);
    	}
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
				'classroom' => Input::get('classroom'),
				'phone' => Input::get('phone')
				),
			array(
				'username' => 'required|unique:users|min:6',
				'password' => 'required|min:6',
				'nim' => 'required|unique:users|numeric',
				'email' => 'required|email',
				'classroom' => 'required',
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
			
			$user->phone = Input::get('phone');
			$user->level = 3;	

			$user->save();
			
			$user->classroom()->attach(Input::get('classroom'), array('status'=> 3));
			
			$classroom = Classroom::find(Input::get('classroom'));
			$classroom->number = $classroom->number + 1;
			$classroom->save();
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
		if(!Auth::check()){
			return Redirect::to('/');
		}

		if (!User::isTeacher()) {
			if($id != Auth::user()->id){
				return Redirect::to('dashboard');
			}
		}

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
		if (!User::isTeacher()) {
			if($id != Auth::user()->id){
				return Redirect::to('dashboard');
			}
		}
		$validator = Validator::make(
			array(
				'nim' => Input::get('nim'),
				'email' => Input::get('email'),
				'realname' => Input::get('realname'),
				'class' => Input::get('classroom'),
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
			$user->phone = Input::get('phone');

			$user->save();
			$cid = $user->classroom->first();
			$cid = $cid["original"]["id"];
			
			$classroom = Classroom::find($cid);			

			$classroom->number = $classroom->number - 1;
			$classroom->save();


			$user->classroom()->detach();
			$user->classroom()->attach(Input::get('classroom'), array('status'=> 3));

			$class = Classroom::find(Input::get('classroom'));
			$class->number = $class->number + 1;
			$class->save();

			return Redirect::to('dashboard')->with('message', 'Edit process completed.');
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

		if (!User::isAdmin()) {
				return Redirect::to('dashboard');
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
		return Response::view('users.show-reset');
	}

	public function processReset(){
		$id = User::getIdFromNim(Input::get('nim'));
		$wild = "313j12h3k12312".rand(0,100)."1023u1k23n1mn23".date('dmy');
		$token = Hash::make($wild);
		if(is_null($id)){
			return Redirect::to('reset')->with('message','Maaf NIM yang anda maksud tidak terdaftar dalam database kami.');
		}else{
			$user = User::find($id);
			
			if($user->email == Input::get('email')){
				DB::table('reset')->insert(array('user_id'=> $id, 'value'=>$token));
				$data['url'] = "http://kusmayanti.net/reset/"+$id+'/confirmation/'+$token;
				$data['user'] = $user;
				Mail::send('resetmail', $data, function($message) use($user){
	    			$message->to( $user->email, $user->realname)->subject('Online Language Center Reset Password');
				});	
			}else{
				return Redirect::to('/')->with('message', 'Maaf email yang anda kirimkan salah.');
			}	
			return Redirect::to('/')->with('message', 'Password baru anda telah kami kirimkan.');
		}
	}

	public function completeReset(){

	}
	public function init_evaluation(){
		if(!User::isTeacher()){
			return Redirect::to('dashboard');
		}else{
			$data['classroom'] = array();
			if(User::isKoordinator()){
				$classroom = Classroom::all();
				foreach ($classroom as $c) {
				$data['classroom'][$c->id] = $c->name;
			}
			}else{
				$classroom = Classroom::find(Auth::user()->classroom->first()->id);
				$classroom = $classroom['original'];

				$data['classroom'][$classroom['id']] = $classroom['name'];
			}
			$course = Course::all();
			
			$data['course'] = array();
			
			foreach ($course as $c) {
				$data['course'][$c->id] = $c->name;
			}
		}
		return Response::view('evaluation', $data);
	}
	public function evaluation()
	{
		if(!User::isTeacher()){
			return Redirect::to('dashboard');
		}else{
			/*Process Classroom*/
			$data['classroom'] = array();
			if(User::isKoordinator()){
				$classroom = Classroom::all();
				foreach ($classroom as $c) {
				$data['classroom'][$c->id] = $c->name;
			}
			}else{
				$classroom = Classroom::find(Auth::user()->classroom->first()->id);
				$classroom = $classroom['original'];

				$data['classroom'][$classroom['id']] = $classroom['name'];
			}
			/*Proces Course*/
			$course = Course::all();
			$data['course'] = array();
			foreach ($course as $c) {
				$data['course'][$c->id] = $c->name;
			}
			/*Process Users*/
			$class = Classroom::find(Input::get('classroom'));//
			$data['users'] = $class->userd;
			$material = Material::where('course', Input::get('course'))->get()->lists('id');
			$value = array();
			foreach ($data['users'] as $u) {
				foreach ($material as $m) {
					$o = DB::table('material_user')->where('user_id', $u['attributes']['id'])->where('material_id',$m)->get();
					$obj = array();
					$obj['nim'] = $u['attributes']['nim'];
					$obj['name'] = $u['attributes']['realname'];
					$obj["id"] = 0;
					$obj["user_id"] = 0;
					$obj["material_id"] = 0;
					$obj['value'] = 0;
					$obj['access'] = 0;
					if (count($o)==1) {
						$obj["id"] = $o[0]->id;
						$obj["user_id"] = $o[0]->user_id;
						$obj["material_id"] = $o[0]->material_id;
						$obj['value'] = $o[0]->value;
						$obj['access'] = date('d-M-Y', strtotime($o[0]->access));
					}
					array_push($value, $obj);
				}
			}
			
		}
		$data['users'] = $value;
		return Response::view('evaluation', $data);
	}

	public function teacherIndex(){
		$user = Auth::user();
		$data['classroom'] = Classroom::where('teacher','=',$user->id)->get();
		
		return Response::view('users.teacher-index', $data);
	}

	public function editPassword(){
		if(!Auth::check()){
			return Redirect::to('/');
		}
		$validator = Validator::make(
			array(
				'passwordold' => Input::get('passwordold'),
				'passwordnew' => Input::get('passwordnew'),
				'passwordnew_confirmation' => Input::get('passwordnew_confirmation')
				),	
			array(
				'passwordold' => 'required',
				'passwordnew' => 'required|confirmed',
				'passwordnew_confirmation' => 'required'
			)
		);
		$user = Auth::user();
		$id = $user->id;
		if($validator->passes()){

			if($user->password = Hash::make(Input::get('passwordold'))){
				$user->password = Hash::make(Input::get('passwordnew'));
				$user->save();
			}else{
				return Redirect::to('users/'.$id.'/edit')->with('message', 'Your current password is incorrect.');
			}

			return Redirect::to('dashboard')->with('message', 'Edit process completed.');
		}else{
			return Redirect::to('users/'.$id.'/edit')->withErrors($validator);
		}
	}

	public function showChangePassword($id, $token){
		$reset = DB::table('reset')->where('user_id',$id)->where('value', $token)->first();
		if($reset!=null){
			echo 'next';
		}else{
			echo 'fail';
		}
	}
}
