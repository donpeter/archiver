<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\User;
use App\Folder;
use App\Organization;

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
        if(!Auth::user()->isStaff()){
            return redirect()->route('user.profile');
        }
        $trash =false;
        $users = User::all();
        //dd($users);

        return view('users.index', compact('users','trash'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        
        return view('users.profile');
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
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->name = ($request->name) ? $request->name :  $user->name;
        if(Auth::user()->isAdmin()){
            $user->role = ($request->role) ? $request->role :  $user->role;
        }
        $user->password = ($request->password) ? bcrypt($request->password) :  $user->password;
        
        $user->save();
        if($request->ajax()){
            $updated = __('common.updated');
            return response()
            ->json([
                'message'=>['title' => $updated.'!', 'desc' => $user->name.' '.__('common.success',['action'=>$updated])],
                'data'=>$user], 200);
        }else {
            if($user->id === Auth::user()->id && isset($request->password) ){
                Auth::logout();
            }
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function documents(User $user)
    {
        $folders = Folder::all();
        $trash = false;
        $users = User::all();
        $organizations = Organization::all();
        $documents = $user->documents;
        return view('documents.index', compact('documents','organizations','folders','users','trash'));
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $trash = true;
        $users = User::onlyTrashed()->orderBy('deleted_at')->get();
        //dd($users);

        return view('users.index', compact('users','trash'));
    
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function getAuthUser()
    {
        if (Auth::check()) {
            return  response()->json(['user' => Auth::user()],200);
        }else {
            return  response()->json(['error' => 'No logged in User found'],400);
        }
    }
}
