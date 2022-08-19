<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['category_id','category_name','category_description','updated_at','created_at'];
    
    public static function updateData($id,$data){
        DB::table('category')->where('category_id', $id)->update($data);
     }
}
