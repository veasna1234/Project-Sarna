<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpOption\None;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'product_discount';
    protected $fillable = [
        'id',
        'name',
        'description',
        'discount_percent',
        'active',
        'created_at',
        'updated_at',
        'started_at',
        'end_at'
    ];
    public static function updateData($id,$data){
        DB::table('product_discount')->where('id', $id)->update($data);
     }
    
    
}
