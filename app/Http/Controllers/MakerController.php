<?php namespace App\Http\Controllers;

// setup the autoloading
require_once 'C:\xampp\htdocs\MyOwnAPI\vendor\autoload.php';

// setup Propel
require_once 'C:\xampp\htdocs\MyOwnAPI\generated-conf\config.php';

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
		$makers = MakeQuery::create()->find();
		foreach($makers as $maker){
			echo $maker->getBrandName();
			echo "<br>";
		}
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
		$make = new Make();
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
