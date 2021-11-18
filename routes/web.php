<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\IsMedicalCenter;
use App\Http\Middleware\IsJobSeeker;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/', [App\Http\Controllers\Front\FrontController::class, 'index'])->name('home');
Route::get('/jobs', [App\Http\Controllers\Front\JobController::class, 'index'])->name('job');
Route::get('/about-us', [App\Http\Controllers\Front\AboutController::class, 'index'])->name('aboutus');
Route::get('/contact-us', [App\Http\Controllers\Front\ContactController::class, 'index'])->name('contactus');
Route::post('/contact-us', [App\Http\Controllers\Front\ContactController::class, 'store'])->name('contactus.send');

Route::post('/newsletter', [App\Http\Controllers\Front\NewsletterController::class, 'store'])->name('newsletter');

// Route::get('/jobdetails', [App\Http\Controllers\Front\JobDetailController::class, 'index'])->name('jobdetails');

Route::get('/jobdetails/{slug}', [App\Http\Controllers\Front\JobDetailController::class, 'show'])->name('jobdetails');


Route::get('/buy-sell', [App\Http\Controllers\Front\BuySellController::class, 'index'])->name('buysell');

// Job Application Module
Route::post('/job/quickapply', [App\Http\Controllers\Front\JobApplicationController::class, 'quickapply'])->name('quickapply');
Route::get('/job/apply/{id}', [App\Http\Controllers\Front\JobApplicationController::class, 'apply'])->name('apply');
// Route::post('/job/application/store', [App\Http\Controllers\Front\JobApplicationController::class, 'storeapplication'])->name('storeapplication')->middleware(['auth', 'jobseeker']);
Route::post('/job/application/store', [App\Http\Controllers\Front\JobApplicationController::class, 'storeapplication'])->name('storeapplication');

Route::get('/job-search', [App\Http\Controllers\Front\JobController::class, 'search'])->name("front.job.search");
Route::get('/job-clearsearch', [App\Http\Controllers\Front\JobController::class, 'clearsearch'])->name("front.job.clearsearch");

// Buysell Search
Route::get('/buysell-search', [App\Http\Controllers\Front\BuySellController::class, 'search'])->name("front.buysell.search");
Route::get('/buysell-clearsearch', [App\Http\Controllers\Front\BuySellController::class, 'clearsearch'])->name("front.buysell.clearsearch");


// Job Achive Routes JobArchiveController
Route::get('/job-archive', [App\Http\Controllers\Front\JobArchiveController::class, 'index'])->name('jobarchive');
Route::get('/archived-job-detail/{slug}', [App\Http\Controllers\Front\JobArchiveController::class, 'show'])->name('jobarchivedetails');

// Route::get('/job/{id}', [App\Http\Controllers\Front\JobDetailController::class, 'index'])->name('job');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Jobseeker Registration Routes
Route::get('/jobseeker-register', [App\Http\Controllers\Front\JobSeekerRegistrationController::class, 'index'])->name('jobseeker.register');
Route::post('/jobseeker-register-store', [App\Http\Controllers\Front\JobSeekerRegistrationController::class, 'store'])->name('jobseeker.register.store');

// Medical Center Registration Routes
Route::get('/medical-center-register', [App\Http\Controllers\Front\MedicalCenterRegistrationController::class, 'register_form'])->name('medicalcenter.register');
Route::post('/medical-center-register-store', [App\Http\Controllers\Front\MedicalCenterRegistrationController::class, 'store'])->name('medicalcenter.register.store');

/** 
 * Authentication routes
 */

