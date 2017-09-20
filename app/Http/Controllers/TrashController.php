<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Document; 

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
    public function restoreDocument( $id)
    {
        $document = Document::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $document);
        $document->folder()->restore();
        $document->restore();/*
        foreach ($document->files()->withTrashed()->get() as $file) {//restore all related Files
            $file->restore();
        }*/

        return response()->json([
            'message'=> $document->title.' '.__('common.restored'),
            'title' => __('common.restored')
            ],200);     
    }
}
