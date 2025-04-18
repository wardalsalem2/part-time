<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteJobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\JobOffersController;
use App\Http\Controllers\Admin\JobApplicationsController;
use App\Http\Controllers\Company\CompanyAdminController;
use App\Http\Controllers\Company\CompanyJobOfferController;
use App\Http\Controllers\Company\CompanyJobApplicationController;




Route::middleware(['role:1'])->get('/homepage', [UserController::class, 'index'])->name('user.home');
Route::middleware(['role:3'])->get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//------------------------------------------------------------------------------------------------------------------------
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/gologin', [LoginController::class, 'login'])->name('goLogin');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

//------------------------------------for contact -------------------------------------------------------------------------

Route::get('/contact', [ContactController::class, 'create'])->name('contactCreate');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


//-------------------------------  Job offers routes ----------------------------------------------------------------------

Route::get('/job-offers', [JobOfferController::class, 'index'])->name('jobOffersIndex');
Route::get('/job-offers/{jobOffer}', [JobOfferController::class, 'show'])->name('jobOffersDetails');
Route::get('/', [JobOfferController::class, 'showhome'])->name('homepage');

//----------------------------------  for navbar   -----------------------------------------------------------------------------

Route::get('/home#about', [HomepageController::class, 'showAbout'])->name('home.about');
Route::get('/home#services', [HomepageController::class, 'showServices'])->name('home.services');

//--------------------------------- jop applycation --------------------------------------------------------------////

Route::middleware(['auth'])->group(function () {
    Route::get('/job-offers/{id}/apply', [JobApplicationController::class, 'create'])->name('jobApplications.create');
    Route::post('/job-applications', [JobApplicationController::class, 'store'])->name('jobApplications.store');

});

//------------------------- cancel Job Application ---------------------------------------------

Route::delete('profile_user/cancelJobApplication/{id}', [UserController::class, 'cancelJobApplication'])
    ->name('profile_user.cancelJobApplication');


//------------------------------- profiles page ---------------------------------------------------------------------

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


//------------------------------- favorite job ---------------------------------------------------------------------



Route::middleware(['auth'])->group(function () {
    Route::post('/job-offers/{jobOffer}/favorite', [FavoriteJobController::class, 'store'])->name('favorites.store');
    Route::delete('/job-offers/{jobOffer}/unfavorite', [FavoriteJobController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/my-favorites', [FavoriteJobController::class, 'index'])->name('favorites.index');
});

//--------------------------- company pages ---------------------------------------------------------------------
Route::middleware(['role:2'])->prefix('company')->name('company.')->group(function () {

    // --------------------------- Dashboard ---------------------------
    Route::get('/', [CompanyAdminController::class, 'index'])->name('dashboard');

    // --------------------------- Job Offers ---------------------------

    Route::resource('job-offers', CompanyJobOfferController::class);
    Route::post('job-offers/{id}/toggle-status', [CompanyJobOfferController::class, 'toggleStatus'])->name('job-offers.toggle-status');
    Route::get('company/job-offers/{id}', [CompanyJobOfferController::class, 'show'])->name('company.job-offers.show');


    // --------------------------- Job Applications ---------------------------
    Route::get('applications', [CompanyJobApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{id}', [CompanyJobApplicationController::class, 'show'])->name('applications.show');
    Route::post('applications/{id}/accept', [CompanyJobApplicationController::class, 'accept'])->name('applications.accept');
    Route::post('applications/{id}/reject', [CompanyJobApplicationController::class, 'reject'])->name('applications.reject');
    Route::delete('applications/{id}', [CompanyJobApplicationController::class, 'destroy'])->name('applications.destroy');
    Route::post('/company/applications/{id}/set-pending', [CompanyJobApplicationController::class, 'setPending'])
        ->name('applications.setPending');

    Route::get('/company/{job?}', [CompanyJobApplicationController::class, 'index'])
        ->name('applications.applications');
    Route::get('company/applications/{id}/reject-email', [CompanyJobApplicationController::class, 'rejectEmail'])->name('applications.rejectEmail');
    Route::post('/company/applications/{id}/reject-email', [CompanyJobApplicationController::class, 'sendRejectEmail'])
    ->name('applications.sendRejectEmail');

    // --------------------------- Profile ---------------------------
    Route::get('profile', [CompanyAdminController::class, 'profile'])->name('profile');
    Route::get('profile/edit', [CompanyAdminController::class, 'editprofile'])->name('profile.edit');
    Route::post('profile/update', [CompanyAdminController::class, 'updateprofile'])->name('profile.update');
});


//-------------------
// Route::get('/test-email', function() {
//     Mail::raw('This is a test email', function ($message) {
//         $message->to('partjop77@gmail.com')
//                 ->subject('Test Email');
//     });
//     return 'Email Sent';
// });


//----------------------------- admin pages ----------------------------------------------------

//------------------------------ admin users -----------------------------------------------------

Route::middleware(['role:3'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('users', UsersController::class);
    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');


    Route::put('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');
    Route::put('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
});


//---------------------------- admin  companies ------------------------------------------------------


Route::middleware(['role:3'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('companies', [CompaniesController::class, 'index'])->name('companies.index');
    Route::get('companies/{id}', [CompaniesController::class, 'show'])->name('companies.show');
    Route::get('companies/{id}/edit', [CompaniesController::class, 'edit'])->name('companies.edit');
    Route::put('companies/{id}', [CompaniesController::class, 'update'])->name('companies.update');
    Route::post('companies/{id}/approve', [CompaniesController::class, 'approve'])->name('companies.approve');
    Route::post('companies/{id}/disable', [CompaniesController::class, 'disable'])->name('companies.disable');
    Route::delete('companies/{id}', [CompaniesController::class, 'destroy'])->name('companies.destroy');

});


//------------------------------ admin jobOffer --------------------------------------------------------------------------

Route::prefix('admin')->middleware(['role:3'])->group(function () {
    Route::get('/job-offers', [JobOffersController::class, 'index'])->name('admin.job_offers.index');
    Route::get('/job-offers/{id}', [JobOffersController::class, 'show'])->name('admin.job_offers.show');
    Route::get('/job-offers/{id}/edit', [JobOffersController::class, 'edit'])->name('admin.job_offers.edit');
    Route::put('/job-offers/{id}', [JobOffersController::class, 'update'])->name('admin.job_offers.update');
    Route::post('/job-offers/{id}/toggle', [JobOffersController::class, 'toggleStatus'])->name('admin.job_offers.toggle');
    Route::delete('/job-offers/{id}', [JobOffersController::class, 'destroy'])->name('admin.job_offers.destroy');
});

//--------------------------- admin job application ---------------------------------------------------------------------

Route::prefix('admin')->middleware(['role:3'])->group(function () {
    Route::get('/job-applications', [JobApplicationsController::class, 'index'])->name('admin.job_applications.index');
    Route::get('/job-applications/{id}', [JobApplicationsController::class, 'show'])->name('admin.job_applications.show');
    Route::post('/job-applications/{id}/toggle/{newStatus}', [JobApplicationsController::class, 'toggleStatus'])->name('admin.job_applications.toggleStatus');

    Route::post('/job-applications/{id}/accept', [JobApplicationsController::class, 'accept'])->name('admin.job_applications.accept');
    Route::post('/job-applications/{id}/reject', [JobApplicationsController::class, 'reject'])->name('admin.job_applications.reject');
    Route::delete('/job-applications/{id}', [JobApplicationController::class, 'destroy'])->name('admin.job_applications.destroy');

    //--------------------------------------- for contact page admin --------------------------------------

    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

});




