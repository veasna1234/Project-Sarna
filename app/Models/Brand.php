<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brand';
    protected $fillable = ['brand_id','brand_name','brand_image','brand_description','created_at','updated_at'];

        public static function getuserData($id=null){
     
          $value=DB::table('brand')->orderBy('brand_id', 'asc')->get(); 
          return $value;
     
        }
     
        public static function insertData($data){
          DB::table('brand')->insert($data);
        }
     
        public static function updateData($id,$data){
           DB::table('brand')->where('brand_id', $id)->update($data);
        }
        
     
        public static function deleteData($id=0){
           DB::table('brand')->where('brand_id', '=', $id)->delete();
        }
}
