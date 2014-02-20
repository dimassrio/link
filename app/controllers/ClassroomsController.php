<?php

class ClassroomsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['classes'] = Classroom::all()->sortBy('name');
		$data['teacher'] = array();
		foreach ($data['classes'] as $class) {
			$x = $class->users()->wherePivot('status','=',2)->get()->first();
			array_push($data['teacher'], $x['original']['pivot_user_id']);
		}
        return View::make('classrooms.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$teacher = User::where('level','=',2)->get();
		$arr = array();
		foreach ($teacher as $t) {
			$arr[$t['id']] = $t['realname'];
		}
		$data['teacher'] = $arr;
        return View::make('classrooms.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = new Classroom;
		$data->name = Input::get('name');
		$data->number = 0;
		$data->save();
		$user = User::find(Input::get('teacher'));
		$user->classroom()->attach($data->id,array('status' => 2));
		
		return Redirect::to('classrooms')->with('messages','Classroom saved');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('classrooms.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data['classroom'] = Classroom::find($id);
		$teacher = User::where('level','=',2)->get();
		$arr = array();
		foreach ($teacher as $t) {
			$arr[$t['id']] = $t['realname'];
		}
		$data['teacher'] = $arr;
        return View::make('classrooms.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Classroom::find($id);
		$data->name = Input::get('name');
		$data->number = 0;
		$data->save();
		$teacher = $data->users()->wherePivot('status','=',2)->detach();

		$user = User::find(Input::get('teacher'));
		$user->classroom()->attach($data->id,array('status' => 2));
		
		return Redirect::to('classrooms')->with('messages','Classroom saved');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$classroom = Classroom::find($id);
		$classroom->delete();

		return Redirect::to('classrooms')->with('message', 'The classroom have been successfully deleted');

	}

	public function toggleStatus($id){
		$cl = Classroom::find($id);
		if ($cl->active == 0) {
			$cl->active = 1;
		}else{
			$cl->active = 0;
		}
		$cl->save();

		return Redirect::to('classrooms')->with('message','Classroom '.$cl->name.' have been edited.');
	}

}