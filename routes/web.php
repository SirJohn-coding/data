<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\SummaryRentalController;
use App\Http\Controllers\AllmangaController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\VolumesController;
use App\Http\Controllers\HistoryRentalController;

//----------------------------Admin_จัดการบัญชีผู้ใช้--------------------------------//
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ManageUserController;

//----------------------------Admin_จัดการมังงะ--------------------------------//
use App\Http\Controllers\SearchMangaController;
use App\Http\Controllers\CreateMangaController;

use App\Http\Controllers\ViewMangaController;
use App\Http\Controllers\AddMangaController;

use App\Http\Controllers\UpdateMangaController;
use App\Http\Controllers\UpdateVolumesController;

//----------------------------Admin_จัดการคำสั่งเช่า--------------------------------//
use App\Http\Controllers\ManageOrdersController;
use App\Http\Controllers\OrderDetailsController;

//----------------------------Admin_อัปเดตมังงะ--------------------------------//
use App\Http\Controllers\UpdateController;

//----------------------------Admin_ค่าย/ประเภท--------------------------------//
use App\Http\Controllers\PubilsherTypeController;

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


// หน้าหลัก
Route::get('HomePage', [MangaController::class, "HomePage"]);
Route::get('/', [MangaController::class, "HomePage"]);
// หน้ามังงะทั้งหมด
Route::get('/AllmangaPage', [AllmangaController::class, "AllmangaPage"]);
// ประวัติ
Route::post('/rentals', [RentalsController::class, 'storedetail'])->name('rentals.storedetail');
//FAQ
Route::get('FAQ', [FAQController::class, "FAQ"]);
//Search bar
Route::get('/Search', [MangaController::class, 'Search']);

// -----------ตะกร้าสินค้า-----------
Route::get('/ShowBasket',[BasketController::class,'ShowBasket'])->name('Basketmanga.ShowBasket');
Route::post('/ShowBasket/list', [BasketController::class, 'Checkout'])->name('Basketmanga.list');
Route::get('/ShowBasket/DeleteVolumes/{id}', [BasketController::class, 'DeleteVolumes'])->name('Basketmanga.DeleteVolumes');

// -----------สรุปคำสั่งเช่า-----------
Route::get('/summaryrental',[SummaryRentalController::class,'SummaryRental'])->name('summaryrental.SummaryRental');
Route::post('/summaryrental/confirmrental',[SummaryRentalController::class,'ConfirmRental'])->name('summaryrental.ConfirmRental');
// ลอง prfile


//Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//หน้าบัญชี
route::get('/home',[HomeController::class,'index']);
    Route::post('/rentals', [RentalsController::class, 'store'])->name('rentals.store');

// กำหนด route สำหรับ rental.details
Route::get('rentals/details/{id}', [RentalsController::class, 'show'])->name('rentals.details');


Route::get('/manga/{id}/volumes', [VolumesController::class, 'show'])->name('mangas.showVolumes');
//ประวัติ
Route::get('/History', [HistoryRentalController::class, 'history']);

//---------------------------------------------------------------Admin-----------------------------------------------------------------------//


//---------------------------------------------------------Admin_จัดการบัญชีผู้ใช้----------------------------------------------------------------//

Route::get('/manage',[ManageController::class,'Home_Manage'])->name('manage.Home_Manage'); 
Route::get('/manage/search', [ManageController::class, 'search'])->name('manage.search'); 
Route::get('/manage/{id}', [ManageController::class, 'show'])->name('manage.show');

Route::delete('/manage/user/{id}', [ManageUserController::class, 'delete'])->name('user.delete');
Route::post('/manage/user/unban/{id}', [ManageUserController::class, 'unban'])->name('user.unban');
Route::post('/manage/user/ban/{id}', [ManageUserController::class, 'ban'])->name('user.ban');

//---------------------------------------------------------Admin_จัดการมังงะ-------------------------------------------------------------------//

Route::get('/searchmanga',[SearchMangaController::class,'Home_SearchManga'])->name('searchmanga.Home_SearchManga');
Route::get('/searchmanga/search-manga',[SearchMangaController::class,'SearchManga'])->name('searchmanga.SearchManga');

