<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $table = ['brand','category','contact','os','processor','products','ram','storage','storage_type','tbl_user'];
    protected $table = 'products';
    protected $fillable = ['id','category_id','user_id','brand_id','product_name','price','ram_id','storage_id','processor_id','screen_size','product_price','os_id','product_image'];
}
