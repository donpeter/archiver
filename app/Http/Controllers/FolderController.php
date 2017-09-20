<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFolderRequest;
use App\Folder;
use App\Organization;
use App\User;

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
        $trash = false;

        $folders = Folder::all();
        /*foreach ($folders as $key => $value) {
            dd($value->name);
        }*/
        
        return view('folders.index',compact('folders','trash'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $trash = true;

        $folders = Folder::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        /*foreach ($folders as $key => $value) {
            dd($value->name);
        }*/
        
        return view('folders.index',compact('folders','trash'));
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
        $folder = Folder::create($request->all());
        $name = $request->input('name');
        if($request->ajax()){
            return response()->json(['message'=>['title' => __('created').'!', 'desc' => $name.' Created Succesfully'],'folder'=> $folder], 200);
        }else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        $trash = false;
        $folders = [];
        $organizations = [];
        $users = User::all();
        $documents = $folder->documents;
        foreach ($documents as $document) {
            $organizations[] = $document->organization;
            $folders[] = $document->folder;
        }
        return view('documents.index', compact('documents','organizations','folders','users','trash'));
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
        $this->authorize('delete', $folder);

        $name = $folder->name;
        /*foreach ($document->files as $file) {//Delete all related Files
            //Keeps  all Files Only Soft Delete 
            if(Storage::disk('s3')->exists($file->slug)) {
                Storage::disk('s3')->delete($file->slug);
            }
            $file->delete();
        }*/
        $folder->documents()->delete();

        $folder->delete();

        return response()->json([
            'message'=> $name.' '.__('common.deleted'),
            'title' => __('common.deleted')
            ],200);
    }


    
}
