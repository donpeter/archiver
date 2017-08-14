<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest;
use Carbon\Carbon;
use Storage;

use App\Document;
use App\File;
use App\Organization;
use App\Archive;
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $archives = Archive::all();
        $organizations = Organization::all();
        $documents = Document::orderBy('created_at', 'desc')->get();
        foreach ($documents as $document ) {
            $document->files = $document->files()->get();
        }
        if($request->ajax()){
            return response()->json($documents,200);
        }else {
            return view('documents.index', compact('documents','organizations'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        return view('documents.create', compact('organizations'));
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
                'sender' => $request->sender,
                'receiver' => $request->receiver,
                'type' => $request->type,
                'prepaired_on' => $request->prepaired_on,
                'signed_on' => $request->signed_on
            ]); 
        $files = [];
        if($request->hasFile('files')){
            $path= "files/".date('m-y')."/";
            foreach ($request->file('files') as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
                $fileName = getFileName($fileName, $ext); //Remove Extension from name
                $size = $file->getSize();
                $slug = $path.createSlug($fileName);
                $newSlug = $slug.".{$ext}";
                $num = 0;

                //Generate a Unique Slug for uploaded file
                while(File::whereSlug($newSlug)->exists()){
                    $num++;
                    $newSlug = $slug."_{$num}.{$ext}";
                }

                //Store the file in the public folder,
                $storageName = substr($newSlug, 12);
                $file->storeAs($path,$storageName);
               $files[] =  File::create([
                        'name' => $fileName,
                        'alt' => $fileName,
                        'type' => $file->getMimeType(),
                        'size' => $size,
                        'slug' => $newSlug,
                    ]);
            }
            $document->files()->attach(array_map("static::fileId", $files));
        }
        return response()->json(['document' => $document, 'files' => $files]);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(documentRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(document $document)
    {
        //
    }

    private static function fileId($file)
    {
        return $file->id;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

}