// Login route
Route::get(
    'login',
    [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']
)->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware("loginhistorystore");

// Registeration route
Route::get(
    'register',
    [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']
)->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Logout Route
Route::post(
    'logout',
    [App\Http\Controllers\Auth\LoginController::class, 'logout']
)->name('logout');

// Register the typical reset password routes for an application.
Route::get(
    'password/reset',
    [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm']
)->name('password.request');
Route::post(
    'password/email',
    [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail']
)->name('password.email');
Route::get(
    'password/reset/{token}',
    [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm']
)->name('password.reset');
Route::post(
    'password/reset',
    [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset']
)->name('password.update');


// Register the typical confirm password routes for an application.
Route::get(
    'password/confirm',
    [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm']
)->name('password.confirm');
Route::post(
    'password/confirm',
    [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']
)->name('password.update');

// Register the typical email verification routes for an application.
Route::get(
    'email/verify',
    [App\Http\Controllers\Auth\VerificationController::class, 'show']
)->name('verification.notice');
Route::get(
    'email/verify/{id}/{hash}',
    [App\Http\Controllers\Auth\VerificationController::class, 'verify']
)->name('verification.verify');
Route::post(
    'email/resend',
    [App\Http\Controllers\Auth\VerificationController::class, 'resend']
)->name('verification.resend');



// Route::middleware([EnsureTokenIsValid::class])->group(function () {
//     Route::get('/', function () {
//         //
//     });

//     Route::get('/profile', function () {
//         //
//     })->withoutMiddleware([EnsureTokenIsValid::class]);
// });
// Admin route for dashboard
Route::get('admin/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard')->middleware("loginhistorystore");;


Route::prefix('admin')->middleware([isAdmin::class, 'auth'])->group(function () {

    /**
     * Admin Panel Routes
     */

    // // Admin route for dashboard
    // Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');

    Route::prefix('sociallink')->group(function () {
        // Social Link
        Route::get('/edit', [App\Http\Controllers\Admin\SocialLinkController::class, 'edit'])->name('admin.sociallink.edit');
        Route::put('/update/{id}', [App\Http\Controllers\Admin\SocialLinkController::class, 'update'])->name('admin.sociallink.update');
    });

    // Route Group For Profession Module.
    Route::prefix('profession')->group(function () {
        // Profession Module
        Route::get('/create', [App\Http\Controllers\Admin\ProfessionController::class, 'create'])->name('admin.profession.create');
        Route::post('/store', [App\Http\Controllers\Admin\ProfessionController::class, 'store'])->name('admin.profession.store');
        Route::get('/{profession}/edit', [App\Http\Controllers\Admin\ProfessionController::class, 'edit'])->name('admin.profession.edit');
        Route::put('/update/{profession}', [App\Http\Controllers\Admin\ProfessionController::class, 'update'])->name('admin.profession.update');
        Route::get('/list', [App\Http\Controllers\Admin\ProfessionController::class, 'lists'])->name('admin.profession.list')->withoutMiddleware([isAdmin::class]);

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\ProfessionController::class, 'enable'])->name('admin.profession.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\ProfessionController::class, 'disable'])->name('admin.profession.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\ProfessionController::class, 'datatable']
        )->name('profession.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\ProfessionController::class, 'destroy']
        )->name('profession.delete');
    });

    // Route Group For Speciality Module.
    Route::prefix('specialty')->group(function () {
        Route::get('/create', [App\Http\Controllers\Admin\SpecialtyController::class, 'create'])->name('admin.specialty.create');
        Route::post('/store', [App\Http\Controllers\Admin\SpecialtyController::class, 'store'])->name('admin.specialty.store');
        Route::get('/{specialty}/edit', [App\Http\Controllers\Admin\SpecialtyController::class, 'edit'])->name('admin.specialty.edit');
        Route::put('/update/{specialty}', [App\Http\Controllers\Admin\SpecialtyController::class, 'update'])->name('admin.specialty.update');
        Route::get('/list', [App\Http\Controllers\Admin\SpecialtyController::class, 'lists'])->name('admin.specialty.list')->withoutMiddleware([isAdmin::class]);

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\SpecialtyController::class, 'enable'])->name('admin.specialty.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\SpecialtyController::class, 'disable'])->name('admin.specialty.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\SpecialtyController::class, 'datatable']
        )->name('specialty.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\SpecialtyController::class, 'destroy']
        )->name('specialty.delete');
    });

    // Route Group For Job Module.
    Route::prefix('job')->group(function () {

        // Job Module
        Route::get('/create', [App\Http\Controllers\Admin\JobController::class, 'create'])->name('admin.job.create');
        Route::post('/store', [App\Http\Controllers\Admin\JobController::class, 'store'])->name('admin.job.store');
        Route::get('/{job}/edit', [App\Http\Controllers\Admin\JobController::class, 'edit'])->name('admin.job.edit');
        Route::put('/update/{job}', [App\Http\Controllers\Admin\JobController::class, 'update'])->name('admin.job.update');
        Route::get('/list', [App\Http\Controllers\Admin\JobController::class, 'lists'])->name('admin.job.list')->withoutMiddleware([isAdmin::class]);
        Route::get('/show/{job}', [App\Http\Controllers\Admin\JobController::class, 'show'])->name('admin.job.show');

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\JobController::class, 'enable'])->name('admin.job.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\JobController::class, 'disable'])->name('admin.job.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\JobController::class, 'datatable']
        )->name('job.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\JobController::class, 'destroy']
        )->name('job.delete');
    });

    // Route Group For Job Type Module.
    Route::prefix('jobtype')->group(function () {
        // Job Type Module
        Route::get('/create', [App\Http\Controllers\Admin\JobTypeController::class, 'create'])->name('admin.jobtype.create');
        Route::post('/store', [App\Http\Controllers\Admin\JobTypeController::class, 'store'])->name('admin.jobtype.store');
        Route::get('/{jobtype}/edit', [App\Http\Controllers\Admin\JobTypeController::class, 'edit'])->name('admin.jobtype.edit');
        Route::put('/update/{jobtype}', [App\Http\Controllers\Admin\JobTypeController::class, 'update'])->name('admin.jobtype.update');
        Route::get('/list', [App\Http\Controllers\Admin\JobTypeController::class, 'lists'])->name('admin.jobtype.list')->withoutMiddleware([isAdmin::class]);

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\JobTypeController::class, 'enable'])->name('admin.jobtype.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\JobTypeController::class, 'disable'])->name('admin.jobtype.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\JobTypeController::class, 'datatable']
        )->name('jobtype.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\JobTypeController::class, 'destroy']
        )->name('jobtype.delete');
    });

    // Route Group For Job Category Module.
    Route::prefix('jobcategory')->group(function () {
        // Job Category Module
        Route::get('/create', [App\Http\Controllers\Admin\JobCategoryController::class, 'create'])->name('admin.jobcategory.create');
        Route::post('/store', [App\Http\Controllers\Admin\JobCategoryController::class, 'store'])->name('admin.jobcategory.store');
        Route::get('/{jobcategory}/edit', [App\Http\Controllers\Admin\JobCategoryController::class, 'edit'])->name('admin.jobcategory.edit');
        Route::put('/update/{jobcategory}', [App\Http\Controllers\Admin\JobCategoryController::class, 'update'])->name('admin.jobcategory.update');
        Route::get('/list', [App\Http\Controllers\Admin\JobCategoryController::class, 'lists'])->name('admin.jobcategory.list')->withoutMiddleware([isAdmin::class]);

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\JobCategoryController::class, 'enable'])->name('admin.jobcategory.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\JobCategoryController::class, 'disable'])->name('admin.jobcategory.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\JobCategoryController::class, 'datatable']
        )->name('jobcategory.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/trash/{id}',
            [App\Http\Controllers\Admin\JobCategoryController::class, 'destroy']
        )->name('jobcategory.trash');
    });

    // Route Group For State Module.
    Route::prefix('state')->group(function () {

        Route::get('/create', [App\Http\Controllers\Admin\StateController::class, 'create'])->name('admin.state.create');
        Route::post('/store', [App\Http\Controllers\Admin\StateController::class, 'store'])->name('admin.state.store');
        Route::get('/{state}/edit', [App\Http\Controllers\Admin\StateController::class, 'edit'])->name('admin.state.edit');
        Route::put('/update/{state}', [App\Http\Controllers\Admin\StateController::class, 'update'])->name('admin.state.update');
        Route::get('/list', [App\Http\Controllers\Admin\StateController::class, 'lists'])->name('admin.state.list')->withoutMiddleware([isAdmin::class]);;

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\StateController::class, 'enable'])->name('admin.state.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\StateController::class, 'disable'])->name('admin.state.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\StateController::class, 'datatable']
        )->name('state.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\StateController::class, 'destroy']
        )->name('state.delete');
    });

    // Route Group For State Module.
    Route::prefix('city')->group(function () {
        // Cities Module
        Route::get('/create', [App\Http\Controllers\Admin\CityController::class, 'create'])->name('admin.city.create');
        Route::post('/store', [App\Http\Controllers\Admin\CityController::class, 'store'])->name('admin.city.store');
        Route::get('/{city}/edit', [App\Http\Controllers\Admin\CityController::class, 'edit'])->name('admin.city.edit');
        Route::put('/update/{city}', [App\Http\Controllers\Admin\CityController::class, 'update'])->name('admin.city.update');
        Route::get('/list', [App\Http\Controllers\Admin\CityController::class, 'list'])->name('admin.city.list')->withoutMiddleware([isAdmin::class]);;

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\CityController::class, 'enable'])->name('admin.city.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\CityController::class, 'disable'])->name('admin.city.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\CityController::class, 'datatable']
        )->name('city.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\CityController::class, 'destroy']
        )->name('city.delete');
    });

    // Route group for contact module.
    Route::prefix('suburb')->group(function () {
        // Suburbs Module
        Route::get('/create', [App\Http\Controllers\Admin\SuburbController::class, 'create'])->name('admin.suburb.create');
        Route::post('/store', [App\Http\Controllers\Admin\SuburbController::class, 'store'])->name('admin.suburb.store');
        Route::get('/{suburb}/edit', [App\Http\Controllers\Admin\SuburbController::class, 'edit'])->name('admin.suburb.edit');
        Route::put('/update/{suburb}', [App\Http\Controllers\Admin\SuburbController::class, 'update'])->name('admin.suburb.update');
        Route::get('/list', [App\Http\Controllers\Admin\SuburbController::class, 'list'])->name('admin.suburb.list')->withoutMiddleware([isAdmin::class]);;

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\SuburbController::class, 'enable'])->name('admin.suburb.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\SuburbController::class, 'disable'])->name('admin.suburb.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\SuburbController::class, 'datatable']
        )->name('suburb.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\SuburbController::class, 'destroy']
        )->name('suburb.delete');
    });

    // Route group for contact module.
    Route::prefix('contact')->group(function () {
        // Contact Us Module
        Route::get('/list', [App\Http\Controllers\Admin\ContactController::class, 'lists'])->name('admin.contact.list')->withoutMiddleware([isAdmin::class]);

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\ContactController::class, 'enable'])->name('admin.contact.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\ContactController::class, 'disable'])->name('admin.contact.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\ContactController::class, 'datatable']
        )->name('contact.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\ContactController::class, 'destroy']
        )->name('contact.delete');
    });

    // Route Group For jobapplication Module.
    Route::prefix('jobapplication')->group(function () {
        // Job Module
        Route::get('/create', [App\Http\Controllers\Admin\JobApplicationController::class, 'create'])->name('admin.jobapplication.create');

        Route::post('/store', [App\Http\Controllers\Admin\JobApplicationController::class, 'store'])->name('admin.jobapplication.store');
        Route::get('/list', [App\Http\Controllers\Admin\JobApplicationController::class, 'lists'])->name('admin.jobapplication.list')->withoutMiddleware([isAdmin::class]);
        Route::get('/show/{jobapplication}', [App\Http\Controllers\Admin\JobApplicationController::class, 'show'])->name('admin.jobapplication.show');

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\JobApplicationController::class, 'enable'])->name('admin.jobapplication.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\JobApplicationController::class, 'disable'])->name('admin.jobapplication.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\JobApplicationController::class, 'datatable']
        )->name('jobapplication.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\JobApplicationController::class, 'destroy']
        )->name('jobapplication.delete');
    });

    // Route Group For buysell Module.
    Route::prefix('buysell')->group(function () {
        // Buy / Sell Module
        Route::get('/create', [App\Http\Controllers\Admin\BuySellController::class, 'create'])->name('admin.buysell.create');
        Route::post('/store', [App\Http\Controllers\Admin\BuySellController::class, 'store'])->name('admin.buysell.store');
        Route::get('/{buysell}/edit', [App\Http\Controllers\Admin\BuySellController::class, 'edit'])->name('admin.buysell.edit');
        Route::put('/update/{buysell}', [App\Http\Controllers\Admin\BuySellController::class, 'update'])->name('admin.buysell.update');
        Route::get('/list', [App\Http\Controllers\Admin\BuySellController::class, 'list'])->name('admin.buysell.list')->withoutMiddleware([isAdmin::class]);
        Route::get('/show/{buysell}', [App\Http\Controllers\Admin\BuySellController::class, 'show'])->name('admin.buysell.show');

        Route::get('/enable/{id}', [App\Http\Controllers\Admin\BuySellController::class, 'enable'])->name('admin.buysell.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\BuySellController::class, 'disable'])->name('admin.buysell.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\BuySellController::class, 'datatable']
        )->name('buysell.datatables')->withoutMiddleware([isAdmin::class]);

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\BuySellController::class, 'destroy']
        )->name('buysell.delete');
    });

    Route::prefix('newsletter')->group(function () {
        // Newsletter Module
        Route::get('/list', [App\Http\Controllers\Admin\NewsletterController::class, 'lists'])->name('admin.newsletter.list');
        Route::get('/enable/{id}', [App\Http\Controllers\Admin\NewsletterController::class, 'enable'])->name('admin.newsletter.enable');
        Route::get('/disable/{id}', [App\Http\Controllers\Admin\NewsletterController::class, 'disable'])->name('admin.newsletter.disable');

        Route::get(
            '/datatable',
            [App\Http\Controllers\Admin\NewsletterController::class, 'datatable']
        )->name('newsletter.datatables');

        Route::get(
            '/delete/{id}',
            [App\Http\Controllers\Admin\NewsletterController::class, 'destroy']
        )->name('newsletter.delete');
    });

    // About Us Page
    Route::get('/about', [App\Http\Controllers\Admin\AboutController::class, 'edit'])->name('admin.about.edit');
    Route::put('/about/update/{id}', [App\Http\Controllers\Admin\AboutController::class, 'update'])->name('admin.about.update');

    // Buy & Sale Page
    Route::get('/buysale', [App\Http\Controllers\Admin\BuySellController::class, 'edit'])->name('admin.buysale.edit');
    Route::put('/buysale/update/{id}', [App\Http\Controllers\Admin\BuySellController::class, 'update'])->name('admin.buysale.update');

    // Settings Front Pages
    Route::get('/setting', [App\Http\Controllers\Admin\SettingsController::class, 'edit'])->name('admin.setting.edit');
    Route::put('/setting/update/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('admin.setting.update');
});


