<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Archive;
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
        if($request->ajax()){
            $organizations = Organization::all();
            $organizations = $this->parser($organizations);
            return response()->json( $organizations);
        }else {
            return view('organizations.index'); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $archives = Archive::all();
        $organizations = Organization::all();
        return view('organizations.create', compact('archives','organizations'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
         $organization = Organization::create($request->all());
        $name = $request->input('name');
        if($request->ajax()){
            return response()->json(['message'=>['title' => __('created').'!', 'desc' => $name.' Created Succesfully'],'organization'=>$organization], 200);
        }else {
            return redirect()->route('organization.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        
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
       // return response($organization);
        $organization->update($request->all());
        $updatedOrg= Organization::where('id', $organization->id)->first();
        if($request->ajax()){
            $updated = __('updated');
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
        //
    }

    private function parser($organizations)
    {
        $parsedOrganization = [];
        foreach ($organizations as $organization) {
            $parsedOrganization[] = (object)[
                                        'name' => $organization->name,
                                        'type' => $organization->archive->name,
                                        'desc' => $organization->desc,
                                        'license' => $organization->license,
                                        'location' => $organization->location,
                                        'country' => $organization->country,
                                    ];
        }
        $organizations = $parsedOrganization;
        return $parsedOrganization;
    }
}
