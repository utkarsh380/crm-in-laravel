<?php

namespace App\Http\Controllers\leadcrud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Redirect,Response;
use DataTables;
use DB;

class LeadController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Lead::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
              
                    $btn = '<td><a href="javascript:void(0)" id="edit-lead" data-id="' .$row->id. '" class="btn btn-info edit-lead"><i class="far fa-edit"></i></a></td>';

                    $btn = $btn.'<td><a href="javascript:void(0)" id="delete-lead" data-id="' .$row->id. '" class="btn btn-danger delete-lead"><i class="fas fa-trash-alt"></i></a></td></tr>';

                    return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('lead.index');
    }
 

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
          ]);

        $Lead   =   Lead::Create([
        'title' => $request->title, 
        'clientName'=>$request->clientName,
        'clientEmail'=>$request->clientEmail,
        'leadSource'=>$request->leadSource,
        'leadStatus'=>$request->leadStatus,
        'generatedBy'=>$request->generatedBy,  
        'salesPerson'=>$request->salesPerson,
        'address'=>$request->address,
        'country'=>$request->country,
        'phone'=>$request->phone,
        'organization'=>$request->organization,
        'leadType'=>$request->leadType,
        'city'=>$request->city,
        'state'=>$request->state,
        'description' => $request->description,
    
        ]);
    
        return Response::json($Lead);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
          ]);
           
        $LeadID = $request->lead_id;
        $Lead   =   Lead::updateOrCreate(['id' => $LeadID],
                    [ 'title' => $request->title, 
                    'clientName'=>$request->clientName,
                    'clientEmail'=>$request->clientEmail,
                    'leadSource'=>$request->leadSource,
                    'leadStatus'=>$request->leadStatus,
                    'generatedBy'=>$request->generatedBy,  
                    'salesPerson'=>$request->salesPerson,
                    'address'=>$request->address,
                    'country'=>$request->country,
                    'phone'=>$request->phone,
                    'organization'=>$request->organization,
                    'leadType'=>$request->leadType,
                    'city'=>$request->city,
                    'state'=>$request->state,
                    'description' => $request->description,]);
    
        return Response::json($Lead);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $where = array('id' => $id);
        $Lead  = Lead::where($where)->first();
 
        return Response::json($Lead);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Lead = Lead::where('id',$id)->delete();
   
        return Response::json($Lead);
    }
}
