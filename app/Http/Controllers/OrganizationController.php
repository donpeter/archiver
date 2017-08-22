<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationRequest;


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
        return view('organizations.index', compact('folders','organizations')); 
    }
    
    public function getAllApi()
    {
        $organizations = Organization::all();
        $organizations = $this->parser($organizations);
        return response()->json( $organizations);
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
        if($request->ajax()){
            return response()->json(['message'=>['title' => __('created').'!', 'desc' => $name.' Created Succesfully'],'organization'=>$organization], 200);
        }else {
            return redirect()->route('organization.create');
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
        $organization->update($request->all());
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
        $name = $organization->name;
        $organization->delete();

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
