<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\GraphicCard;
use App\Models\Processor;
use App\Models\Product;
use App\Models\RAM;
use App\Models\OS;
use App\Models\StorageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function getIp(Request $request){
        $ip = $request->getClientIp();
        dd($ip);
    }
    public function fetchCategory( Request $request){
        if ($request->ajax()) {
            $data = Category::select('*');
            $id = Category::select('category_id');
            return Datatables::of($data,$id)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="edit" data-id='.$row->category_id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                           $btn.='<button id="delete" data-id='.$row->category_id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                            return $btn;
                    })
                    ->addColumn('created_at', function($row){
                        $created_at = date("d M Y H:i:s", strtotime($row->created_at));
                         return $created_at;
                 })
                 ->addColumn('updated_at', function($row){
                    $updated_at = date("d M Y H:i:s", strtotime($row->updated_at));
                     return $updated_at;
             })
                        ->rawColumns(['action','create','update'])
                    ->make(true);
        }
        return view('category');
    }

    public function listView(){
        $products = Product::all();
        return view('admin.icons',['products' => $products]);
    }
    public function storeCategory(Request $request){
        if(empty($request->category_name) && empty($request->category_description)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->category_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'Category Name is required!'
            ]);
        }
        elseif(empty($request->category_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'Category Description is required!'
            ]);
        }elseif(strlen($request->category_name) < 3 && strlen($request->category_description) < 3 || strlen($request->category_name) >50 && strlen($request->category_description) > 50){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->category_name) > 50 || strlen($request->category_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'Category Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->category_description) > 50 || strlen($request->category_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'Category Description must be least than 50 and more than 3 charaters'
            ]);

        }else{
            $category = new Category;
            $category->category_name = $request->input('category_name');
            $category->category_description = $request->input('category_description');
            $category->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Add Category'
            ]);
        }
    }
    public function getDelete($id){
        $category = Category::where('category_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'category' => $category
        ]);
    }
    public function destroyCategory($id){
        $category = Category::where('category_id',$id);
        $category_name = Category::where('category_id',$id)->get();
        if($category){
            $category->delete();
            return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
            
        }
    }

    public function getEditCategory($id){
        $category = Category::where('category_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'category' => $category
        ]);
    }
    public function updateCategory(Request $request){
        $id = $request->input('id');
        $currentTime = date('Y-m-d H:i:s');
        $category_name = $request->input('category_name');
        $category_description = $request->input('category_description');
        $data = array('category_name'=> $category_name,'category_description'=>$category_description,'updated_at'=>$currentTime);
        if(empty($request->category_name) && empty($request->category_description)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->category_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'Category Name is required!'
            ]);
        }
        elseif(empty($request->category_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'Category Description is required!'
            ]);
        }elseif(strlen($request->category_name) < 3 && strlen($request->category_description) < 3 || strlen($request->category_name) >50 && strlen($request->category_description) > 50){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->category_name) > 50 || strlen($request->category_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'Category Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->category_description) > 50 || strlen($request->category_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'Category Description must be least than 50 and more than 3 charaters'
            ]);

        }else{
            Category::updateData($id,$data);
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Add Category'
            ]);
        }
    }


    public function viewCategory($id){
        $category = Category::where('category_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'category' => $category,

        ]);
    }

    public function fetchBrand( Request $request){
        if ($request->ajax()) {
            $data = Brand::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="edit" data-id='.$row->brand_id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                           $btn.='<button id="delete" data-id='.$row->brand_id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                            return $btn;
                    })
                    ->addColumn('image', function($row){
                        $image = ' <img src="'.((!file_exists('assets/img/upload/brand_image/'.$row->brand_image)) ? url('assets/img/upload/brand_image/brand_avatar.png') : url('assets/img/upload/brand_image/'.$row->brand_image)).'" alt="avata" class="avatar rounded-circle">';
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
                    ->rawColumns(['action','image','create','update'])
                    ->make(true);
        }
        return view('tables');
    }

    public function storeBrand(Request $request){
        $ip = $request->getClientIp();
        dd($ip);
        
        $rules = [
            'brand_image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ];
        if(empty($request->brand_name) && empty($request->brand_descriptio)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->brand_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'brand Name is required!'
            ]);
        }
        elseif(empty($request->brand_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'brand Description is required!'
            ]);
        }elseif(strlen($request->brand_name) < 3 && strlen($request->brand_description) < 3 || strlen($request->brand_name) >50 && strlen($request->brand_description) > 50){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->brand_name) > 50 || strlen($request->brand_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'brand Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->brand_description) > 50 || strlen($request->brand_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'brand Description must be least than 50 and more than 3 charaters'
            ]);

        }
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->getMessageBag(),
            ]);
        }else{
        $brand = new Brand;
        $brand->brand_name = $request->input('brand_name');
        $brand->brand_description = $request->input('brand_description');
        if($request->hasFile('brand_image')){
            $file = $request->file('brand_image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $request->brand_image->move(public_path('assets/img/upload/brand_image'), $file_name);
            // $file->move(base_path('assets/img/upload/brand_image/').$file_name);
           $brand->brand_image = $file_name;
        }
        $brand->save();
    
    }
    return response()->json([
        'status' => 'success',
        'message' => 'Success Add Brand'
    ]);


    }
    public function getDeleteBrand($id){
        $brand = Brand::where('brand_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'brand' => $brand
        ]);
    }

    public function destroyBrand($id){
        $brand = Brand::where('brand_id',$id);
        $image = Brand::select('brand_image')->where('brand_id',$id)->get();
        if($brand){
            $filename = public_path('assets/img/upload/brand_image/'.$image[0]->brand_image);
            if(File::exists($filename)) {
                File::delete($filename);
            }
            $brand->delete();
            return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
            
        }
    }

    public function getEditBrand($id){
        $brand = Brand::where('brand_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'brand' => $brand
        ]);
    }

    public function updateBrand(Request $request){
        $rules = [
            'edit_brand_image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ];
        $id = $request->input('edit_id');
        $currentTime = date('Y-m-d H:i:s');
        $edit_brand_name = $request->input('edit_brand_name');
        $edit_brand_description = $request->input('edit_brand_description');
        $validation = Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json([
                'status' => 'wrong_file',
                'message' => 'Wrong file is detected!'
            ]);
        
        }if(empty($request->edit_brand_name) && empty($request->edit_brand_descriptio)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->edit_brand_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'Brand Name is required!'
            ]);
        }
        elseif(empty($request->edit_brand_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'Brand Description is required!'
            ]);
        }elseif(strlen($request->edit_brand_name) < 3 && strlen($request->edit_brand_description) < 3 || strlen($request->edit_brand_name) >50 && strlen($request->edit_brand_description) > 50){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->edit_brand_name) > 50 || strlen($request->edit_brand_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'Brand Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->edit_brand_description) > 50 || strlen($request->edit_brand_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'Brand Description must be least than 50 and more than 3 charaters'
            ]);

        }else{
            $data = array('brand_name'=> $edit_brand_name,'brand_description'=>$edit_brand_description,'updated_at'=>$currentTime);
            if($request->hasFile('edit_brand_image')){
                $image = Brand::select('brand_image')->where('brand_id',$id)->get();
                $filename = public_path('assets/img/upload/brand_image/'.$image[0]->brand_image);
                if(File::exists($filename)) {
                    File::delete($filename);
                }
                $file = $request->file('edit_brand_image');
                $extension = $file->getClientOriginalExtension();
                $file_name = time().'.'.$extension;
                $request->edit_brand_image->move(public_path('assets/img/upload/brand_image'), $file_name);
                $data['brand_image']= $file_name;
               
            }
            Brand::updateData($id,$data);
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Update Brand'
            ]);
        }
    }


    public function viewBrand($id){
        $brand = Brand::where('brand_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'brand' => $brand,

        ]);
    }




    // RAM

    public function fetchRam( Request $request){
        if ($request->ajax()) {
            $data = RAM::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="edit" data-id='.$row->ram_id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                           $btn.='<button id="delete" data-id='.$row->ram_id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                            return $btn;
                    })
                    ->addColumn('image', function($row){
                        $image = ' <img src="'.((!file_exists('assets/img/upload/ram_image/'.$row->ram_image)) ? url('assets/img/upload/ram_image/ram_avatar.png') : url('assets/img/upload/ram_image/'.$row->ram_image)).'" alt="avata" class="avatar rounded-circle">';
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
                    ->rawColumns(['action','image','create','update'])
                    ->make(true);
        }
        return view('tables');
    }

    public function storeRam(Request $request){
        
        $rules = [
            'ram_image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ];
        if(empty($request->ram_name) && empty($request->ram_descriptio)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->ram_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'ram Name is required!'
            ]);
        }
        elseif(empty($request->ram_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'ram Description is required!'
            ]);
        }elseif(strlen($request->ram_name) < 3 && strlen($request->ram_description) < 3 || strlen($request->ram_name) >50 && strlen($request->ram_description) > 50){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->ram_name) > 50 || strlen($request->ram_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'ram Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->ram_description) > 50 || strlen($request->ram_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'ram Description must be least than 50 and more than 3 charaters'
            ]);

        }
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->getMessageBag(),
            ]);
        }else{
        $ram = new ram;
        $ram->ram_name = $request->input('ram_name');
        $ram->ram_size = $request->input('ram_size');
        $ram->ram_description = $request->input('ram_description');
        if($request->hasFile('ram_image')){
            $file = $request->file('ram_image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $request->ram_image->move(public_path('assets/img/upload/ram_image'), $file_name);
            // $file->move(base_path('assets/img/upload/ram_image/').$file_name);
           $ram->ram_image = $file_name;
        }
        $ram->save();
    
    }
    return response()->json([
        'status' => 'success',
        'message' => 'Success Add ram'
    ]);


    }
    public function getDeleteRam($id){
        $ram = RAM::where('ram_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'ram' => $ram
        ]);
    }

    public function destroyRam($id){
        $ram = RAM::where('ram_id',$id);
        $image = RAM::select('ram_image')->where('ram_id',$id)->get();
        if($ram){
            $filename = public_path('assets/img/upload/ram_image/'.$image[0]->ram_image);
            if(File::exists($filename)) {
                File::delete($filename);
            }
            $ram->delete();
            return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
            
        }
    }

    public function getEditRam($id){
        $ram = RAM::where('ram_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'ram' => $ram
        ]);
    }

    public function updateRam(Request $request){
        $currentTime = date('Y-m-d H:i:s');
        $rules = [
            'edit_ram_image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ];
        $id = $request->input('edit_id');
        $edit_ram_name = $request->input('edit_ram_name');
        $edit_ram_description = $request->input('edit_ram_description');
        $edit_ram_size = $request->input('edit_ram_size');
        $edit_ram_description = $request->input('edit_ram_description');
        $validation = Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json([
                'status' => 'wrong_file',
                'message' => 'Wrong file is detected!'
            ]);
        
        }if(empty($request->edit_ram_name) && empty($request->edit_ram_descriptio)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->edit_ram_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'ram Name is required!'
            ]);
        }
        elseif(empty($request->edit_ram_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'ram Description is required!'
            ]);
        }elseif(strlen($request->edit_ram_name) < 3 && strlen($request->edit_ram_description) < 3 || strlen($request->edit_ram_name) >50 && strlen($request->edit_ram_description) > 50){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->edit_ram_name) > 50 || strlen($request->edit_ram_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'ram Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->edit_ram_description) > 50 || strlen($request->edit_ram_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'ram Description must be least than 50 and more than 3 charaters'
            ]);

        }else{
            $data = array('ram_name'=> $edit_ram_name,'ram_description'=>$edit_ram_description,'ram_size'=>$edit_ram_size,'updated_at'=>$currentTime);
            
            if($request->hasFile('edit_ram_image')){
                $image = RAM::select('ram_image')->where('ram_id',$id)->get();
                $filename = public_path('assets/img/upload/ram_image/'.$image[0]->ram_image);
                if(File::exists($filename)) {
                    File::delete($filename);
                }
                $file = $request->file('edit_ram_image');
                $extension = $file->getClientOriginalExtension();
                $file_name = time().'.'.$extension;
                $request->edit_ram_image->move(public_path('assets/img/upload/ram_image'), $file_name);
                $data['ram_image']= $file_name;
               
            }
            // dd($data);
            RAM::updateData($id,$data);
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Update ram'
            ]);
        }
    }

    public function viewRam($id){
        $ram = RAM::where('ram_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'ram' => $ram,

        ]);
    }

    //Processor

    public function fetchprocessor( Request $request){
        if ($request->ajax()) {
            $data = processor::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button id="edit" data-id='.$row->processor_id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                           $btn.='<button id="delete" data-id='.$row->processor_id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                            return $btn;
                    })
                    ->addColumn('image', function($row){
                        $image = ' <img src="'.((!file_exists('assets/img/upload/processor_image/'.$row->processor_image)) ? url('assets/img/upload/processor_image/processor_avatar.png') : url('assets/img/upload/processor_image/'.$row->processor_image)).'" alt="avata" class="avatar rounded-circle">';
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
                    ->rawColumns(['action','image','create','update'])
                    ->make(true);
        }
        return view('tables');
    }

    public function storeProcessor(Request $request){
        
        $rules = [
            'processor_image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ];
        if(empty($request->processor_name) && empty($request->processor_descriptio)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->processor_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'processor Name is required!'
            ]);
        }
        elseif(empty($request->processor_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'processor Description is required!'
            ]);
        }elseif(strlen($request->processor_name) < 3 && strlen($request->processor_description) < 3 || strlen($request->processor_name) >50 && strlen($request->processor_description) > 50){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->processor_name) > 50 || strlen($request->processor_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'processor Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->processor_description) > 50 || strlen($request->processor_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'processor Description must be least than 50 and more than 3 charaters'
            ]);

        }
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->getMessageBag(),
            ]);
        }else{
        $processor = new Processor;
        $processor->processor_name = $request->input('processor_name');
        $processor->processor_description = $request->input('processor_description');
        if($request->hasFile('processor_image')){
            $file = $request->file('processor_image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $request->processor_image->move(public_path('assets/img/upload/processor_image'), $file_name);
            // $file->move(base_path('assets/img/upload/processor_image/').$file_name);
           $processor->processor_image = $file_name;
        }
        $processor->save();
    
    }
    return response()->json([
        'status' => 'success',
        'message' => 'Success Add processor'
    ]);


    }
    public function getDeleteProcessor($id){
        $processor = processor::where('processor_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'processor' => $processor
        ]);
    }

    public function destroyProcessor($id){
        $processor = processor::where('processor_id',$id);
        $image = processor::select('processor_image')->where('processor_id',$id)->get();
        if($processor){
            $filename = public_path('assets/img/upload/processor_image/'.$image[0]->processor_image);
            if(File::exists($filename)) {
                File::delete($filename);
            }
            $processor->delete();
            return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
            
        }
    }

    public function getEditProcessor($id){
        $processor = processor::where('processor_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'processor' => $processor
        ]);
    }

    public function updateProcessor(Request $request){
        $rules = [
            'edit_processor_image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ];
        $id = $request->input('edit_id');
        $edit_processor_name = $request->input('edit_processor_name');
        $edit_processor_description = $request->input('edit_processor_description');
        $validation = Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json([
                'status' => 'wrong_file',
                'message' => 'Wrong file is detected!'
            ]);
        
        }if(empty($request->edit_processor_name) && empty($request->edit_processor_descriptio)){
            return response()->json([
                'status' => 'empty',
                'message' => 'Field is required!'
            ]);
        }elseif(empty($request->edit_processor_name)){
            return response()->json([
                'status' => 'empty_name',
                'message' => 'processor Name is required!'
            ]);
        }
        elseif(empty($request->edit_processor_description)){
            return response()->json([
                'status' => 'empty_des',
                'message' => 'processor Description is required!'
            ]);
        }elseif(strlen($request->edit_processor_name) < 3 && strlen($request->edit_processor_description) < 3 || strlen($request->edit_processor_name) >50 && strlen($request->edit_processor_description) > 50){
            return response()->json([
                'status' => 'min_max',
                'message' => 'Field must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->edit_processor_name) > 50 || strlen($request->edit_processor_name) < 3){
            return response()->json([
                'status' => 'min_max_name',
                'message' => 'processor Name must be least than 50 and more than 3 charaters'
            ]);
        }elseif(strlen($request->edit_processor_description) > 50 || strlen($request->edit_processor_description) < 3){
            return response()->json([
                'status' => 'min_max_des',
                'message' => 'processor Description must be least than 50 and more than 3 charaters'
            ]);

        }else{
            $currentTime = date('Y-m-d H:i:s');
            $data = array('processor_name'=> $edit_processor_name,'processor_description'=>$edit_processor_description,'updated_at'=>$currentTime);
            
            if($request->hasFile('edit_processor_image')){
                $image = processor::select('processor_image')->where('processor_id',$id)->get();
                $filename = public_path('assets/img/upload/processor_image/'.$image[0]->processor_image);
                if(File::exists($filename)) {
                    File::delete($filename);
                }
                $file = $request->file('edit_processor_image');
                $extension = $file->getClientOriginalExtension();
                $file_name = time().'.'.$extension;
                $request->edit_processor_image->move(public_path('assets/img/upload/processor_image'), $file_name);
                $data['processor_image']= $file_name;
               
            }
            // dd($data);
            Processor::updateData($id,$data);
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Update Processor'
            ]);
        }
    }

    public function viewProcessor($id){
        $processor = Processor::where('processor_id',$id)->get();
        return response()->json([
            'status' => 'success',
            'processor' => $processor,

        ]);
    }

