<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Storage;
use App\Models\StorageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GetViewController extends Controller
{
    public function updateCategory(Request $request,Category $category){
        $id = $request->input('id');
        $category_name = $request->input('category_name');
        $category_description = $request->input('category_description');
            $data = array('category_name'=>$category_name,'category_description'=>$category_description);
            Category::updateData($id,$data);
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Add Category'
            ]);
        }

        public function fetchStorageType( Request $request){
            if ($request->ajax()) {
                $data = DB::table('storage')
                ->leftJoin('storage_type','storage.storage_type_id', "=", 'storage_type.storage_type_id')
                ->select('storage.*','storage_type.storage_type_name')
                ->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                               $btn = '<button id="edit" data-id='.$row->storage_id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                               $btn.='<button id="delete" data-id='.$row->storage_id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                                return $btn;
                        })
                        ->addColumn('image', function($row){
                            $image = ' <img src="'.((!file_exists('assets/img/upload/storage_image/'.$row->storage_image)) ? url('assets/img/upload/storage_image/storage_avatar.png') : url('assets/img/upload/storage_image/'.$row->storage_image)).'" alt="avata" class="avatar rounded-circle">';
                             return $image;
                     })
                     ->addColumn('created_at', function($row){
                        $created_at = date("d M Y H:i:s", strtotime($row->created_at));
                         return $created_at;
                 })
                 ->addColumn('updated_at', function($row){
                    $updated_at = date("d M Y H:i:s", strtotime($row->updated_at));
                     return $updated_at;
             })
                        ->rawColumns(['action','image','created_at','updated_at'])
                        ->make(true);
            }
           
        }

        public function getStorageType(){
            $storage_type = DB::table('storage_type')->select('*')->get();
            if(count($storage_type) > 0){
                return view('admin.component.storage',['storage_type' => $storage_type]);
            }else{
                return view('admin.component.storage',['storage_type' => 'Storage Type Not Found!!']);
            }
        }


        public function storeStorage(Request $request){
        
            $rules = [
                'storage_image' => 'image|mimes:jpg,png,jpeg|max:2048'
            ];
            if(empty($request->storage_descriptio) && empty($request->storage_type)){
                return response()->json([
                    'status' => 'empty',
                    'message' => 'Field is required!'
                ]);
            }elseif(empty($request->storage_type)){
                return response()->json([
                    'status' => 'empty_name',
                    'message' => 'storage Name is required!'
                ]);
            }
            elseif(empty($request->storage_description)){
                return response()->json([
                    'status' => 'empty_des',
                    'message' => 'storage Description is required!'
                ]);
            }elseif(strlen($request->storage_description) < 3 || strlen($request->storage_description) > 50){
                return response()->json([
                    'status' => 'min_max',
                    'message' => 'Field must be least than 50 and more than 3 charaters'
                ]);
            }elseif(strlen($request->storage_type) > 50){
                return response()->json([
                    'status' => 'min_max_name',
                    'message' => 'storage Name must be least than 50 and more than 3 charaters'
                ]);
            }elseif(!is_numeric($request->storage_size)){
                return response()->json([
                    'status' => 'error_size',
                    'message' => 'Please enter number only!'
                ]);

            
            }elseif(strlen($request->storage_description) > 50 || strlen($request->storage_description) < 3){
                return response()->json([
                    'status' => 'min_max_des',
                    'message' => 'storage Description must be least than 50 and more than 3 charaters'
                ]);
    
            }
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return response()->json([
                    'status' => 'Error',
                    'message' => $validator->getMessageBag(),
                ]);
            }else{
            $storage_type = $request->input('storage_type');
            $storage = new storage;
            $storage->storage_type_id = intval($storage_type);
            $storage->storage_size = $request->input('storage_size');
            $storage->storage_description = $request->input('storage_description');
            if($request->hasFile('storage_image')){
                $file = $request->file('storage_image');
                $extension = $file->getClientOriginalExtension();
                $file_name = time().'.'.$extension;
                $request->storage_image->move(public_path('assets/img/upload/storage_image'), $file_name);
                // $file->move(base_path('assets/img/upload/storage_image/').$file_name);
               $storage->storage_image = $file_name;
            }
            $storage->save();
        
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Success Add storage'
        ]);
    
    
        }
        public function getDeleteStorage($id){
            $storage = storage::where('storage_id',$id)->get();
            return response()->json([
                'status' => 'success',
                'storage' => $storage
            ]);
        }
    
        public function destroyStorage($id){
            $storage = storage::where('storage_id',$id);
            $image = storage::select('storage_image')->where('storage_id',$id)->get();
            if($storage){
                $filename = public_path('assets/img/upload/storage_image/'.$image[0]->storage_image);
                if(File::exists($filename)) {
                    File::delete($filename);
                }
                $storage->delete();
                return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
                
            }
        }
    
        public function getEditStorage($id){
            $storage = DB::table('storage')
            ->leftJoin('storage_type','storage.storage_type_id', "=", 'storage_type.storage_type_id')
            ->select('storage.*','storage_type.storage_type_name')
            ->where('storage_id',$id)
            ->get();
            return response()->json([
                'status' => 'success',
                'storage' => $storage
            ]);
        }
    
        public function updateStorage(Request $request){
            $rules = [
                'edit_storage_image' => 'image|mimes:jpg,png,jpeg|max:2048'
            ];
            $id = $request->input('edit_id');
            $edit_storage_type = $request->input('edit_storage_type');
            $currentTime = date('Y-m-d H:i:s');
            $edit_storage_description = $request->input('edit_storage_description');
            $edit_storage_size = $request->input('edit_storage_size');
            $validation = Validator::make($request->all(),$rules);
            if($validation->fails()){
                return response()->json([
                    'status' => 'wrong_file',
                    'message' => 'Wrong file is detected!'
                ]);
            
            }if(empty($request->edit_storage_type) && empty($request->edit_storage_description) && empty($request->edit_storage_size)){
                return response()->json([
                    'status' => 'empty',
                    'message' => 'Field is required!'
                ]);
            }elseif(empty($request->edit_storage_type)){
                return response()->json([
                    'status' => 'empty_name',
                    'message' => 'storage Name is required!'
                ]);
            }
            elseif(empty($request->edit_storage_description)){
                return response()->json([
                    'status' => 'empty_des',
                    'message' => 'storage Description is required!'
                ]);
            }elseif(strlen($request->edit_storage_description) < 3 || strlen($request->edit_storage_type) >50 && strlen($request->edit_storage_description) > 50){
                return response()->json([
                    'status' => 'min_max',
                    'message' => 'Field must be least than 50 and more than 3 charaters'
                ]);
            }elseif(strlen($request->edit_storage_type) > 50){
                return response()->json([
                    'status' => 'min_max_name',
                    'message' => 'storage Name must be least than 50 and more than 3 charaters'
                ]);
            }elseif(!is_numeric($request->edit_storage_size)){
                return response()->json([
                    'status' => 'error_size',
                    'message' => 'Please enter number only!'
                ]);
            }elseif(strlen($request->edit_storage_description) > 50 || strlen($request->edit_storage_description) < 3){
                return response()->json([
                    'status' => 'min_max_des',
                    'message' => 'storage Description must be least than 50 and more than 3 charaters'
                ]);
    
            }else{
                $data = array('storage_type_id'=> $edit_storage_type,'storage_description'=>$edit_storage_description,'storage_size'=>$edit_storage_size,'updated_at'=>$currentTime);
                
                if($request->hasFile('edit_storage_image')){
                    $image = storage::select('storage_image')->where('storage_id',$id)->get();
                    $filename = public_path('assets/img/upload/storage_image/'.$image[0]->storage_image);
                    if(File::exists($filename)) {
                        File::delete($filename);
                    }
                    $file = $request->file('edit_storage_image');
                    $extension = $file->getClientOriginalExtension();
                    $file_name = time().'.'.$extension;
                    $request->edit_storage_image->move(public_path('assets/img/upload/storage_image'), $file_name);
                    $data['storage_image']= $file_name;
                   
                }
                // dd($data);
                storage::updateData($id,$data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully Update storage'
                ]);
            }
        }
    
        public function viewStorage($id){
            $storage = storage::where('storage_id',$id)->get();
            return response()->json([
                'status' => 'success',
                'storage' => $storage,
    
            ]);
        }
} 
