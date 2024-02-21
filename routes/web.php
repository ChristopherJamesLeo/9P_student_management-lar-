<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollsController;
use App\Http\Controllers\EdulinksController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\UsersController;


// Route::get('/', function () {
//     return view('/dashboard');
// })->middleware(['auth', 'verified']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/auth/{provider}/redirect',[SocialiteController::class,"redirect"]);
 
Route::get('/auth/{provider}/callback', [SocialiteController::class,"callback"]);


Route::middleware('auth')->group(function () {

    Route::get("/",[DashboardController::class,"index"])->name("dashboard.index");
    Route::put("/update/{id}",[DashboardController::class,"update"])->name("dashboard.update");

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('announcements',AnnouncementsController::class);
    Route::get('announcement/markread',[AnnouncementsController::class,"markednoti"])->name("announcement.markread");

    Route::resource('attendances',AttendancesController::class);


    Route::resource('cities',CitiesController::class);
    Route::get('/citystatus',[CitiesController::class,"citystatus"]);

    Route::resource('countries',CountriesController::class);
    Route::get('/countrystatus',[CountriesController::class,"countrystatus"]);


    Route::resource('days',DaysController::class);
    Route::get('/daystatus',[DaysController::class,"daystatus"]);

    Route::resource('enrolls',EnrollsController::class);

    Route::resource('edulinks',EdulinksController::class);
    Route::get('/edulinkstatus',[DaysController::class,"edulinkstatus"]);


    Route::resource('genders',GendersController::class);
    Route::get('/genderstatus',[GendersController::class,"genderstatus"]);

    Route::resource('leaves',LeavesController::class);

    Route::resource('posts',PostsController::class);
    Route::get('/poststatus',[PostsController::class,"poststatus"]);

    Route::resource('roles',RolesController::class);
    Route::get('/rolestatus',[RolesController::class,"rolestatus"]);

    Route::resource('statuses',StatusController::class);

    Route::resource('stages',StagesController::class);
    Route::get('/stagestatus',[StagesController::class,"stagestatus"]);

    Route::resource('tags',TagsController::class);
    Route::get('/changestatus',[TagsController::class,"changestatus"]);

    Route::resource('types',TypesController::class);
    Route::get('/typestatus',[TypesController::class,"typestatus"]);

    Route::resource('users',UsersController::class);
    Route::get('/userstatus',[UsersController::class,"userstatus"]);
    Route::post('/usersendemail',[UsersController::class,"usersendemail"])->name('user.sendemail');


});

require __DIR__.'/auth.php';
