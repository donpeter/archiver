<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFolderRequest;
use App\Folder;
use App\Organization;

class FolderController extends Controller
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

        $folders = Folder::all();
        /*foreach ($folders as $key => $value) {
            dd($value->name);
        }*/
        
        return view('folders.index',compact('folders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Folder $folder)
    {
        $folders = Folder::all();
       return view('folders.create',compact('folder','folders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFolderRequest $request)
    {
        Folder::create($request->all());
        return redirect()->route('folder.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        $folders = Folder::all();
        $organizations = Organization::all();
        $documents = $folder->documents;
        return view('documents.index', compact('documents','organizations','folders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {

        $folders = Folder::all();
        return view('folders.create',compact('folder','folders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        $folder->update(['ref' => $folder->ref,'desc'=>$request->desc, 'name' => $request->name]);
        return $folder;
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Folder $folder)
    {
        $name = $folder->name;
        $folder->delete();

        return response()->json([
            'message'=> $name.' '.__('common.deleted'),
            'title' => __('common.deleted')
            ],200);
    }


    
}
