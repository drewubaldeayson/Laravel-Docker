<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider{


    public function register(){

        $this->app->bind(
            'App\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'App\Contracts\UserIndividualRepositoryInterface',
            'App\Repositories\Eloquent\UserIndividualRepository'
        );

        $this->app->bind(
            'App\Contracts\UserVerificationRepositoryInterface',
            'App\Repositories\Eloquent\UserVerificationRepository'
        );

        $this->app->bind(
            'App\Contracts\UserAddressesRepositoryInterface',
            'App\Repositories\Eloquent\UserAddressesRepository'
        );

        $this->app->bind(
            'App\Contracts\UserAddressesRepositoryInterface',
            'App\Repositories\Eloquent\UserAddressesRepository'
        );

        $this->app->bind(
            'App\Contracts\ClinicRepositoryInterface',
            'App\Repositories\Eloquent\ClinicRepository'
        );

        $this->app->bind(
            'App\Contracts\ClinicAddressRepositoryInterface',
            'App\Repositories\Eloquent\ClinicAddressRepository'
        );

        $this->app->bind(
            'App\Contracts\ClinicServicesRepositoryInterface',
            'App\Repositories\Eloquent\ClinicServicesRepository'
        );

        $this->app->bind(
            'App\Contracts\ClinicServiceEventRepositoryInterface',
            'App\Repositories\Eloquent\ClinicServiceEventRepository'
        );

        $this->app->bind(
            'App\Contracts\UserServiceProviderRepositoryInterface',
            'App\Repositories\Eloquent\UserServiceProviderRepository'
        );

        $this->app->bind(
            'App\Contracts\UserCorporateRepositoryInterface',
            'App\Repositories\Eloquent\UserCorporateRepository'
        );

        $this->app->bind(
            'App\Contracts\ClinicEventTypeRepositoryInterface',
            'App\Repositories\Eloquent\ClinicEventTypeRepository'
        );

        $this->app->bind(
            'App\Contracts\ServiceTimeslotRepositoryInterface',
            'App\Repositories\Eloquent\ServiceTimeslotRepository'
        );

        $this->app->bind(
            'App\Contracts\BookingOrderRepositoryInterface',
            'App\Repositories\Eloquent\BookingOrderRepository'
        );

        $this->app->bind(
            'App\Contracts\BookingStatusLogRepositoryInterface',
            'App\Repositories\Eloquent\BookingStatusLogRepository'
        );

        $this->app->bind(
            'App\Contracts\BookingStatusRepositoryInterface',
            'App\Repositories\Eloquent\BookingStatusRepository'
        );

        $this->app->bind(
            'App\Contracts\InvoiceRepositoryInterface',
            'App\Repositories\Eloquent\InvoiceRepository'
        );

        $this->app->bind(
            'App\Contracts\PaymentRepositoryInterface',
            'App\Repositories\Eloquent\PaymentRepository'
        );

        $this->app->bind(
            'App\Contracts\InvoicePaymentRepositoryInterface',
            'App\Repositories\Eloquent\InvoicePaymentRepository'
        );

        $this->app->bind(
            'App\Contracts\BookingDetailRepositoryInterface',
            'App\Repositories\Eloquent\BookingDetailRepository'
        );

        $this->app->bind(
            'App\Contracts\UserSavedClinicRepositoryInterface',
            'App\Repositories\Eloquent\UserSavedClinicRepository'
        );

        $this->app->bind(
            'App\Contracts\SelfCheckerQuestionsRepositoryInterface',
            'App\Repositories\Eloquent\SelfCheckerQuestionsRepository'
        );

        $this->app->bind(
            'App\Contracts\SelfCheckerRecordRepositoryInterface',
            'App\Repositories\Eloquent\SelfCheckerRecordRepository'
        );

        $this->app->bind(
            'App\Contracts\SelfCheckerSymptomsListRepositoryInterface',
            'App\Repositories\Eloquent\SelfCheckerSymptomsListRepository'
        );

        $this->app->bind(
            'App\Contracts\SelfCheckerSymtomsLogsRepositoryInterface',
            'App\Repositories\Eloquent\SelfCheckerSymtomsLogsRepository'
        );

        $this->app->bind(
            'App\Contracts\UserCustomRepositoryInterface',
            'App\Repositories\Eloquent\UserCustomRepository'
        );

        $this->app->bind(
            'App\Contracts\UserRoleRepositoryInterface',
            'App\Repositories\Eloquent\UserRoleRepository'
        );

        $this->app->bind(
            'App\Contracts\BookingResultRepositoryInterface',
            'App\Repositories\Eloquent\BookingResultRepository'
        );

        $this->app->bind(
            'App\Contracts\BookingResultStatusRepositoryInterface',
            'App\Repositories\Eloquent\BookingResultStatusRepository'
        );

        $this->app->bind(
            'App\Contracts\ClinicMedicalTeamRepoInterface',
            'App\Repositories\Eloquent\ClinicMedicalTeamRepository'
        );

        $this->app->bind(
            'App\Contracts\ServiceMedicalPersonRepoInterface',
            'App\Repositories\Eloquent\ServiceMedicalPersonRepository'
        );

        $this->app->bind(
            'App\Contracts\ServiceAssayKitRepoInterface',
            'App\Repositories\Eloquent\ServiceAssayKitRepository'
        );

        $this->app->bind(
            'App\Contracts\ServiceSpecimenRepoInterface',
            'App\Repositories\Eloquent\ServiceSpecimenRepository'
        );

        $this->app->bind(
            'App\Contracts\DeviceRegistryRepositoryInterface',
            'App\Repositories\Eloquent\DeviceRegistryRepository'
        );

        $this->app->bind(
            'App\Contracts\ClinicServiceTypesRepositoryInterface',
            'App\Repositories\Eloquent\ClinicServiceTypesRepository'
        );

        $this->app->bind(
            'App\Contracts\ServiceMainServicesRepoInterface',
            'App\Repositories\Eloquent\ServiceMainServicesRepository'
        );


    }

}