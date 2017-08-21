<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateUserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        //dd($users);

        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //return $request->all();
        $user = User::make($request->all());
        $user->password = bcrypt($user->password);
        $user->save();
        if($request->ajax()){
            return response()->json(['message'=>['title' => __('created').'!', 'desc' =>'User Created Succesfully'],'user'=>$user], 200);
        }else {
            return redirect()->route('user.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        if($request->ajax()){
            $updated = __('common.updated');
            return response()
            ->json([
                'message'=>['title' => $updated.'!', 'desc' => $user->name.' '.__('common.success',['action'=>$updated])],
                'data'=>$user], 200);
        }else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();

        return response()->json([
            'message'=> $name.' '.__('common.deleted'),
            'title' => __('common.deleted')
            ],200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
