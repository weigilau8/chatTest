<?php

namespace App\Http\Controllers;

use App\Models\MstFromTbl;
use App\Models\UserInfoTbl;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class MyPageUserController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function myPageUser() {
		// ユーザ情報
		$userId = Auth::id();
		$userInfo = UserInfoTbl::firstOrCreate(['user_id' => $userId]);
		$mstFrom = MstFromTbl::all();

		return view('mypage_user', compact('userInfo', 'mstFrom'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request) {
		$userId = Auth::id();

		Validator::make($request->all(), [
				'name' => 'required|string|max:255',
				'email' => ['required', 'string', 'email', 'max:255',
						Rule::unique('users')->ignore($userId),
				],
				'password' => 'nullable|min:6|confirmed|required_with:password_confirmation',
				'password_confirmation' => 'required_with:password',
		])->validate();

		$user = Users::find($userId);
		$user->name = $request->name;
		$user->email = $request->email;
		if (!is_null($request->password)) {
			$user->password = bcrypt($request->password);
		}
		$user->save();

		$user_info = UserInfoTbl::firstOrNew(['user_id' => $userId]);
		$user_info->from_id = $request->pref_id;
		$user_info->tel = $request->tel;
		$user_info->line = $request->line;
		$user_info->birth = str_replace('/', '-', $request->birth);
		$user_info->save();

		return redirect('mypage_user');
	}
}
