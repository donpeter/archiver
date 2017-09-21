<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Auth;
use Mail;
use DateTime;


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
        $trash = false;
        $folders = Folder::all();
        $organizations = Organization::all();
        $users = User::all();
        $documents = Document::orderBy('created_at', 'desc')->get();
        //dd($folders);
        /*foreach ($documents as $document) {
            $organizations[] = $document->organization;
            $folders[] = $document->folder;
        }
        $folders = array_unique($folders);
        $organizations = array_unique($organizations);*/
        //dd($organizations);
        //dd($documents);

        return view('documents.index', compact('documents','organizations','folders','users', 'trash'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::orderBy('name', 'asc')->get();
        $folders = Folder::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        return view('documents.create', compact('organizations','folders','users'));
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
                'user_id' => ($request->user_id) ? $request->user_id : Auth::id(),
                'folder_id' => $request->folder_id,
                'organization_id' => $request->organization_id,
                'written_on' => $request->written_on,
                'signed_on' => $request->signed_on
            ]); 
        $images = [];
        if($request->hasFile('files')){
            /*foreach ($request->file('files') as $file) {
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
            }*/
            foreach ($request->file('files') as $image) {
                $ext = $image->getClientOriginalExtension();
                $date = new DateTime();
                $imgName = $document->title.'_'.$date->getTimestamp();
                $size = $image->getSize();
                $slug = createSlug($imgName).".{$ext}";
                $s3 = Storage::disk('s3');
                if($s3->put($slug, file_get_contents($image), 'public')){
                    $images[] =  File::create([
                        'name' => $imgName,
                        'alt' => $imgName,
                        'type' => $image->getMimeType(),
                        'size' => $size,
                        'slug' => $slug,
                    ]);
                }
            }

            $document->files()->attach(array_map("static::fileId", $images));
            $user = Auth::user();
            Log::info("Document({$document->id}): {$document->title} Created by {$user->username}");
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
    public function show(Document $document, Request $request)
    {
        if($request->ajax()){
            $document->parse();

            return response()->json(['data'=>$document],200);
        }else {
            flash(__('common.error').': Docucment was not be updated')->success()->important();
            return redirect()->back();
        }
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
        $images = [];

        if($request->hasFile('files')){

            /*$path= "files/".date('m-y')."/";
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
            }*/
            foreach ($request->file('files') as $image) {
                $ext = $image->getClientOriginalExtension();
                $date = new DateTime();
                $imgName = $document->title.'_'.$date->getTimestamp();
                $size = $image->getSize();
                $slug = createSlug($imgName).".{$ext}";
                $s3 = Storage::disk('s3');
                if($s3->put($slug, file_get_contents($image), 'public')){
                    $images[] =  File::create([
                        'name' => $imgName,
                        'alt' => $imgName,
                        'type' => $image->getMimeType(),
                        'size' => $size,
                        'slug' => $slug,
                    ]);
                }
            }
            $document->files()->attach(array_map("static::fileId", $images));
        }
        $document->update($request->all());
        $user = Auth::user();
        Log::info("Document({$document->id}): {$document->title} Updated by {$user->username}");
        flash(__('common.updatedName', ['name' => $document->title]))->success()->important();
        return redirect()->route('document.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document, Request $request)
    {
        $this->authorize('delete', $document);

        /*foreach ($document->files as $file) {//Delete all related Files
            //Keeps  all Files Only Soft Delete 
            if(Storage::disk('s3')->exists($file->slug)) {
                Storage::disk('s3')->delete($file->slug);
            }
            $file->delete();
        }*/
        $title = $document->title;
        $id = $document->id;
        if($document->delete()){
            $user = Auth::user();
            Log::info("Document({$id}): {$title} Restored by {$user->username}");
        }

        return response()->json([
            'message'=> $title.' '.__('common.deleted'),
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
        $folders = Folder::withTrashed()->orderBy('name', 'asc')->get();
        $organizations = Organization::withTrashed()->orderBy('name', 'asc')->get();
        $users = User::all();
        $documents = Document::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        // foreach ($documents as $document) {
        //     $organizations[] = $document->organization;
        //     $folders[] = $document->folder;
        // }
        // $folders = array_unique($folders);
        // $organizations = array_unique($organizations);
        //dd($organizations);
        //dd($documents);

        return view('documents.index', compact('documents','organizations','folders','users', 'trash'));
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
