<?php namespace App\Http\Controllers;


require_once $_SERVER["DOCUMENT_ROOT"].'\..\propel_init.php';


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Anand\Make;
use Anand\MakeQuery;
use Propel\Runtime\ActiveQuery\Criteria;

use Illuminate\Http\Request;

class MakerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$makers = MakeQuery::create()->find()->toArray();
		return response()->json(['data'=>$makers], 404);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$makers = MakeQuery::create()->findPK($id);
		if(!$makers){
			return response()->json(['message'=>'This maker doesnot exist', 'code'=>404], 404);
		}
		$vehicles = $makers->getVehicles()->toArray();

		//return response($vehicles->toJson());

		return response()->json(['data'=>$vehicles], 200);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
