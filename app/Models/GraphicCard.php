<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GraphicCard extends Model
{
    use HasFactory;
    protected $table = 'graphic_card';
    protected $fillable = ['graphic_card_id','graphic_card_name','graphic_card_image','graphic_card_description','created_at','updated_at'];

        public static function getuserData($id=null){
     
          $value=DB::table('graphic_card')->orderBy('graphic_card_id', 'asc')->get(); 
          return $value;
     
        }
     
        public static function insertData($data){
          DB::table('graphic_card')->insert($data);
        }
     
        public static function updateData($id,$data){
           DB::table('graphic_card')->where('graphic_card_id', $id)->update($data);
        }
        
     
        public static function deleteData($id=0){
           DB::table('graphic_card')->where('graphic_card_id', '=', $id)->delete();
        }
}
