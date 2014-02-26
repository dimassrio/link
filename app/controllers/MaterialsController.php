<?php

class MaterialsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (!User::isAdmin()) {
				return Redirect::to('dashboard');
		}

		$data['courses'] = Course::all();
		$data['materials'] = Material::all();
        return View::make('materials.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (!User::isAdmin()) {
				return Redirect::to('dashboard');
		}

		$data['courses'] = Course::all();
        return View::make('materials.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		if (!User::isAdmin()) {
				return Redirect::to('dashboard');
		}

		$material = Input::all();
		$dest = 'uploads/quiz/';
		$file = 'quiz-'.date('Y-m-d').str_random(8).'.json';
		$ups = Input::file('quiz')->move($dest, $file);

		$data = new Material();
		$data->name = Input::get('name');
		$data->content = Input::get('content');
		$data->video = Input::get('video');
		$data->quiz = $file;
		$data->course = Input::get('course');

		$level = Material::where('course', '=', Input::get('course'))->max('level');
		if(is_null($level)){$level = 0;}else{$level++;}
		$data->level = $level;

		$data->save();
		return Redirect::to('materials')->with('message', 'New Material added.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('materials.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (!User::isAdmin()) {
				return Redirect::to('dashboard');
		}

        return View::make('materials.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (!User::isAdmin()) {
				return Redirect::to('dashboard');
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
		if (!User::isAdmin()) {
				return Redirect::to('dashboard');
		}
	}

}
