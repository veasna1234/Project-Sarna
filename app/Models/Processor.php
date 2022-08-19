<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Processor extends Model
{
    use HasFactory;
    protected $table = 'processor';
    protected $fillable = ['processor_id','processor_name','processor_image','processor_description','created_at','updated_at'];

        public static function getuserData($id=null){
     
          $value=DB::table('processor')->orderBy('processor_id', 'asc')->get(); 
          return $value;
     
        }
     
        public static function insertData($data){
          DB::table('processor')->insert($data);
        }
     
        public static function updateData($id,$data){
           DB::table('processor')->where('processor_id', $id)->update($data);
        }
        
     
        public static function deleteData($id=0){
           DB::table('processor')->where('processor_id', '=', $id)->delete();
        }
}
