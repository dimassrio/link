<?php

class CoursesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$course = Course::all();
		$data['pagetitle'] = "List of registered course.";
		
		$data['courses'] = $course;
        return View::make('courses.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['pagetitle'] = "Create new Course.";
        return Response::view('courses.create', $data)->header('Cache-Control', 'no-store, no-cache, must-revalidate');;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//var_dump(Input::file('picture')->getClientOriginalName());
		$course = Input::all();
		$dest = 'uploads/';
		$file = date('dmY').str_random(8).Input::file('picture')->getClientOriginalName();
		$ups = Input::file('picture')->move($dest, $file);

		$data = new Course;
		$data->name = Input::get('name');
		$data->description = Input::get('description');
		$data->info = Input::get('info');
		$data->start = Input::get('start');
		$data->end = Input::get('end');
		$data->author = Input::get('author');
		$data->picture = $file;

		$data->save();

		return Redirect::to('courses')->with('message', 'New course added, please input the material needed.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data['courses'] = Course::find($id);
		$data['pagetitle'] = $data['courses']['name'];
        return View::make('courses.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('courses.edit');
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
		$course = Course::find($id);
		$course->delete();

		return Redirect::to('courses')->with('message', 'Course deleted.');
	}

	public function selectCourses()
	{
		$date = date('Y-m-d');
		$data['courses'] = Course::where('start','<',$date)->where('end', '>', $date)->get();
		$data['pagetitle'] = "Select Course";
		return Response::view('select', $data)->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	}
	private function getFirstCourseMaterial($id){
		$material = Material::where('course', '=', $id)->where('level', '=', '1')->get();
		return $material->id;
	}
	public function selectChosenCourses($id)
	{
		$date = date('Y-m-d');
		$user = Auth::user();
		$course = Course::find($id);
		$tc = sizeof($user->course()->where('user_id', '=', $user['id'])->where('course_id', '=', $id)->get());
		$material = Material::where('course','=', $id)->get();		
		if($tc == 0){
			$user->course()->attach($id, array('current'=>0));
			$material = Material::where('course','=', $id)->get();
			foreach ($material as $m) {
				$tm = sizeof($user->material()->where('user_id', '=', $user['id'])->where('material_id', '=', $m['id'])->get());
				if($tm == 0){
					$user->material()->attach($m['id'], array('value'=>0, 'chance'=>2));	
				}
			}
			return Redirect::to('dashboard')->with('message', 'You have register for Course '.$course->name);
		}else{
			return Redirect::to('dashboard')->with('message', 'You have been registered for this Course before.'.$course->name);
		}
		
		
	}
	public function enableCourse($id)
	{
		$course = Course::find($id);
		$course->active = 1;
		$course->save();

		return Redirect::to('courses')->with('message', 'Course Enabled');
	}
	public function disableCourse($id)
	{
		$course = Course::find($id);
		$course->active = 0;
		$course->save();

		return Redirect::to('dashboard')->with('message', 'Course disabled');
	}

	public function showMaterial($idc, $idm = null){
		$user = Auth::user();
		$mq = $user->material()->wherePivot('material_id', '=', $idm)->get();
		
		$data['qc'] = $mq->first();
		$data['qc'] = $data['qc']['original']['pivot_chance'];
		$data['qr'] = $mq->first();
		$data['qr'] = $data['qr']['original']['pivot_value'];
		$data['cur'] = $user->course()->wherePivot('course_id', '=', $idc)->get()->first();
		$data['cur']= $data['cur']['original']['pivot_current'];
		$data['courses'] = Course::find($idc);
		$data['list'] = Material::where('course', '=', $idc)->orderBy('level')->get();
		if(is_null($idm)){
			$material = Material::where('course','=', $idc)->where('level', '=', $data['cur'])->get()->first();
			if (is_null($material)) {
				$material = Material::where('course','=', $idc)->where('level', '=', 0)->get()->first();
			}

			$url = 'courses/'.$idc.'/material/'.$material['id'];
			return Redirect::to($url);
		}else{
			$material = Material::find($idm);
		}
		foreach ($user->material as $mat) {
			if($mat['original']['pivot_material_id'] == $material['id']){
				$mat->pivot->access = date('Y-m-d');
				$mat->pivot->save();
			}
		}
		$data['material'] = $material;
		$data['pagetitle'] = $material['name'];
		return Response::view('courses.materials', $data)->header('Cache-Control', 'no-store, no-cache, must-revalidate');

	}

	public function showResult($idc){
		$data['courses'] = Course::find($idc);
		$data['materials'] = Material::where('course','=',$idc)->get();
		$data['value'] = array();
		$user = Auth::user();
		foreach ($data['materials'] as $m) {
			$val = $user->material()->wherePivot('material_id', '=', $m['id'])->get()->first();
			$val = $val['original']['pivot_value'];
			
			array_push($data['value'], $val);
		}

		$data['pagetitle'] = "Result of ".$data['courses']['name']." Courses";
		return View::make('courses.result', $data);
	}

	public function showQuiz($idc, $idm){
		$user = Auth::user();

		$m = $user->material()->wherePivot('material_id','=',$idm)->get()->first();
		$m = $m['original']['pivot_chance'];

		if ($m>0) {
				$courses = Course::find($idc);
			$material = Material::find($idm);

			$file = File::get('quiz/'.$material->quiz);
			$json = json_decode($file);

			$ql = (array) $json->questionlist;
			shuffle($ql);

			$data['courses'] = $courses;

			$data['material'] = $material;
			$data['pagetitle'] = "Quiz of ".$material['name'];
			$data['qlist'] = $ql;
			
			Session::put('list', $ql);
			return Response::view('courses.quiz', $data)->header('Cache-Control', 'no-store, no-cache, must-revalidate');
		}else{
			return Redirect::to('courses/'.$idc.'/material/'.$idm)->with('message','You have no more chance to take quiz.');
		}

	
	}
/**
 * [validateQuiz description]
 * @param  [type] $idc [description]
 * @param  [type] $idm [description]
 * @return [type]      [description]
 */
	public function validateQuiz($idc, $idm){
		$user = Auth::user();
		$ql = Session::get('list');

		$x = sizeof($ql);
		$data = Input::all();
		// Validating Quiz
		$value = 0;
		for ($i=0; $i < $x ; $i++) { 
			$j = $i+1;
			if($data['item_'.$j][0]==$ql[$i]->correct){
				$value++;
			}
		}

		$data['value'] = $value;
		// Decrementing Chance
		foreach ($user->material as $mat) {
			if($mat['original']['pivot_material_id'] == $idm){
				$mat->pivot->value = $value;
				if($mat->pivot->chance > 0){
					$mat->pivot->chance = $mat->pivot->chance-1;
				}
				$mat->pivot->save();
			}
		}
		// Incrementing Material Level
		foreach ($user->course as $course) {
			if($course['original']['pivot_course_id'] == $idc){
				$x = $course->pivot->current + 1;
				$mate = Material::where('course','=',$idc)->where('level','=', $x)->get()->first();
				$count = 0;
				foreach ($user->material as $mat) {
					if($mat['original']['pivot_material_id'] == $mate['id']){
						if($mat['original']['pivot_value']==0){
							$course->pivot->current = $course->pivot->current + 1;
							$course->pivot->save();	
						}
					}else{
						$count++;
						if(sizeof($user->material)==$count){
							$course->pivot->current = $course->pivot->current + 1;
							$course->pivot->save();		
						}
						
					}
				}
				
				
			}
		}
		$material = Material::find($idm);

		return Redirect::to('courses/'.$idc.'/result')->with('message', 'You have finished material '.$material['name'])->header('Cache-Control', 'no-store, no-cache, must-revalidate');

	}

	/**
	 * [nextMaterial description]
	 * @param  [type] $idm [description]
	 * @param  [type] $idc [description]
	 * @return [type]      [description]
	 */
	public function nextMaterial($idc, $idm)
	{
		$course = Course::find($idm);
		$material = Material::find($idc);
		$user = Auth::user();
		// Check if Material have quiz or not
		if(!$material->quiz == ""){
			return Redirect::to('courses/'.$idc.'/material/'.$idm)->with('message'. 'This operation is not allowed');
		}else{

			foreach ($user->material as $mat) {
				if($mat['original']['pivot_material_id'] == $idm){
					$mat->pivot->value = 0;
					if($mat->pivot->chance > 0){
						$mat->pivot->chance = 0;
					}
					$mat->pivot->save();
				}
			}

			foreach ($user->course as $course) {
				if($course['original']['pivot_course_id'] == $idc){
					$x = $course->pivot->current + 1;
					$mate = Material::where('course','=',$idc)->where('level','=', $x)->get()->first();
					$count = 0;
					foreach ($user->material as $mat) {
						if($mat['original']['pivot_material_id'] == $mate['id']){
							if($mat['original']['pivot_value']==0){
								$course->pivot->current = $course->pivot->current + 1;
								$course->pivot->save();	
							}
						}else{
							$count++;
							if(sizeof($user->material)==$count){
								$course->pivot->current = $course->pivot->current + 1;
								$course->pivot->save();		
							}
							
						}
					}
				}
			}
			

			return Redirect::to('courses/'.$idc.'/result')->with('message', 'You have finished material '.$material['name'])->header('Cache-Control', 'no-store, no-cache, must-revalidate');
		}
	}

	/**
	 * [createPdf description]
	 * @param  [type] $idc [description]
	 * @return [type]      [description]
	 */
	public function createPdf($idc){
		$data['user'] = Auth::user();
		$data['courses'] = Course::find($idc);
		$data['materials'] = Material::where('course','=',$idc)->get();
		$data['value'] = array();
		$user = Auth::user();
		foreach ($data['materials'] as $m) {
			$val = $user->material()->wherePivot('material_id', '=', $m['id'])->get()->first();
			$val = $val['original']['pivot_value'];
			
			array_push($data['value'], $val);
		}
		$html = View::make('pdf', $data);
    	return PDF::load($html, 'A4', 'portrait')->show();
	}

}
