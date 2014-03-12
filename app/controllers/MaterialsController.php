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
		$data['pagetitle'] = "List of Material";
        return View::make('materials.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id="")
	{
		if (!User::isAdmin()) {
				return Redirect::to('dashboard');
		}
		$courses = Course::all();
		$data['courses'] = array();
		foreach ($courses as $c) {
			$data['courses'][$c['id']] = $c['name'];
		}
		$data['selected'] = Course::find($id);
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

		$data = new Material;
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
		$data['pagetitle'] = "Edit Material";
		$data['materials'] = Material::find($id);
		$courses = Course::all();
		$data['courses'] = array();
		foreach ($courses as $c) {
			$data['courses'][$c['id']] = $c['name'];
		}
		$data['selected'] = $id;
		return View::make('materials.edit',$data);
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

		$material = Input::all();
		if (!is_null(Input::file('quiz'))) {
			$dest = 'uploads/quiz/';
			$file = 'quiz-'.date('Y-m-d').str_random(8).'.json';
			$ups = Input::file('quiz')->move($dest, $file);
		}else{

		}
		
		$data = Material::find($id);
		$data->name = Input::get('name');
		$data->content = Input::get('content');
		$data->video = Input::get('video');
		$data->quiz = $file;
		$data->course = Input::get('course');

		$level = Material::where('course', '=', Input::get('course'))->max('level');
		if(is_null($level)){$level = 0;}else{$level++;}
		$data->level = $level;

		$data->save();
        return Redirect::to('materials')->with('message', 'Material successfully edited');

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

	public function quizBuilder(){
		$data['pagetitle'] = "Create new Quiz";
		return View::make('materials.quiz', $data);
	}

	public function quizProcess(){
		$data = Input::all();
		$count = Input::get('count');
		$opt = Input::get('opt');
		$json = new StdClass;
		$json->questionList = null;
		$questionList = array();
		$questionItem = new StdClass;
		$questionItem->question = null;
		$questionItem->answerList = null;
		$questionItem->correct = null;
		$answerList = array();
		$answerItem = new StdClass;
		$answerItem->key = null;
		$answerItem->answer = null;
		for ($i=0; $i < $count; $i++) {
			$questionItem = new StdClass;
		$questionItem->question = null;
		$questionItem->answerList = null;
		$questionItem->correct = null;
			$questionItem->question = Input::get('el-'.$i);
			for ($j=0; $j<$opt; $j++) { 
				$answerItem = new StdClass;
				$answerItem->key = null;
				$answerItem->answer = null;
				$answerItem->key = $j+1;
				$test = "op-".$i."-".$j;
				$answerItem->answer = Input::get($test);
				$answerList[$j] = $answerItem;
			}
			
			$questionItem->answerList = $answerList;
			$questionItem->correct = Input::get('ans-'.$i)+1;
			$questionList[] = $questionItem;
			$json->questionList = $questionList;
		}
		$json = json_encode($json);
		$file = 'uploads/temp/'.rand(0,1000).'.json';
		file_put_contents($file, "");
		//$cur = file_get_contents($file);
		$cur = file_get_contents($file);
		$cur = $json;
		file_put_contents($file, $cur);
		return Response::download(public_path().'/'.$file);

	}

}
