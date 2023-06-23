<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('bill.create'));
});


Route::get('bill/create',[App\Http\Controllers\BillController::class,'create'])->name('bill.create');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// itemvalue

Route::post('itemvalue',function(){
    $rate = \App\Models\Item::find(request()->id)->rate;

    return response()->json(['rate' => $rate]);
})->name('itemvalue');



Route::post('/getcustomer',function(){




    $customer = \App\Models\Costumer::where('name', 'like', '%' . request()->name . '%')->first();

    return response()->json(['customer' => $customer]);
})->name('getcustomer');


Route::post('addcustomer',[App\Http\Controllers\BillController::class,'addcustomer'])->name('addcustomer');


Route::post('bill/store',[App\Http\Controllers\BillController::class,'store'])->name('bill.store');