Route::get('/createmanga',[CreateMangaController::class,'Home_CreateManga'])->name('createmanga.Home_CreateManga');
Route::get('/createmanga/search-manga',[CreateMangaController::class,'SearchManga'])->name('createmanga.SearchManga');
Route::post('/createmanga/create-manga',[CreateMangaController::class,'CreateManga'])->name('createmanga.CreateManga');

Route::get('/viewmanga',[ViewMangaController::class,'Home_ViewManga'])->name('viewmanga.Home_ViewManga');
Route::get('/viewmanga/{id}', [ViewMangaController::class, 'show'])->name('viewmanga.show');
Route::get('/viewmanga/add-manga/{id}', [ViewMangaController::class, 'Addshow'])->name('viewmanga.Addshow');
Route::get('/viewmanga/searchmanga/{id}', [ViewMangaController::class, 'SearchManga'])->name('viewmanga.SearchManga');

Route::post('/addmanga/add-Manga',[AddMangaController::class,'AddManga'])->name('addmanga.AddManga');

Route::get('/updatemanga/show/{id}', [UpdateMangaController::class, 'ShowManga'])->name('updatemanga.ShowManga');
Route::post('/updatemanga/edit/{id}', [UpdateMangaController::class, 'EditManga'])->name('updatemanga.EditManga');
Route::get('/updatemanga/delete/{id}', [UpdateMangaController::class, 'DeleteManga'])->name('updatemanga.DeleteManga');

Route::get('/updatevolumes/show/{id}', [UpdateVolumesController::class, 'ShowVolumes'])->name('updatevolumes.ShowVolumes');
Route::post('/updatevolumes/edit/{id}', [UpdateVolumesController::class, 'EditVolumes'])->name('updatevolumes.EditVolumes');
Route::get('/updatevolumes/delete/{id}', [UpdateVolumesController::class, 'DeleteVolumes'])->name('updatevolumes.DeleteVolumes');
Route::get('/updatevolumes/updatevolumes/{id}', [UpdateVolumesController::class, 'UpdateVolumes'])->name('updatevolumes.UpdateVolumes');

//---------------------------------------------------------Admin_อัปเดตมังงะ-------------------------------------------------------------------//

Route::get('/update', [UpdateController::class, 'Home_Upate'])->name('Update.Home_Upate');
Route::get('/update/searchvolumes', [UpdateController::class, 'SearchVolumes'])->name('Update.SearchVolumes');
Route::post('/update/updatevolumes/{id}', [UpdateController::class, 'UpdateVolumes'])->name('Update.UpdateVolumes');

//---------------------------------------------------------Admin_จัดการคำสั่งเช่า-------------------------------------------------------------------//
Route::get('/manageorders', [ManageOrdersController::class, 'Home_ManageOrders'])->name('ManageOrders.Home_ManageOrders');
Route::get('/manageorders/Search-Orders', [ManageOrdersController::class, 'Search_Orders'])->name('ManageOrders.Search_Orders');
Route::post('/manageorders/Update-Orders', [ManageOrdersController::class, 'Update_Orders'])->name('ManageOrders.Update_Orders');

Route::get('/orderdetails/{id}', [OrderDetailsController::class, 'Home_OrderDetails'])->name('OrderDetails.Home_OrderDetails');
Route::get('/orderdetails/cancelorder/{id}', [OrderDetailsController::class, 'CancelOrder'])->name('OrderDetails.CancelOrder');


//---------------------------------------------------------Admin_ค่าย/ประเภท-------------------------------------------------------------------//

Route::get('/adders', [PubilsherTypeController::class, 'Home_Pubilsher_Type'])->name('adders.Home_Pubilsher_Type');
Route::post('/adders/add-type/{id}' ,[PubilsherTypeController::class ,'storetype'])->name('addtype');
Route::post('/adders/add-publisher/{id}' ,[PubilsherTypeController::class ,'storePublisher'])->name('addpublisher');


//-------------------------------------------------------------------------------------------------------------------------------------------//




