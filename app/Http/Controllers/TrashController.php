<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Auth;

use App\Document; 
use App\Folder; 
use App\Organization; 
use App\File; 

class TrashController extends Controller
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
    public function restoreFolder(Request $request, $id)
    {
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $folder);
        $folder->documents()->restore();
        //$folder->documents()->organization()->restore();
        if($folder->restore()){
            $user = Auth::user();
            Log::info("Folder({$folder->id}): {$folder->name} Restored by {$user->username}");
            foreach ($folder->documents as $document) {//restore all related Files
                $document->organization()->restore();
            }
        }
        
        if($request->ajax()){
            return response()->json([
                'message'=> $folder->name.' '.__('common.restored'),
                'title' => __('common.restored')
                ],200);
        }else {
            flash($folder->name.' '.__('common.restored'))->success()->important();
            return redirect()->back();
        }
             
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreOrganization(Request $request, $id)
    {
        $organization = Organization::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $organization);
        $organization->documents()->restore();
        if($organization->restore()){
            $user = Auth::user();
            Log::info("Organization({$organization->id}): {$organization->name} Restored by {$user->username}");
            foreach ($organization->documents as $document) {//restore all related Files
                $document->folder()->restore();
            }
        }
        if($request->ajax()){
            return response()->json([
                'message'=> $organization->name.' '.__('common.restored'),
                'title' => __('common.restored')
                ],200);
        }else {
            flash($organization->name.' '.__('common.restored'))->success()->important();
            return redirect()->back();
        }  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreFile(Request $request, $id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $file);
        $file->restore();
        
        if($request->ajax()){
            return response()->json([
                'message'=> $file->name.' '.__('common.restored'),
                'title' => __('common.restored')
                ],200);
        }else {
            flash($file->name.' '.__('common.restored'))->success()->important();
            return redirect()->back();
        }  

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreDocument(Request $request, $id)
    {
        $document = Document::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $document);
        $document->folder()->restore();
        $document->organization()->restore();
        $document->user()->restore();
        if($document->restore()){
            $user = Auth::user();
            Log::info("Document({$document->id}): {$document->title} Restored by {$user->username}");
        }

        /*
        foreach ($document->files()->withTrashed()->get() as $file) {//restore all related Files
            $file->restore();
        }*/

        if($request->ajax()){
            return response()->json([
                'message'=> $document->title.' '.__('common.restored'),
                'title' => __('common.restored')
                ],200);
        }else {
            flash($document->title.' '.__('common.restored'))->success()->important();
            return redirect()->back();
        }     
    }
}
