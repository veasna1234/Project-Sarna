<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Storage extends Model
{
    use HasFactory;
    protected $table = 'storage';
    protected $fillable = ['storage_id','storage_type_id','storage_size','storage_image','storage_description','created_at','updated_at'];

        public static function getuserData($id=null){
     
          $value=DB::table('storage')->orderBy('storage_id', 'asc')->get(); 
          return $value;
     
        }
     
        public static function insertData($data){
          DB::table('storage')->insert($data);
        }
     
        public static function updateData($id,$data){
           DB::table('storage')->where('storage_id', $id)->update($data);
        }
        
     
        public static function deleteData($id=0){
           DB::table('storage')->where('storage_id', '=', $id)->delete();
        }
    
}
