<?php

class ClassroomsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['classes'] = Classroom::all();
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
		$data->teacher = Input::get('teacher');
		$data->number = 0;
		$data->save();

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
        return View::make('classrooms.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
