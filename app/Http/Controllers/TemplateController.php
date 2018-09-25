<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller {

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function template() {
		return view('template');
	}
}
