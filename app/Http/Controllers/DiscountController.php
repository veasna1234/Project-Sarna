<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DiscountController extends Controller
{
    public function fetchDiscount( Request $request){
        if ($request->ajax()) {
            $data = Discount::select('*');
            $id = Discount::select('id');
            return Datatables::of($data,$id)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="edit" data-id='.$row->id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                           $btn.='<button id="delete" data-id='.$row->id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                            return $btn;
                    })
                    ->addColumn('created_at', function($row){
                        $created_at = date("d M Y H:i:s", strtotime($row->created_at));
                         return $created_at;
                 })
                 ->addColumn('started_at', function($row){
                    $started_at = date("d M Y H:i:s", strtotime($row->started_at));
                     return $started_at;
             })
             ->addColumn('end_at', function($row){
                $end_at = date("d M Y H:i:s", strtotime($row->end_at));
                 return $end_at;
         })
                        ->rawColumns(['action','created_at','started_at','end_at'])
                    ->make(true);
        }
        return view('admin.other.discount');
    }

    public function storeDiscount(Request $request){

        $validation = Validator::make($request->all(),[
            'discount_end' => 'required',
            'discount_start' => 'required'
        ]);
        if($validation->fails()){
            return response()->json([
                'status' => 'empty_date',
                'message' => 'Please fill the date!'
            ]);

        }
        $started_at = Carbon::createFromFormat('Y-m-d', $request->discount_start);
        $end_at = Carbon::createFromFormat('Y-m-d', $request->discount_end);
        
        

        if(empty($request->discount_name) && empty($request->discount_description) && empty($request->discount_percent) && empty($request->discount_start) && empty($request->discount_end)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->discount_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'discount Name is required!'
            ]);
        }
        elseif(empty($request->discount_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'discount Description is required!'
            ]);
        }elseif(empty($request->discount_percent)){
            return response()->json([
                'status' => 'empty_discount_percent',
                'message' => 'Please fill the discount percent',
            ]);
        }elseif(strlen($request->discount_name) < 3 && strlen($request->discount_description) < 3 || strlen($request->discount_name) >50 && strlen($request->discount_description) > 50 && strlen($request->discount_percent) > 30){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->discount_name) > 50 || strlen($request->discount_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'discount Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->discount_description) > 50 || strlen($request->discount_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'discount Description must be least than 50 and more than 3 charaters'
            ]);
        
        }elseif(strlen($request->discount_percent) > 30){
            return response()->json([
                'status' => 'min_max_discount',
                'message' => 'Discount is too much!'
            ]);
        
        }elseif($started_at->gt($end_at)){
            return response()->json([
                'status' => 'start_date_is_biger',
                'message' => 'End date is never bigger than Start date!',
            ]);

        }elseif(!is_numeric($request->discount_percent)){
            return response()->json([
                'status' => 'error_discount',
                'message' => 'Please fill number only!'

            ]);
        }
        else{
            $discount = new Discount;
            $discount->name = $request->input('discount_name');
            $discount->description = $request->input('discount_description');
            $discount->discount_percent = $request->input('discount_percent');
            $discount->active = $request->input('is_active');
            $discount->started_at = $request->input('discount_start');
            $discount->end_at = $request->input('discount_end');
            $discount->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Add Discount'
            ]);
        }
    }

    public function getDelete($id){
        $discount = Discount::where('id',$id)->get();
        return response()->json([
            'status' => 'success',
            'discount' => $discount
        ]);
    }
    public function destroyDiscount($id){
        $discount = discount::where('id',$id);
        $discount_name = discount::where('id',$id)->get();
        if($discount){
            $discount->delete();
            return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
            
        }
    }

    public function getEdit($id){
        $discount = Discount::select('*')->where('id',$id)->get();
        if($discount){
            return response()->json([
                'status' => 'success',
                'discount' => $discount
            ]);
        }
    }


    public function updateDiscount(Request $request){

        $validation = Validator::make($request->all(),[
            'discount_end' => 'required',
            'discount_start' => 'required'
        ]);
        if($validation->fails()){
            return response()->json([
                'status' => 'empty_date',
                'message' => 'Please fill the date!'
            ]);

        }
        $started_at = Carbon::createFromFormat('Y-m-d', $request->discount_start);
        $end_at = Carbon::createFromFormat('Y-m-d', $request->discount_end);
        
        

        if(empty($request->discount_name) && empty($request->discount_description) && empty($request->discount_percent) && empty($request->discount_start) && empty($request->discount_end)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->discount_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'discount Name is required!'
            ]);
        }
        elseif(empty($request->discount_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'discount Description is required!'
            ]);
        }elseif(empty($request->discount_percent)){
            return response()->json([
                'status' => 'empty_discount_percent',
                'message' => 'Please fill the discount percent',
            ]);
        }elseif(strlen($request->discount_name) < 3 && strlen($request->discount_description) < 3 || strlen($request->discount_name) >50 && strlen($request->discount_description) > 50 && strlen($request->discount_percent) > 30){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->discount_name) > 50 || strlen($request->discount_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'discount Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->discount_description) > 50 || strlen($request->discount_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'discount Description must be least than 50 and more than 3 charaters'
            ]);
        
        }elseif(strlen($request->discount_percent) > 30){
            return response()->json([
                'status' => 'min_max_discount',
                'message' => 'Discount is too much!'
            ]);
        
        }elseif($started_at->gt($end_at)){
            return response()->json([
                'status' => 'start_date_is_biger',
                'message' => 'End date is never bigger than Start date!',
            ]);

        }elseif(!is_numeric($request->discount_percent)){
            return response()->json([
                'status' => 'error_discount',
                'message' => 'Please fill number only!'

            ]);
        }
        else{
            $data = array(
                'name'=>$request->input('discount_name'),
                'description'=>$request->input('discount_description'),
                'discount_percent'=>$request->input('discount_percent'),
                'active'=>$request->input('is_active'),
                'started_at'=>$request->input('discount_start'),
                'end_at'=>$request->input('discount_end'),
            );
            $success = Discount::updateData($request->input('id'),$data);
                return response()->json([
                    'status'=>'success',
                    'message'=>'Successfully Update Discount',
                ]);
        }
    }

    public function viewDiscount($id){
        $discount = Discount::where('id',$id)->get();
        return response()->json([
            'status' => 'success',
            'discount' => $discount,
    
        ]);
    }

    
}
