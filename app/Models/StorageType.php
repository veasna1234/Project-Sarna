<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StorageType extends Model
{
    use HasFactory;

    protected $table = 'storage_type';
    protected $fillable = ['storage_type_id','storage_type_name','storage_type_image','storage_type_description','created_at','updated_at'];

        public static function getuserData($id=null){
     
          $value=DB::table('storage_type')->orderBy('storage_type_id', 'asc')->get(); 
          return $value;
     
        }
     
        public static function insertData($data){
          DB::table('storage_type')->insert($data);
        }
     
        public static function updateData($id,$data){
           DB::table('storage_type')->where('storage_type_id', $id)->update($data);
        }
        
     
        public static function deleteData($id=0){
           DB::table('storage_type')->where('storage_type_id', '=', $id)->delete();
        }
}
