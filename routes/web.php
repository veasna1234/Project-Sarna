<?php

use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\GetViewController;
use App\Http\Controllers\ProductController;
use App\Models\Discount;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Get View
Route::get('ipAddress',[ProductController::class,'getIp']);
Route::get('website', function () {
    return view('website.main.index');
})->name('website.home');
Route::get('login', function () {
    return view('admin.login');
})->name('admin.login');
Route::get('register', function () {
    return view('admin.register');
})->name('admin.register');
Route::post('register',[ControllerAdmin::class,'register'])->name('register');
Route::post('auth.login',[ControllerAdmin::class,'login'])->name('auth.login');
route::group(['middleware'=>['ProtectedPage']],function(){
    Route::get('graphic_card', function () {
        return view('admin.component.graphic_card');
    })->name('component.graphic_card');
    
    Route::get('ram', function () {
        return view('admin.component.ram');
    })->name('component.ram');
    Route::get('processor', function () {
        return view('admin.component.processor');
    })->name('component.processor');
    Route::get('os', function () {
        return view('admin.component.os');
    })->name('component.os');
    Route::get('storage_type', function () {
        return view('admin.component.storage_type');
    })->name('component.storage_type');
    
    
    Route::get('discount', function () {
        return view('admin.other.discount');
    })->name('discount_product');
    // Route::get('storage', function () {
    //     return view('admin.component.storage');
    // })->name('component.storage');
    Route::get('/', function () {
        return view('admin.home');
    })->name('home');
    // Route::get('icons', function () {
    //     return view('admin.icons');
    // })->name('admin.icons');
    Route::get('category', function () {
        return view('admin.category');
    })->name('admin.category');
    
    Route::get('profile', function () {
        return view('admin.profile');
    })->name('admin.profile');
    Route::get('brands', function () {
        return view('admin.brand');
    })->name('admin.brand');
    Route::get('upgrade', function () {
        return view('admin.upgrade');
    })->name('admin.upgrade');
    
    Route::get('icons',[ProductController::class,'listView'])->name('admin.icons');
    // Route::get('maps',[ProductController::class,'getCategory'])->name('admin.maps');
    Route::get('fetch.category',[ProductController::class,'fetchCategory'])->name('fetch.category');
    Route::post('add.category',[ProductController::class,'storeCategory'])->name('add.category');
    Route::get('get.delete/{id}',[ProductController::class,'getDelete'])->name('get.delete');
    Route::delete('delete.category/{id}',[ProductController::class,'destroyCategory'])->name('destroy.category');
    Route::get('get_edit.category/{id}',[ProductController::class,'getEditCategory'])->name('getEdit.category');
    Route::put('update.category',[ProductController::class,'updateCategory'])->name('update.category');
    Route::get('view.category/{id}',[ProductController::class,'viewCategory'])->name('view.category');
    Route::get('fetch.brand',[ProductController::class,'fetchBrand'])->name('fetch.brand');
    Route::post('add.brand',[ProductController::class,'storeBrand'])->name('add.brand');
    
    Route::post('add.data',[ProductController::class,'storeBrand'])->name('add.data');
    Route::get('get.delete_brand/{id}',[ProductController::class,'getDeleteBrand'])->name('get.delete_brand');
    Route::delete('delete.brand/{id}',[ProductController::class,'destroyBrand'])->name('destroy.brand');
    Route::get('get_edit.brand/{id}',[ProductController::class,'getEditBrand'])->name('getEdit.brand');
    Route::post('update.brand',[ProductController::class,'updateBrand'])->name('update.brand');
    Route::get('view.brand/{id}',[ProductController::class,'viewBrand'])->name('view.brand');
    
    // RAM
    Route::get('fetch.ram',[ProductController::class,'fetchRam'])->name('fetch.ram');
    Route::post('add.ram',[ProductController::class,'storeRam'])->name('add.ram');
    // Route::post('add.data',[ProductController::class,'storeRam'])->name('add.data');
    Route::get('get.delete_ram/{id}',[ProductController::class,'getDeleteRam'])->name('get.delete_ram');
    Route::delete('delete.ram/{id}',[ProductController::class,'destroyRam'])->name('destroy.ram');
    Route::get('get_edit.ram/{id}',[ProductController::class,'getEditRam'])->name('getEdit.ram');
    Route::post('update.ram',[ProductController::class,'updateRam'])->name('update.ram');
    Route::get('view.ram/{id}',[ProductController::class,'viewRam'])->name('view.ram');
    
    //Processor
    
    Route::get('fetch.processor',[ProductController::class,'fetchProcessor'])->name('fetch.processor');
    Route::post('add.processor',[ProductController::class,'storeProcessor'])->name('add.processor');
    // Route::post('add.data',[ProductController::class,'storeProcessor'])->name('add.data');
    Route::get('get.delete_processor/{id}',[ProductController::class,'getDeleteProcessor'])->name('get.delete_processor');
    Route::delete('delete.processor/{id}',[ProductController::class,'destroyProcessor'])->name('destroy.processor');
    Route::get('get_edit.processor/{id}',[ProductController::class,'getEditProcessor'])->name('getEdit.processor');
    Route::post('update.processor',[ProductController::class,'updateProcessor'])->name('update.processor');
    // Route::get('view.ram/{id}',[ProductController::class,'viewProcessor'])->name('view.ram');
    Route::get('view.processor/{id}',[ProductController::class,'viewProcessor'])->name('view.processor');
    
    //OS
    
    Route::get('fetch.os',[ProductController::class,'fetchOs'])->name('fetch.os');
    Route::post('add.os',[ProductController::class,'storeOs'])->name('add.os');
    // Route::post('add.data',[ProductController::class,'storeos'])->name('add.data');
    Route::get('get.delete_os/{id}',[ProductController::class,'getDeleteos'])->name('get.delete_os');
    Route::delete('delete.os/{id}',[ProductController::class,'destroyos'])->name('destroy.os');
    Route::get('get_edit.os/{id}',[ProductController::class,'getEditos'])->name('getEdit.os');
    Route::post('update.os',[ProductController::class,'updateOs'])->name('update.os');
    // Route::get('view.ram/{id}',[ProductController::class,'viewOs'])->name('view.os');
    Route::get('view.os/{id}',[ProductController::class,'viewOs'])->name('view.os');
    
    // storage_type
    Route::get('fetch.storage_type',[ProductController::class,'fetchStorageType'])->name('fetch.storage_type');
    Route::post('add.storage_type',[ProductController::class,'storeStorageType'])->name('add.storage_type');
    // Route::post('add.data',[ProductController::class,'storeos'])->name('add.data');
    Route::get('get.delete_storage_type/{id}',[ProductController::class,'getDeleteStorageType'])->name('get.delete_storage_type');
    Route::delete('delete.storage_type/{id}',[ProductController::class,'destroyStorageType'])->name('destroy.storage_type');
    Route::get('get_edit.storage_type/{id}',[ProductController::class,'getEditStorageType'])->name('getEdit.storage_type');
    Route::post('update.storage_type',[ProductController::class,'updateStorageType'])->name('update.storage_type');
    Route::get('view.storage_type/{id}',[ProductController::class,'viewStorageType'])->name('view.StorageType');
    Route::get('view.storage_type/{id}',[ProductController::class,'viewStorageType'])->name('view.storage_type');
    Route::post('get.type',[ProductController::class,'getType'])->name('get.type');
    
    // storage 
    
    Route::get('fetch.storage',[GetViewController::class,'fetchStorageType'])->name('fetch.storage');
    Route::get('storage',[GetViewController::class,'getStorageType'])->name('component.storage');
    
    Route::post('add.storage',[GetViewController::class,'storeStorage'])->name('add.storage');
    // Route::post('add.data',[GetViewController::class,'storeos'])->name('add.data');
    Route::get('get.delete_storage/{id}',[GetViewController::class,'getDeleteStorage'])->name('get.delete_storage');
    Route::delete('delete.storage/{id}',[GetViewController::class,'destroyStorage'])->name('destroy.storage');
    Route::get('get_edit.storage/{id}',[GetViewController::class,'getEditStorage'])->name('getEdit.storage');
    Route::post('update.storage',[GetViewController::class,'updateStorage'])->name('update.storage');
    Route::get('view.storage/{id}',[GetViewController::class,'viewStorage'])->name('view.Storage');
    Route::get('view.storage/{id}',[GetViewController::class,'viewStorage'])->name('view.storage');
    // Route::post('get.type',[GetViewController::class,'getType'])->name('get.type');
    
    Route::get('fetch.graphic_card',[ProductController::class,'fetchGraphicCard'])->name('fetch.graphic_card');
    Route::post('add.graphic_card',[ProductController::class,'storeGraphicCard'])->name('add.graphic_card');
    
    Route::post('add.data',[ProductController::class,'storeGraphicCard'])->name('add.data');
    Route::get('get.delete_graphic_card/{id}',[ProductController::class,'GetDeletegraphicCard'])->name('get.delete_graphic_card');
    Route::delete('delete.graphic_card/{id}',[ProductController::class,'destroyGraphicCard'])->name('destroy.graphic_card');
    Route::get('get_edit.graphic_card/{id}',[ProductController::class,'getEditGraphicCard'])->name('getEdit.graphic_card');
    Route::post('update.graphic_card',[ProductController::class,'updateGraphicCard'])->name('update.graphic_card');
    Route::get('view.graphic_card/{id}',[ProductController::class,'viewGraphicCard'])->name('view.graphic_card');
    
    Route::get('fetch.discount',[DiscountController::class,'fetchDiscount'])->name('fetch.discount');
    Route::post('add.discount',[DiscountController::class,'storeDiscount'])->name('add.discount');
    Route::get('get.delete_discount/{id}',[DiscountController::class,'getDelete'])->name('get.delete');
    Route::delete('delete.discount/{id}',[DiscountController::class,'destroyDiscount'])->name('destroy.discount');
    Route::get('get_edit.discount/{id}',[DiscountController::class,'getEdit'])->name('get_edit.discount');
    Route::post('update.discount',[DiscountController::class,'updateDiscount'])->name('update.discount');
    Route::get('view.discount/{id}',[DiscountController::class,'viewDiscount'])->name('view.discount');
    Route::get('logout',[ControllerAdmin::class,'logout'])->name('logout');
    
    
    

});
