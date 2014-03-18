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
		$courses = Course::orderBy('name')->get();
		$data['courses'] = array();
		foreach ($courses as $c) {
			$data['courses'][$c['id']] = $c['name'];
		}
		$selected = Course::find($id);
		$data['selected'] = $selected['id'];

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
		$data = new Material;
		if (!is_null(Input::file('quiz'))) {
			$file = 'quiz-'.date('Y-m-d').str_random(8).'.json';
			$ups = Input::file('quiz')->move($dest, $file);	
			$data->quiz = $file;
		}else{
			$data->quiz = "";
		}
		
		$data->name = Input::get('name');
		$data->content = Input::get('content');
		$data->video = Input::get('video');
		$level = Material::where('course', '=', Input::get('course'))->max('level');
		if(is_null($level)){
			$level = 0;
		}else{
			$level++;
		}
		$data->level = $level;
		$data->course = Input::get('course');
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
		$courses = Course::orderBy('name')->get();
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
		/*Updatin New information*/
		$material = Input::all();
		$data = Material::find($id);
		$dest = 'uploads/quiz/';
		if (!is_null(Input::file('quiz'))) {
			$file = 'quiz-'.date('Y-m-d').str_random(8).'.json';
			$ups = Input::file('quiz')->move($dest, $file);
			$data->quiz = $file;
		}else{
			$data->quiz = "";
		}
		$data->name = Input::get('name');
		$data->content = Input::get('content');
		$data->video = Input::get('video');
		$cour = $data->course;
		$data->course = Input::get('course');
		$data->level = null;
		$data->save();
		/*Updating Old Courses*/
		$ncour = $data->course;
		$oldcourse = Material::where('course', '=', $cour)->orderBy('level')->get();
		for ($i=0; $i < sizeof($oldcourse); $i++) {
			$mat = null;
			$mat = $oldcourse[$i];
			$mat->level = $i;
			$mat->save();
			var_dump($mat->name."-".$mat->level);
		}
		/*Updating New Courses*/
		$level = Material::where('course', '=', Input::get('course'))->max('level');
		if(is_null($level)){$level = 0;}else{$level++;}
		$data->level = $level;
		$data->save();

		$newcourse = Material::where('course', '=', $ncour)->orderBy('level')->get();
		for ($i=0; $i < sizeof($newcourse) ; $i++) { 
			$nmat = null;
			$nmat = $newcourse[$i];
			$nmat->level = $i;
			$nmat->save();
		}

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

		$material = Material::find($id);
		$course = $material->course;
		$material->delete();

		$courseList = Material::where('course','=', $course)->orderBy()->get();

		for ($i=0; $i < sizeof($courseList); $i++) { 
			$mat = $courseList[$i];
			$mat->level = $i;
			$mat->save();
		}

		return Redirect::to('users')->with('materials', 'Material have been successfully deleted');
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

	public function getOrder($idc){
		$material = Material::where('course', '=', $idc)->get();
		$max = Material::where('course', '=', $idc)->max('level');
		$data = array();
		if(is_null($max)){
			$order = new StdClass();
			$order->id = null;
			$order->label = null;

			$order->id = 0;
			$order->label = "Empty";

			array_push($data, $order);
		}else{
			for ($i=0; $i <=$max+1 ; $i++) { 
				$count = 0;
				$hold = null;
				foreach ($material as $m) {
					if($i == $m['attributes']['level']){
						$count++;
						$hold = $m;
					}
				}
				$order = new StdClass();
				$order->id = null;
				$order->label = null;
				if ($count>0) {	
					$order->id = $i;
					$order->label = $hold['attributes']['name'];
					array_push($data, $order);
				}else{
					
					$order->id = $i;
					$order->label = "Empty";
					$data[$i] = $order;
				}

			}
		}

		$data = json_encode($data);
		
		return Response::json($data);
	}

	public function postOrder(){
		$neworder = Input::get('neworder');

		for ($i=0; $i < sizeof($neworder); $i++) { 
			$material = Material::find($neworder[$i]);
			$material->level = $i;
			var_dump($material);
			$material->save();
		}
	}

}
