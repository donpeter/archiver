<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArchive;
use App\Archive;

class ArchiveController extends Controller
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

        $archives = Archive::all();
        /*foreach ($archives as $key => $value) {
            dd($value->name);
        }*/
        
        return view('archives.index',compact('archives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Archive $archive)
    {
        $archives = Archive::all();
       return view('archives.create',compact('archive','archives'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArchive $request)
    {
        Archive::create($request->all());
        return redirect()->route('archive.create');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {
        //
        dd($archive);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        $archives = Archive::all();
        return view('archives.create',compact('archive','archives'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        $archive->update($request->all());
        return $archive;
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Archive $archive)
    {
        $name = $archive->name;
        $archive->delete();

        return response()->json([
            'message'=> $name.' '.__('common.deleted'),
            'title' => __('common.deleted')
            ],200);
    }
}
