<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\PharmacistsController;
use App\Http\Controllers\PrescriptionsController;
use App\Http\Controllers\DoctorVisitsController;
use App\Http\Controllers\DrugsController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::post('/login',function(Request $request){
//     if($request->name =="hassan" & $request->password ==12345)
//     {return "your welcome ".$request->name;}
//     else{
//         return "dear ".$request->name. " your not registring in our site";
//     }
// });
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::resource('doctors',DoctorsController::class);
    
    Route::get('/doctors/search/{specialty}',[DoctorsController::class,'search']);
    Route::resource('patients',PatientsController::class);
    Route::get('/patients/search/{name}',[PatientsController::class,'search']);
    Route::resource('pharmacists',PharmacistsController::class);
    Route::get('/pharmacists/search/{address}',[PharmacistsController::class,'search']);
    Route::resource('prescriptions',PrescriptionsController::class);
    Route::get('/prescriptions/search/{patient_id}',[PrescriptionsController::class,'search']);
    Route::get('/prescriptions/prescriptionsValue/{patient_id}/{dateStart}/{dateEnd}',[PrescriptionsController::class,'prescriptionsValue']);
    Route::resource('drugs',DrugsController::class);
    Route::get('/drugs/search/{patient_id}',[DrugsController::class,'search']);
    Route::resource('doctorVisits',DoctorVisitsController::class);
    Route::get('/doctorVisits/search/{patient_id}/{dateStart}/{dateEnd}',[DoctorVisitsController::class,'search']);
    Route::post('/logout',[AuthController::class,'logout']);

});
Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});
// Route::post('/doctors',[DoctorsController::class,'store']);
// Route::post('/doctors',[DoctorsController::class,'store']);
// Route::post('/doctors',[DoctorsController::class,'store']);