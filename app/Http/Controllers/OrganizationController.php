<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use Auth;

use App\Http\Requests\OrganizationRequest;
use App\Organization;
use App\Folder;

class OrganizationController extends Controller
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
        $trash = false;
        return view('organizations.index', compact('folders','organizations','trash')); 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $organizations = Organization::onlyTrashed()->orderBy('deleted_at', 'desc')->get();;
        $trash = true;
        return view('organizations.index', compact('organizations','trash')); 
    }

    public function getAllApi()
    {
        $organizations = Organization::all();
        $organizations = $this->parser($organizations);
        return response()->json( $organizations);
    }

    /**
     * Display the specified resource.
     *
     * @param  Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        $folders = Folder::all();
        $organizations = Organization::all();
        $documents = $organization->documents;
        return view('documents.index', compact('documents','organizations','folders'));
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $folders = Folder::all();
        $organizations = Organization::all();
        return view('organizations.create', compact('folders','organizations'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
         $organization = [Organization::create($request->all())];
         $organization = $this->parser($organization)[0];
        $name = $request->input('name');
        $user = Auth::user();
        Log::info("Organization({$organization->id}): {$organization->name} Craeted by {$user->username}");
        if($request->ajax()){
            return response()->json(['message'=>['title' => __('created').'!', 'desc' => $name.' Created Succesfully'],'organization'=>$organization], 200);
        }else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $this->authorize('update', $organization);
        $organization->update($request->all());

        $user = Auth::user();
        Log::info("Organization({$organization->id}): {$organization->name} Updated by {$user->username}");
        
        $updatedOrg = [Organization::where('id', $organization->id)->first()];
        $updatedOrg = $this->parser($updatedOrg)[0];
        if($request->ajax()){
            $updated = __('common.updated');
            return response()
            ->json([
                'message'=>['title' => $updated.'!', 'desc' => $updatedOrg->name.' '.__('common.success',['action'=>$updated])],
                'data'=>$updatedOrg], 200);
        }else {
            return redirect()->back();
        }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $this->authorize('delete', $organization);

        $name = $organization->name;
        $id = $organization->id;
        $organization->documents()->delete();
        if($organization->delete()){
            $user = Auth::user();
            Log::info("Organization({$id}): {$name} Deleted by {$user->username}");
        }



        return response()->json([
            'message'=> $name.' '.__('common.deleted'),
            'title' => __('common.deleted')
            ],200);
    }

    private function parser($organizations)
    {
        $parsedOrganization = [];
        foreach ($organizations as $organization) {
            $parsedOrganization[] = (object)[
                                        'id' => $organization->id,
                                        'name' => $organization->name,
                                        'email' => $organization->email,
                                        'location' => $organization->location,
                                        'country' => $organization->country,
                                    ];
        }
        return $parsedOrganization;
    }
}
