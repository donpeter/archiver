<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\File;
use App\Organization;
use App\Folder;
use App\User;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folders = Folder::all();
        $folderCount = Folder::count();
        $organizationCount = Organization::count();
        $documentCount = Document::count();
        $userCount = User::count();
        $documents = Document::orderBy('created_at', 'desc')->take(5)->get();
        foreach ($documents as $document) {
            $document->parse();
        }
        return view('home', compact('documents','folders','folderCount','organizationCount','documentCount','userCount'));
    }
}