Route::middleware(['auth'])->group(
    function () {
        Route::prefix('medical-center')->middleware([IsMedicalCenter::class])->group(function () {
            // Route for medical center profile update.
            Route::get('/profile', [App\Http\Controllers\Admin\MedicalCenterRegistrationController::class, 'edit'])->name('medicalcenterprofile.edit');
            Route::put('/update/{id}', [App\Http\Controllers\Admin\MedicalCenterRegistrationController::class, 'update'])->name('medicalcenterprofile.update');
        });

        Route::prefix('jobseeker')->middleware([IsJobSeeker::class])->group(function () {

            // Route Group For testimonial Module.
            Route::prefix('testimonial')->group(function () {
                // Route for job seeker.
                Route::get('/create', [App\Http\Controllers\Jobseeker\TestimonialController::class, 'create'])->name('jobseeker.testimonial.create');
                Route::post('/store', [App\Http\Controllers\Jobseeker\TestimonialController::class, 'store'])->name('jobseeker.testimonial.store');
                Route::get('/list', [App\Http\Controllers\Jobseeker\TestimonialController::class, 'lists'])->name('jobseeker.testimonial.list');
                Route::get('/show/{testimonial}', [App\Http\Controllers\Jobseeker\TestimonialController::class, 'show'])->name('jobseeker.testimonial.show');

                Route::get('/enable/{id}', [App\Http\Controllers\Jobseeker\TestimonialController::class, 'enable'])->name('jobseeker.testimonial.enable');
                Route::get('/disable/{id}', [App\Http\Controllers\Jobseeker\TestimonialController::class, 'disable'])->name('jobseeker.testimonial.disable');

                Route::get(
                    '/datatable',
                    [App\Http\Controllers\Jobseeker\TestimonialController::class, 'datatable']
                )->name('testimonial.datatables');

                Route::get(
                    '/delete/{id}',
                    [App\Http\Controllers\Jobseeker\TestimonialController::class, 'destroy']
                )->name('testimonial.delete');
            });

            // Route Group For recommendation Module.
            Route::prefix('recommendation')->group(function () {
                // Recommendation Module
                Route::get('/create', [App\Http\Controllers\Jobseeker\RecommendationController::class, 'create'])->name('admin.recommendation.create');

                Route::post('/store', [App\Http\Controllers\Jobseeker\RecommendationController::class, 'store'])->name('admin.recommendation.store');
                Route::get('/list', [App\Http\Controllers\Jobseeker\RecommendationController::class, 'lists'])->name('admin.recommendation.list')->withoutMiddleware([isAdmin::class]);
                Route::get('/show/{id}', [App\Http\Controllers\Jobseeker\RecommendationController::class, 'show'])->name('admin.recommendation.show');

                Route::get('/enable/{id}', [App\Http\Controllers\Jobseeker\RecommendationController::class, 'enable'])->name('admin.recommendation.enable');
                Route::get('/disable/{id}', [App\Http\Controllers\Jobseeker\RecommendationController::class, 'disable'])->name('admin.recommendation.disable');

                Route::get(
                    '/datatable',
                    [App\Http\Controllers\Jobseeker\RecommendationController::class, 'datatable']
                )->name('recommendation.datatables')->withoutMiddleware([isAdmin::class]);

                Route::get(
                    '/delete/{id}',
                    [App\Http\Controllers\Jobseeker\RecommendationController::class, 'destroy']
                )->name('recommendation.delete');
            });

            Route::get('/my-jobapplication', [App\Http\Controllers\Admin\JobApplicationController::class, 'myapplications'])->name('admin.jobapplication.myapplications');

            // Jobseeker Profile Update Routes
            Route::get('/profile', [App\Http\Controllers\Jobseeker\JobSeekerRegistrationController::class, 'edit'])->name('jobseekerprofile.edit');
            Route::put('/profile-update/{id}', [App\Http\Controllers\Jobseeker\JobSeekerRegistrationController::class, 'update'])->name('jobseekerprofile.update');
        });
    }
);


