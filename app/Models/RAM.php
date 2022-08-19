<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RAM extends Model
{
    use HasFactory;
    protected $table = 'ram';
    protected $fillable = ['ram_id','ram_name','ram_size','ram_description','ram_image','created_at','updated_at'];

    public static function getuserData($id=null){
     
        $value=DB::table('ram')->orderBy('ram_id', 'asc')->get(); 
        return $value;
   
      }
   
      public static function insertData($data){
        DB::table('ram')->insert($data);
      }
   
      public static function updateData($id,$data){
         DB::table('ram')->where('ram_id', $id)->update($data);
      }
      
   
      public static function deleteData($id=0){
         DB::table('ram')->where('ram_id', '=', $id)->delete();
      }
}
