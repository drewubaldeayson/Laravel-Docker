<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Contracts\UserInterface',
            'App\Services\UserService'
        );

        $this->app->bind(
            'App\Contracts\ProfileInterface',
            'App\Services\ProfileService'
        );

        $this->app->bind(
            'App\Contracts\ServiceProviderInterface',
            'App\Services\ServiceProviderService'
        );

        $this->app->bind(
            'App\Contracts\ProviderServicesInterface',
            'App\Services\ProviderServicesService'
        );

        $this->app->bind(
            'App\Contracts\ProviderServiceEventsInterface',
            'App\Services\ProviderServiceEventsService'
        );


        $this->app->bind(
            'App\Contracts\AppointmentInterface',
            'App\Services\AppointmentService'
        );

        $this->app->bind(
            'App\Contracts\InvoiceInterface',
            'App\Services\InvoiceService'
        );

        $this->app->bind(
            'App\Contracts\SelfCheckerInterface',
            'App\Services\SelfCheckerService'
        );

        $this->app->bind(
            'App\Contracts\PaymentInterface',
            'App\Services\PaymentService'
        );

        $this->app->bind(
            'App\Contracts\ClinicMedicalTeamInterface',
            'App\Services\ClinicMedicalTeamService'
        );

        $this->app->bind(
            'App\Contracts\MedicalPersonInterface',
            'App\Services\MedicalPersonService'
        );

        $this->app->bind(
            'App\Contracts\SalesInterface',
            'App\Services\SalesService'
        );

        $this->app->bind(
            'App\Contracts\AssayKitInterface',
            'App\Services\AssayKitService'
        );

        $this->app->bind(
            'App\Contracts\SpecimenInterface',
            'App\Services\SpecimenService'
        );

        $this->app->bind(
            'App\Contracts\AdminMainServicesInterface',
            'App\Services\AdminMainServicesService'
        );
    

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $this->app['request']->server->set('HTTPS','on');
    }
}
