<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DataTables;

class EmployeeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = $this->search_dt();

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row)
            {
                
                $id = $row->Id;
                
                $btn='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$id.'" data-original-title="View" class="view btn btn-primary btn-sm viewDetails">View</a>&nbsp;&nbsp;';
                $btn .='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDetails">Edit</a>&nbsp;&nbsp;';
                $btn .='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$id.'" data-original-title="Delete" class="delete btn btn-primary btn-sm deleteDetails">Delete</a>&nbsp;&nbsp;';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('index');
    }

    public function search_dt()
    {
        $res = Employee::select('Id','FirstName','Email','Tele','JoinDate','WorkingRoute')->get();
        return $res;
    }

    public function show(Request $request){
        $id = $request->id;
        $res = Employee::find($id);
        return response()->json($res);
        
    }
    public function store(Request $request){
      
        Employee::updateOrCreate(['Id'=> $request->id],
        ['FirstName' => $request->frst_nm, 'Email' => $request->eml,'Tele' => $request->t_pn,'JoinDate' => $request->j_date,'WorkingRoute' => $request->rte,'Comments' => $request->cmnt]); 
 
        return response()->json(['success'=>'Saved']);
        
    }

    public function delete(Request $request){
        $id = $request->id;
        Employee::find($id)->delete();
     
        return response()->json(['success'=>'Deleted']);
       
    }

}
