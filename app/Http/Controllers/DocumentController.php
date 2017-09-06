<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;


use App\Http\Requests\DocumentRequest;
use App\Http\Requests\DocumentUpddateRequest;
use Carbon\Carbon;
use Storage;


use App\Document;
use App\File;
use App\Organization;
use App\Folder;
use App\User;

use App\Mail\SendDocument;
class DocumentController extends Controller
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
    public function index(Request $request)
    {
        $folders = Folder::all();
        $organizations = Organization::all();
        $users = User::all();
        $documents = Document::orderBy('created_at', 'desc')->get();
        foreach ($documents as $document) {
            $document->parse();
        }
        return view('documents.index', compact('documents','organizations','folders','users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        $folders = Folder::all();
        return view('documents.create', compact('organizations','folders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(documentRequest $request)
    {
        $document = Document::create([
                'ref' => $request->ref,
                'title' => $request->title,
                'desc' => $request->desc,
                'type' => $request->type,
                'user_id' => Auth::id(),
                'folder_id' => $request->folder_id,
                'organization_id' => $request->organization_id,
                'written_on' => $request->written_on,
                'signed_on' => $request->signed_on
            ]); 
        $files = [];
        if($request->hasFile('files')){
            $path= "files/".date('m-y')."/";
            $nums =0;
            foreach ($request->file('files') as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
                $newName = $fileName = $document->title;
                $size = $file->getSize();
                $slug = $path.createSlug($fileName);
                $newSlug = $slug.".{$ext}";
                $num = 0;
                $newName = $fileName.= ($nums)? " {$nums}" : ''; 
                $nums++;

                //Generate a Unique Slug for uploaded file
                while(File::whereSlug($newSlug)->exists()){
                    $num++;
                    $newSlug = $slug."_{$num}.{$ext}";
                }

                //Store the file in the public folder,
                $storageName = substr($newSlug, 12);
                $file->storeAs($path,$storageName);
               $files[] =  File::create([
                        'name' => $newName,
                        'alt' => $fileName,
                        'type' => $file->getMimeType(),
                        'size' => $size,
                        'slug' => $newSlug,
                    ]);
            }
            $document->files()->attach(array_map("static::fileId", $files));
        }
        $documents = Document::orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return response()->json(['data'=>['document' => $document, 'files' => $files]]);
        }else {
            flash(__('common.createdName', ['name' => $document->title]))->success()->important();
            return redirect()->route('document.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $document->parse();
        return response()->json(['data'=>$document],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentUpddateRequest $request, Document $document)
    {
        $files = [];
        if($request->hasFile('files')){
            $path= "files/".date('m-y')."/";
            $nums =0;
            foreach ($request->file('files') as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
                $newName = $fileName = $document->title;
                $size = $file->getSize();
                $slug = $path.createSlug($fileName);
                $newSlug = $slug.".{$ext}";
                $num = 0;
                $newName = $fileName.= ($nums)? " {$nums}" : ''; 
                $nums++;

                //Generate a Unique Slug for uploaded file
                while(File::whereSlug($newSlug)->exists()){
                    $num++;
                    $newSlug = $slug."_{$num}.{$ext}";
                }

                //Store the file in the public folder,
                $storageName = substr($newSlug, 12);
                $file->storeAs($path,$storageName);
               $files[] =  File::create([
                        'name' => $newName,
                        'alt' => $fileName,
                        'type' => $file->getMimeType(),
                        'size' => $size,
                        'slug' => $newSlug,
                    ]);
            }
            $document->files()->attach(array_map("static::fileId", $files));
        }
        $document->update($request->all());
        flash(__('common.updatedName', ['name' => $document->title]))->success()->important();
        return redirect()->route('document.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //return response($document->files);
        //Delete all related Files
        $this->authorize('delete', $document);

        $files=[];
        foreach ($document->files as $file) {
            $files[] = $file->slug;
            $file->delete();
        }
        Storage::delete($files);
        $name = $document->name;

        $document->delete();

        return response()->json([
            'message'=> $name.' '.__('common.deleted'),
            'title' => __('common.deleted')
            ],200);        
    }

    private static function fileId($file)
    {
        return $file->id;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    //API Controlllers to  fetch all Documents
    public function getApi(Request $request)
    {


        $documents = Document::orderBy('created_at', 'desc')->get();
        foreach ($documents as $document ) {
            $document->files = $document->files()->get();
        }
         return response()->json(['data'=>$documents],200);
        
    }
    //API Controlllers to  fetch all Documents
    public function email(Document $document, Request $request)
    {
        $document->files;
        $when = Carbon::now()->addSeconds(5);
        Mail::to($request->to)
            ->cc($request->cc)
            ->send( new SendDocument($document, $request));
        return response()->json(['document'=> $document, 'request' => $request->all()]);
        
    }

}
