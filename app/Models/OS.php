<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OS extends Model
{
    use HasFactory;

    protected $table = 'os';
    protected $fillable = ['os_id','os_name','os_image','os_description','created_at','updated_at'];

        public static function getuserData($id=null){
     
          $value=DB::table('os')->orderBy('os_id', 'asc')->get(); 
          return $value;
     
        }
     
        public static function insertData($data){
          DB::table('os')->insert($data);
        }
     
        public static function updateData($id,$data){
           DB::table('os')->where('os_id', $id)->update($data);
        }
        
     
        public static function deleteData($id=0){
           DB::table('os')->where('os_id', '=', $id)->delete();
        }
    }
