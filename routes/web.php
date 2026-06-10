<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeletedDatenList;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\MaterialListController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TotalPageController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\RechnerApp;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RememberController;
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

// Authentication routes
Route::get('/login', function () {
    return view('/login');
});

Route::post('login', [LoginController::class, 'login']);

Route::get('logout', [LogoutController::class, 'logout']);
Route::post('logout', [LogoutController::class, 'logout']);

Route::post('register', [LoginController::class, 'register']);

Route::post('resetpassword', [LoginController::class, 'resetPassword']);

Route::get('/register', function () {
    return view('register');
});

Route::get('/resetpassword', function () {
    return view('resetpassword');
});


Route::group(['middleware'=> 'mygroub'],function () {

    Route::get('/', function () {
        return view('/home');
    });

    //DatenBank the deleted Materials
    Route::get('/datenbank/deleted_material', [DeletedDatenList::class, 'index']);

    // Display edit form
    Route::get('/edit/{id}', [MaterialListController::class, 'index']);
    Route::get('/add/add', [MaterialListController::class, 'viewAdd',]);
    Route::get('/rechner/rechner', [RechnerApp::class, 'viewRechner',]);
    Route::get('/home', [MaterialsController::class, 'index']);
    
});


// To change the Number of Rows 
Route::post('/home', [TotalPageController::class, 'changeTotalPage']);


Route::post('/rechner/rechner', [RechnerApp::class, 'calculate']);
Route::post('/rechner/rechnerreset', [RechnerApp::class, 'changeOrResetRechnerValue']);
// Route::get('/rechner/rechnermsg', [RechnerApp::class, 'addToRememberList']);


// Handle form submission for updating a material
Route::post('/edit/{id}', [MaterialsController::class, 'update']);


// Route::get('/material/{id}', [MaterialsController::class, 'delete']);
Route::post('/home/{id}', [MaterialsController::class, 'deleteMaterial']);
// search in the Materials Table
Route::post('/search', [MaterialsController::class, 'search'])->name('search');

//List Material
Route::post('/add/add', [MaterialsController::class, 'add']);
Route::post('/addtolist/add', [MaterialListController::class, 'addToList']);
Route::post('/addtolist/add/{id}', [MaterialListController::class, 'deleteFromList']);


//Deleted Material 
// Route::post('/datenbank/deleted_material{id}', [DeletedDatenList::class, 'restore']);
// Deleted Material 
// Route::post('/datenbank/deleted_material/{id}', [DeletedDatenList::class, 'restore']);
Route::get('/datenbank/deleted_material/{id}', [DeletedDatenList::class, 'restore'])->name('restore.material');


//Status of Users
Route::get('/status/userstatus',[StatusController::class, 'index']);
Route::post('/status/userstatus/{userId}/{isActive}', [StatusController::class, 'changeActive'])->name('user.status.change');
Route::post('/status/userstatus/{id}', [StatusController::class, 'deleteUser']);





//Chart
Route::get('diagramme/chart', [ChartController::class, 'index']);
Route::post('diagramme/chart', [ChartController::class, 'changeAndResetPfostenValue']);
Route::post('diagramme/chartmatten', [ChartController::class, 'changeAndResetMattenValue']);
Route::post('diagramme/charteck', [ChartController::class, 'changeAndResetEckValue']);


//examlpe
Route::get('/example', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'update']);


//Remember
Route::get('/remember/rememberlist', [RememberController::class, 'index']);
Route::post('/remember/rememberlist', [RememberController::class, 'delete']);
Route::get('remember/rememberlist/{id}', [RememberController::class, 'update']);


//Pdf
Route::get('/materials/pdf', [PdfController::class, 'generatePdf'])
    ->name('materials.pdf');

Route::get('/phpinfo-test', function () {
    phpinfo();
}); 