// Ajax Route
Route::post('getcities', [App\Http\Controllers\Admin\StateController::class, 'getcities'])->name('getcities')->withoutMiddleware([isAdmin::class, "auth"]);
Route::post('getasuburbs', [App\Http\Controllers\Admin\StateController::class, 'getasuburbs'])->name('getasuburbs')->withoutMiddleware([isAdmin::class, "auth"]);

// Ajax Route For Edit
Route::post('editgetcities', [App\Http\Controllers\Admin\StateController::class, 'editgetcities'])->name('editgetcities')->withoutMiddleware([isAdmin::class, "auth"]);
Route::post('editgetasuburbs', [App\Http\Controllers\Admin\StateController::class, 'editgetasuburbs'])->name('editgetasuburbs')->withoutMiddleware([isAdmin::class, "auth"]);

Route::post('filterjobs', [App\Http\Controllers\Front\JobController::class, 'filterjobs'])->name('filterjobs')->withoutMiddleware([isAdmin::class, "auth"]);

// Ajax Routes Registration
Route::post('register-getcities', [App\Http\Controllers\Admin\StateController::class, 'register_getcities'])->name('register-getcities')->withoutMiddleware([isAdmin::class, "auth"]);
Route::post('register-getasuburbs', [App\Http\Controllers\Admin\StateController::class, 'register_getasuburbs'])->name('register-getasuburbs')->withoutMiddleware([isAdmin::class, "auth"]);