// OS

public function fetchOs( Request $request){
    if ($request->ajax()) {
        $data = os::select('*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                       $btn = '<button id="edit" data-id='.$row->os_id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                       $btn.='<button id="delete" data-id='.$row->os_id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                        return $btn;
                })
                ->addColumn('image', function($row){
                    $image = ' <img src="'.((!file_exists('assets/img/upload/os_image/'.$row->os_image)) ? url('assets/img/upload/os_image/os_avatar.png') : url('assets/img/upload/os_image/'.$row->os_image)).'" alt="avata" class="avatar rounded-circle">';
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
                ->rawColumns(['action','image','create','update'])
                ->make(true);
    }
    return view('tables');
}

public function storeOs(Request $request){
    
    $rules = [
        'os_image' => 'image|mimes:jpg,png,jpeg|max:2048'
    ];
    if(empty($request->os_name) && empty($request->os_descriptio)){
        return response()->json([
            'status' => 'empty',
            'message' => 'Field is required!'
        ]);
    }elseif(empty($request->os_name)){
        return response()->json([
            'status' => 'empty_name',
            'message' => 'os Name is required!'
        ]);
    }
    elseif(empty($request->os_description)){
        return response()->json([
            'status' => 'empty_des',
            'message' => 'os Description is required!'
        ]);
    }elseif(strlen($request->os_name) < 3 && strlen($request->os_description) < 3 || strlen($request->os_name) >50 && strlen($request->os_description) > 50){
        return response()->json([
            'status' => 'min_max',
            'message' => 'Field must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->os_name) > 50 || strlen($request->os_name) < 3){
        return response()->json([
            'status' => 'min_max_name',
            'message' => 'os Name must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->os_description) > 50 || strlen($request->os_description) < 3){
        return response()->json([
            'status' => 'min_max_des',
            'message' => 'os Description must be least than 50 and more than 3 charaters'
        ]);

    }
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
        return response()->json([
            'status' => 'Error',
            'message' => $validator->getMessageBag(),
        ]);
    }else{
    $os = new os;
    $os->os_name = $request->input('os_name');
    $os->os_description = $request->input('os_description');
    if($request->hasFile('os_image')){
        $file = $request->file('os_image');
        $extension = $file->getClientOriginalExtension();
        $file_name = time().'.'.$extension;
        $request->os_image->move(public_path('assets/img/upload/os_image'), $file_name);
        // $file->move(base_path('assets/img/upload/os_image/').$file_name);
       $os->os_image = $file_name;
    }
    $os->save();

}
return response()->json([
    'status' => 'success',
    'message' => 'Success Add os'
]);


}
public function getDeleteOs($id){
    $os = os::where('os_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'os' => $os
    ]);
}

public function destroyOs($id){
    $os = os::where('os_id',$id);
    $image = os::select('os_image')->where('os_id',$id)->get();
    if($os){
        $filename = public_path('assets/img/upload/os_image/'.$image[0]->os_image);
        if(File::exists($filename)) {
            File::delete($filename);
        }
        $os->delete();
        return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
        
    }
}

public function getEditOs($id){
    $os = os::where('os_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'os' => $os
    ]);
}

public function updateOs(Request $request){
    $currentTime = date('Y-m-d H:i:s');
    $rules = [
        'edit_os_image' => 'image|mimes:jpg,png,jpeg|max:2048'
    ];
    $id = $request->input('edit_id');
    $edit_os_name = $request->input('edit_os_name');
    $edit_os_description = $request->input('edit_os_description');
    $validation = Validator::make($request->all(),$rules);
    if($validation->fails()){
        return response()->json([
            'status' => 'wrong_file',
            'message' => 'Wrong file is detected!'
        ]);
    
    }if(empty($request->edit_os_name) && empty($request->edit_os_descriptio)){
        return response()->json([
            'status' => 'empty',
            'message' => 'Field is required!'
        ]);
    }elseif(empty($request->edit_os_name)){
        return response()->json([
            'status' => 'empty_name',
            'message' => 'os Name is required!'
        ]);
    }
    elseif(empty($request->edit_os_description)){
        return response()->json([
            'status' => 'empty_des',
            'message' => 'os Description is required!'
        ]);
    }elseif(strlen($request->edit_os_name) < 3 && strlen($request->edit_os_description) < 3 || strlen($request->edit_os_name) >50 && strlen($request->edit_os_description) > 50){
        return response()->json([
            'status' => 'min_max',
            'message' => 'Field must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->edit_os_name) > 50 || strlen($request->edit_os_name) < 3){
        return response()->json([
            'status' => 'min_max_name',
            'message' => 'os Name must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->edit_os_description) > 50 || strlen($request->edit_os_description) < 3){
        return response()->json([
            'status' => 'min_max_des',
            'message' => 'os Description must be least than 50 and more than 3 charaters'
        ]);

    }else{
        $data = array('os_name'=> $edit_os_name,'os_description'=>$edit_os_description,'updated_at'=>$currentTime);
        
        if($request->hasFile('edit_os_image')){
            $image = os::select('os_image')->where('os_id',$id)->get();
            $filename = public_path('assets/img/upload/os_image/'.$image[0]->os_image);
            if(File::exists($filename)) {
                File::delete($filename);
            }
            $file = $request->file('edit_os_image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $request->edit_os_image->move(public_path('assets/img/upload/os_image'), $file_name);
            $data['os_image']= $file_name;
           
        }
        // dd($data);
        os::updateData($id,$data);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully Update os'
        ]);
    }
}

public function viewOs($id){
    $os = OS::where('os_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'os' => $os,

    ]);
}

//Storage type

public function fetchStorageType( Request $request){
    if ($request->ajax()) {
        $data = StorageType::select('*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                       $btn = '<button id="edit" data-id='.$row->storage_type_id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                       $btn.='<button id="delete" data-id='.$row->storage_type_id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                        return $btn;
                })
                ->addColumn('image', function($row){
                    $image = ' <img src="'.((!file_exists('assets/img/upload/storage_type_image/'.$row->storage_type_image)) ? url('assets/img/upload/storage_type_image/storage_type_avatar.png') : url('assets/img/upload/storage_type_image/'.$row->storage_type_image)).'" alt="avata" class="avatar rounded-circle">';
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
                ->rawColumns(['action','image','create','update'])
                ->make(true);
    }
    return view('tables');
}

public function storeStorageType(Request $request){
    
    $rules = [
        'storage_type_image' => 'image|mimes:jpg,png,jpeg|max:2048'
    ];
    if(empty($request->storage_type_name) && empty($request->storage_type_descriptio)){
        return response()->json([
            'status' => 'empty',
            'message' => 'Field is required!'
        ]);
    }elseif(empty($request->storage_type_name)){
        return response()->json([
            'status' => 'empty_name',
            'message' => 'storage_type Name is required!'
        ]);
    }
    elseif(empty($request->storage_type_description)){
        return response()->json([
            'status' => 'empty_des',
            'message' => 'storage_type Description is required!'
        ]);
    }elseif(strlen($request->storage_type_name) < 3 && strlen($request->storage_type_description) < 3 || strlen($request->storage_type_name) >50 && strlen($request->storage_type_description) > 50){
        return response()->json([
            'status' => 'min_max',
            'message' => 'Field must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->storage_type_name) > 50 || strlen($request->storage_type_name) < 3){
        return response()->json([
            'status' => 'min_max_name',
            'message' => 'storage_type Name must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->storage_type_description) > 50 || strlen($request->storage_type_description) < 3){
        return response()->json([
            'status' => 'min_max_des',
            'message' => 'storage_type Description must be least than 50 and more than 3 charaters'
        ]);

    }
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
        return response()->json([
            'status' => 'Error',
            'message' => $validator->getMessageBag(),
        ]);
    }else{
    $storage_type = new StorageType;
    $storage_type->storage_type_name = $request->input('storage_type_name');
    $storage_type->storage_type_description = $request->input('storage_type_description');
    if($request->hasFile('storage_type_image')){
        $file = $request->file('storage_type_image');
        $extension = $file->getClientOriginalExtension();
        $file_name = time().'.'.$extension;
        $request->storage_type_image->move(public_path('assets/img/upload/storage_type_image'), $file_name);
        // $file->move(base_path('assets/img/upload/storage_type_image/').$file_name);
       $storage_type->storage_type_image = $file_name;
    }
    $storage_type->save();

}
return response()->json([
    'status' => 'success',
    'message' => 'Success Add storage_type'
]);


}
public function getDeleteStorageType($id){
    $storage_type = StorageType::where('storage_type_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'storage_type' => $storage_type
    ]);
}

public function destroyStorageType($id){
    $storage_type = StorageType::where('storage_type_id',$id);
    $image = StorageType::select('storage_type_image')->where('storage_type_id',$id)->get();
    if($storage_type){
        $filename = public_path('assets/img/upload/storage_type_image/'.$image[0]->storage_type_image);
        if(File::exists($filename)) {
            File::delete($filename);
        }
        $storage_type->delete();
        return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
        
    }
}

public function getEditStorageType($id){
    $storage_type = StorageType::where('storage_type_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'storage_type' => $storage_type
    ]);
}

public function updateStorageType(Request $request){
    $rules = [
        'edit_storage_type_image' => 'image|mimes:jpg,png,jpeg|max:2048'
    ];
    $id = $request->input('edit_id');
    $edit_storage_type_name = $request->input('edit_storage_type_name');
    $edit_storage_type_description = $request->input('edit_storage_type_description');
    $validation = Validator::make($request->all(),$rules);
    if($validation->fails()){
        return response()->json([
            'status' => 'wrong_file',
            'message' => 'Wrong file is detected!'
        ]);
    
    }if(empty($request->edit_storage_type_name) && empty($request->edit_storage_type_descriptio)){
        return response()->json([
            'status' => 'empty',
            'message' => 'Field is required!'
        ]);
    }elseif(empty($request->edit_storage_type_name)){
        return response()->json([
            'status' => 'empty_name',
            'message' => 'storage_type Name is required!'
        ]);
    }
    elseif(empty($request->edit_storage_type_description)){
        return response()->json([
            'status' => 'empty_des',
            'message' => 'storage_type Description is required!'
        ]);
    }elseif(strlen($request->edit_storage_type_name) < 3 && strlen($request->edit_storage_type_description) < 3 || strlen($request->edit_storage_type_name) >50 && strlen($request->edit_storage_type_description) > 50){
        return response()->json([
            'status' => 'min_max',
            'message' => 'Field must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->edit_storage_type_name) > 50 || strlen($request->edit_storage_type_name) < 3){
        return response()->json([
            'status' => 'min_max_name',
            'message' => 'storage_type Name must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->edit_storage_type_description) > 50 || strlen($request->edit_storage_type_description) < 3){
        return response()->json([
            'status' => 'min_max_des',
            'message' => 'storage_type Description must be least than 50 and more than 3 charaters'
        ]);

    }else{
        $currentTime = date('Y-m-d H:i:s');
        $data = array('storage_type_name'=> $edit_storage_type_name,'storage_type_description'=>$edit_storage_type_description,'updated_at'=>$currentTime);
        
        if($request->hasFile('edit_storage_type_image')){
            $image = StorageType::select('storage_type_image')->where('storage_type_id',$id)->get();
            $filename = public_path('assets/img/upload/storage_type_image/'.$image[0]->storage_type_image);
            if(File::exists($filename)) {
                File::delete($filename);
            }
            $file = $request->file('edit_storage_type_image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $request->edit_storage_type_image->move(public_path('assets/img/upload/storage_type_image'), $file_name);
            $data['storage_type_image']= $file_name;
           
        }
        // dd($data);
        StorageType::updateData($id,$data);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully Update storage_type'
        ]);
    }
}


public function viewStorageType($id){
    $storage_type = StorageType::where('storage_type_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'storage_type' => $storage_type,

    ]);
}

// Graphic_Card

public function fetchGraphicCard( Request $request){
    if ($request->ajax()) {
        $data = GraphicCard::select('*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                       $btn = '<button id="edit" data-id='.$row->graphic_card_id.' type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>';
                       $btn.='<button id="delete" data-id='.$row->graphic_card_id.' type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>';
                        return $btn;
                })
                ->addColumn('image', function($row){
                    $image = ' <img src="'.((!file_exists('assets/img/upload/graphic_card_image/'.$row->graphic_card_image)) ? url('assets/img/upload/graphic_card_image/graphic_card_avatar.png') : url('assets/img/upload/graphic_card_image/'.$row->graphic_card_image)).'" alt="avata" class="avatar rounded-circle">';
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
                ->rawColumns(['action','image','create','update'])
                ->make(true);
    }
    return view('tables');
}

public function storeGraphicCard(Request $request){
    
    $rules = [
        'graphic_card_image' => 'image|mimes:jpg,png,jpeg|max:2048'
    ];
    if(empty($request->graphic_card_name) && empty($request->graphic_card_descriptio)){
        return response()->json([
            'status' => 'empty',
            'message' => 'Field is required!'
        ]);
    }elseif(empty($request->graphic_card_name)){
        return response()->json([
            'status' => 'empty_name',
            'message' => 'graphic_card Name is required!'
        ]);
    }
    elseif(empty($request->graphic_card_description)){
        return response()->json([
            'status' => 'empty_des',
            'message' => 'graphic_card Description is required!'
        ]);
    }elseif(strlen($request->graphic_card_name) < 3 && strlen($request->graphic_card_description) < 3 || strlen($request->graphic_card_name) >50 && strlen($request->graphic_card_description) > 50){
        return response()->json([
            'status' => 'min_max',
            'message' => 'Field must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->graphic_card_name) > 50 || strlen($request->graphic_card_name) < 3){
        return response()->json([
            'status' => 'min_max_name',
            'message' => 'graphic_card Name must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->graphic_card_description) > 50 || strlen($request->graphic_card_description) < 3){
        return response()->json([
            'status' => 'min_max_des',
            'message' => 'graphic_card Description must be least than 50 and more than 3 charaters'
        ]);

    }
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
        return response()->json([
            'status' => 'Error',
            'message' => $validator->getMessageBag(),
        ]);
    }else{
    $graphic_card = new GraphicCard;
    $graphic_card->graphic_card_name = $request->input('graphic_card_name');
    $graphic_card->graphic_card_description = $request->input('graphic_card_description');
    if($request->hasFile('graphic_card_image')){
        $file = $request->file('graphic_card_image');
        $extension = $file->getClientOriginalExtension();
        $file_name = time().'.'.$extension;
        $request->graphic_card_image->move(public_path('assets/img/upload/graphic_card_image'), $file_name);
        // $file->move(base_path('assets/img/upload/graphic_card_image/').$file_name);
       $graphic_card->graphic_card_image = $file_name;
    }
    $graphic_card->save();

}
return response()->json([
    'status' => 'success',
    'message' => 'Success Add graphic_card'
]);


}
public function getDeleteGraphicCard($id){
    $graphic_card = GraphicCard::where('graphic_card_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'graphic_card' => $graphic_card
    ]);
}

public function destroyGraphicCard($id){
    $graphic_card = GraphicCard::where('graphic_card_id',$id);
    $image = GraphicCard::select('graphic_card_image')->where('graphic_card_id',$id)->get();
    if($graphic_card){
        $filename = public_path('assets/img/upload/graphic_card_image/'.$image[0]->graphic_card_image);
        if(File::exists($filename)) {
            File::delete($filename);
        }
        $graphic_card->delete();
        return response()->json(['status'=>'success','message'=>'Successfully Delete!']);
        
    }
}

public function getEditGraphicCard($id){
    $graphic_card = GraphicCard::where('graphic_card_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'graphic_card' => $graphic_card
    ]);
}

public function updateGraphicCard(Request $request){
    $rules = [
        'edit_graphic_card_image' => 'image|mimes:jpg,png,jpeg|max:2048'
    ];
    $id = $request->input('edit_id');
    $edit_graphic_card_name = $request->input('edit_graphic_card_name');
    $edit_graphic_card_description = $request->input('edit_graphic_card_description');
    $validation = Validator::make($request->all(),$rules);
    if($validation->fails()){
        return response()->json([
            'status' => 'wrong_file',
            'message' => 'Wrong file is detected!'
        ]);
    
    }if(empty($request->edit_graphic_card_name) && empty($request->edit_graphic_card_descriptio)){
        return response()->json([
            'status' => 'empty',
            'message' => 'Field is required!'
        ]);
    }elseif(empty($request->edit_graphic_card_name)){
        return response()->json([
            'status' => 'empty_name',
            'message' => 'graphic_card Name is required!'
        ]);
    }
    elseif(empty($request->edit_graphic_card_description)){
        return response()->json([
            'status' => 'empty_des',
            'message' => 'graphic_card Description is required!'
        ]);
    }elseif(strlen($request->edit_graphic_card_name) < 3 && strlen($request->edit_graphic_card_description) < 3 || strlen($request->edit_graphic_card_name) >50 && strlen($request->edit_graphic_card_description) > 50){
        return response()->json([
            'status' => 'min_max',
            'message' => 'Field must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->edit_graphic_card_name) > 50 || strlen($request->edit_graphic_card_name) < 3){
        return response()->json([
            'status' => 'min_max_name',
            'message' => 'graphic_card Name must be least than 50 and more than 3 charaters'
        ]);
    }elseif(strlen($request->edit_graphic_card_description) > 50 || strlen($request->edit_graphic_card_description) < 3){
        return response()->json([
            'status' => 'min_max_des',
            'message' => 'graphic_card Description must be least than 50 and more than 3 charaters'
        ]);

    }else{
        $currentTime = date('Y-m-d H:i:s');
        $data = array('graphic_card_name'=> $edit_graphic_card_name,'graphic_card_description'=>$edit_graphic_card_description,'updated_at'=>$currentTime);
        
        if($request->hasFile('edit_graphic_card_image')){
            $image = GraphicCard::select('graphic_card_image')->where('graphic_card_id',$id)->get();
            $filename = public_path('assets/img/upload/graphic_card_image/'.$image[0]->graphic_card_image);
            if(File::exists($filename)) {
                File::delete($filename);
            }
            $file = $request->file('edit_graphic_card_image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $request->edit_graphic_card_image->move(public_path('assets/img/upload/graphic_card_image'), $file_name);
            $data['graphic_card_image']= $file_name;
           
        }
        // dd($data);
        GraphicCard::updateData($id,$data);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully Update graphic_card'
        ]);
    }
}


public function viewGraphicCard($id){
    $graphic_card = GraphicCard::where('graphic_card_id',$id)->get();
    return response()->json([
        'status' => 'success',
        'graphic_card' => $graphic_card,

    ]);
}


    
}

