<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/admin/adminlogin', [AdminController::class, 'adminloginview'])->name('admin.adminlogin');
Route::post('/admin/adminlogin', [AdminController::class, 'adminlogin'])->name('admin.adminlogin');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::middleware(['auth:admin'])->group(function () {


    // DASHBOARD============================================================================================================
    Route::get('/admin/admindashboard', [AdminController::class, 'dashboard'])->name('admin.admindashboard');

    // INVENTORY============================================================================================================
   Route::get('/admin/inventory', [AdminController::class, 'inventory'])
    ->name('admin.inventory');

Route::get('/get-category/{tool_class_id}', [AdminController::class, 'gettoolcategory']);

Route::post('/admin/inventory', [AdminController::class, 'storetools'])
    ->name('admin.storetools');
    Route::get('/admin/tool', [admincontroller::class, 'searchtools'])->name('admin.inventory');
    Route::get('/delete-tools/{id}', [admincontroller::class, 'deletetools'])->name('deletetools');
    Route::get('/edit-tool/{id}', [admincontroller::class, 'edittools'])->name('edittools');
    Route::put('/update-tool/{id}', [admincontroller::class, 'updatetools'])->name('admin.updatetools');


//=========================================================================================================================
  //SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP
  //SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP
  //SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP
  //SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP
  //SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP
  //SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP SET-UP
//=========================================================================================================================

    // SETUP FOR CLASSIFICATION======================================================================================================
    Route::get('/admin/setup/tool_class', [admincontroller::class, 'toolclass'])->name('admin.setup.tool_class_su');
    Route::post('/admin/setup/tool_class', [admincontroller::class, 'storeclass'])->name('admin.setup.storeclass');
    Route::get('/admin/setup/tool_class', [admincontroller::class, 'searchclass'])->name('admin.setup.tool_class_su');
    Route::get('/delete-tool_class/{id}', [admincontroller::class, 'deleteclass'])->name('deleteclass');
    Route::get('/edit-tool_class/{id}', [admincontroller::class, 'editclass'])->name('editclass');
    Route::put('/update-tool_class/{id}', [admincontroller::class, 'updateclass'])->name('updateclass');

    // SETUP FOR CATEGORY============================================================================================================
    Route::get('/admin/setup/tool_cat', [admincontroller::class, 'toolcategory'])->name('admin.setup.tool_cat_su');
    Route::post('/admin/setup/tool_cat', [admincontroller::class, 'storecategory'])->name('admin.setup.storecategory');
    Route::get('/admin/setup/tool_cat', [admincontroller::class, 'searchcategory'])->name('admin.setup.tool_cat_su');
    Route::get('/delete-tool_cat/{id}', [admincontroller::class, 'deletecategory'])->name('deletecategory');
    Route::get('/edit-tool_cat/{id}', [admincontroller::class, 'editcategory'])->name('editcategory');
    Route::put('/update-tool_cat/{id}', [admincontroller::class, 'updatecategory'])->name('updatecategory');

 // SETUP FOR BORROWER PROFILE======================================================================================================
   Route::get('/admin/setup/profile', [admincontroller::class, 'searchborrower'])
    ->name('admin.setup.borrower_profile');

Route::post('/admin/setup/profile', [admincontroller::class, 'storeborrower'])
    ->name('admin.setup.storeborrower');

Route::get('/delete-profile/{id}', [admincontroller::class, 'deleteborrower'])
    ->name('admin.setup.deleteborrower');

Route::put('/update-profile/{id}', [admincontroller::class, 'updateborrower'])
    ->name('admin.setup.updateborrower');

   // SETUP FOR SUPPLIER======================================================================================================
    Route::get('/admin/setup/supplier', [admincontroller::class, 'toolsupplier'])->name('admin.setup.supplier');
    Route::post('/admin/setup/supplier', [admincontroller::class, 'storesupplier'])->name('admin.setup.storesupplier');
    Route::get('/admin/setup/supplier', [admincontroller::class, 'searchsupplier'])->name('admin.setup.supplier');
    Route::get('/delete-supplier/{id}', [admincontroller::class, 'deletesupplier'])->name('deletesupplier');
    Route::get('/edit-supplier/{id}', [admincontroller::class, 'editsupplier'])->name('editsupplier');
    Route::put('/update-supplier/{id}', [admincontroller::class, 'updatesupplier'])->name('updatesupplier');








});

Route::middleware(['empty.auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/register', [admincontroller::class, 'adminregister'])->name('adminregister');
        Route::post('/store', [admincontroller::class, 'storenewadmin'])->name('storenewadmin');
    });
});

Route::get('/admin/sidebar', [admincontroller::class, 'adminsidebar'])->name('admin.sidebar');
