<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\LoginHistory;
use App\Listeners\storeUserLoginHistory;
use App\Models\JobCategory;
use App\Observers\JobCategoryObserver;
use App\Models\JobType;
use App\Observers\JobTypeObserver;
use App\Models\Job;
use App\Observers\JobObserver;
use App\Models\Profession;
use App\Observers\ProfessionObserver;
use App\Models\Specialty;
use App\Observers\SpecialtyObserver;
use App\Models\BuySell;
use App\Observers\BuySellObserver;
use App\Models\BuySellMedia;
use App\Observers\BuySellMediaObserver;
use App\Models\Contact;
use App\Observers\ContactObserver;
use App\Models\JobSeekerRegistration;
use App\Observers\JobSeekerRegistrationObserver;
use App\Models\MedicalCenterRegistration;
use App\Observers\MedicalCenterRegistrationObserver;
use App\Models\JobApplication;
use App\Observers\JobApplicationObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LoginHistory::class => [
            StoreUserLoginHistory::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Job::observe(JobObserver::class);
        JobType::observe(JobTypeObserver::class);
        JobCategory::observe(JobCategoryObserver::class);
        Profession::observe(ProfessionObserver::class);
        Specialty::observe(SpecialtyObserver::class);
        BuySell::observe(BuySellObserver::class);
        BuySellMedia::observe(BuySellMediaObserver::class);
        Contact::observe(ContactObserver::class);
        JobSeekerRegistration::observe(JobSeekerRegistrationObserver::class);
        MedicalCenterRegistration::observe(MedicalCenterRegistrationObserver::class);
        JobApplication::observe(JobApplicationObserver::class);
    }
}
