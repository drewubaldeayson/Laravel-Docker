<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


Route::prefix('v1')->group(function () {

    //SPRIBE ENDPOINT
    //Authentication
    Route::post('auth/',                                                      'AuthenticationController@show');

    Route::group([
        'middleware' => ['jwt.verify']
    ],function ($router) {

        /** 
         * USERAPP ENDPOINTS
         * **/

        // USER DEVICE REGISTRY
        Route::post('user/device/registry',                                 'ProfileController@deviceRegistry');

        // USER SIGNOUT
        Route::post('user/signout',                                         'AuthController@logout');

        // USER PROFILE
        Route::get('user/profile',                                          'ProfileController@show');
        Route::patch('user/profile',                                        'ProfileController@update');

        // USER CHANGE PASS
        Route::post('user/changepassword',                                  'ProfileController@changePassword');

        // USER PROFILE ADDRESS
        Route::get('user/address',                                          'ProfileController@showAddresses');
        Route::post('user/address',                                         'ProfileController@storeAddress');
        Route::post('user/address/default',                                 'ProfileController@changeDefaultAddress');
        Route::patch('user/address/{id}',                                   'ProfileController@updateAddress');
        
        // USER CLINICS
        Route::post('user/clinic/save',                                     'ProfileController@saveClinic');
        Route::get('user/clinic/show',                                      'ProfileController@showSavedClinics');
        Route::delete('user/clinic/{id}/delete',                            'ProfileController@dropSavedClinic');

        // USERAPP APPOINTMENTS
        Route::get('user/appointment/status/{status}',                      'UserAppointmentController@fetchByStatus');
        Route::get('user/appointment/{id}/show',                            'UserAppointmentController@show');
        Route::get('user/appointment/{booking_for}/result',                 'UserAppointmentController@fetchWithBookingResults');
        Route::get('user/appointment/{id}/result/show',                     'UserAppointmentController@showWithBookingResult');

        // USERAPP PAYMENTS
        Route::post('payments/paynow',                                      'PaymentController@makePayment');




        /** 
         * ADMIN PANEL ENDPOINTs
         * FOR TPSN HEADOFFICE USE
         * **/

        // ADMIN SIGNOUT
        Route::post('admin/signout',                                        'AdminAuthController@logout');

        // ADMIN - ADMIN PROFILE
        Route::get('admin/profile',                                         'AdminProfileController@show'); 
        Route::patch('admin/profile',                                       'AdminProfileController@update');

        // ADMIN - CLINICS 
        Route::get('admin/clinics',                                         'AdminController@fetchAllClinic');
        Route::post('admin/clinics',                                        'AdminController@storeClinic');
        Route::patch('admin/clinics/{id}/edit',                             'AdminController@updateClinic');
        Route::get('admin/clinics/{id}/show',                               'AdminController@showClinic');
        Route::delete('admin/clinics/{id}/delete',                          'AdminController@dropClinic');

        // ADMIN - CLINIC ACCOUNTS
        Route::get('admin/clinics/accounts',                                'AdminController@fetchAllProvider');
        Route::post('admin/clinics/accounts/create',                        'AdminController@storeUserServiceProvider');
        Route::post('admin/clinics/accounts/resetpassword',                 'AdminController@resetUserPassword');
        Route::patch('admin/clinics/accounts/{id}/edit',                    'AdminController@updateUserProvider');
        Route::get('admin/clinics/accounts/{id}/view',                      'AdminController@showUserProvider');

        // ADMIN - CLINIC MEDICAL PERSONS
        Route::get('admin/clinic/medical-persons',                         'AdminMedicalPersonsController@fetch');
        Route::post('admin/clinic/medical-persons',                        'AdminMedicalPersonsController@store');
        Route::get('admin/clinic/medical-persons/{id}',                    'AdminMedicalPersonsController@show');
        Route::post('admin/clinic/medical-persons/{id}',                   'AdminMedicalPersonsController@update');
        Route::delete('admin/clinic/medical-persons/{id}',                 'AdminMedicalPersonsController@drop');

        // ADMIN - CLINIC MEDICAL ASSAY KITS
        Route::get('admin/clinic/service-kits',                            'AdminServiceKitsController@fetch');
        Route::post('admin/clinic/service-kits',                           'AdminServiceKitsController@store');
        Route::get('admin/clinic/service-kits/{id}',                       'AdminServiceKitsController@show');
        Route::patch('admin/clinic/service-kits/{id}',                     'AdminServiceKitsController@update');
        Route::delete('admin/clinic/service-kits/{id}',                    'AdminServiceKitsController@drop');

        // ADMIN - CLINIC SPECIMENS 
        Route::get('admin/clinic/service-specimens',                       'AdminServiceSpecimenController@fetch');
        Route::post('admin/clinic/service-specimens',                      'AdminServiceSpecimenController@store');
        Route::get('admin/clinic/service-specimens/{id}',                  'AdminServiceSpecimenController@show');
        Route::patch('admin/clinic/service-specimens/{id}',                'AdminServiceSpecimenController@update');
        Route::delete('admin/clinic/service-specimens/{id}',               'AdminServiceSpecimenController@drop');

        // ADMIN - MAIN SERVICES
        Route::get('admin/clinic/services',                                 'AdminMainServicesController@fetch');
        Route::post('admin/clinic/services',                                'AdminMainServicesController@store');
        Route::patch('admin/clinic/services/{id}',                          'AdminMainServicesController@update');
        Route::delete('admin/clinic/services/{id}',                         'AdminMainServicesController@drop');
        Route::get('admin/clinic/services/{id}',                            'AdminMainServicesController@show');

        // // ADMIN - CLINIC SERVICES
        // Route::post('admin/clinic/service',                                 'AdminController@storeClinicService');
        // Route::get('admin/clinic/{id}/services',                            'AdminController@fetchClinicServices');
        // Route::patch('admin/clinic/services/{id}/edit',                     'AdminController@updateClinicService');
        // Route::delete('admin/clinic/services/{id}/delete',                  'AdminController@dropClinicService');
        // Route::get('admin/clinic/services/{id}/show',                       'AdminController@showClinicService');

        // ADMIN - CLINIC SERVICE TYPES
        Route::post('admin/clinic/services-types',                          'AdminController@storeClinicServiceTypes');
        Route::get('admin/clinic/services-types',                           'AdminController@fetchClinicServiceTypes');
        Route::patch('admin/clinic/services-types/{id}',                    'AdminController@updateClinicServiceTypes');
        Route::delete('admin/clinic/services-types/{id}',                   'AdminController@dropClinicServiceTypes');

        // ADMIN - CLINIC SERVICE EVENTS
        Route::get('admin/clinic/{id}/service-event',                       'AdminController@fetchClinicServiceEvents');
        Route::post('admin/clinic/service-event',                           'AdminController@storeClinicServiceEvent');
        Route::patch('admin/clinic/service-event/{id}/edit',                'AdminController@updateClinicServiceEvent');
        Route::get('admin/clinic/service-event/{id}/show',                  'AdminController@showClinicServiceEvent');
        Route::get('admin/service-events/{id}/timeslots',                   'AdminController@showTimeslot');
        Route::get('admin/service-event/types',                             'AdminController@fetchServiceEventType'); 

        // ADMIN - CLINIC APPOINTMENTS
        Route::get('admin/appointments',                                    'AdminController@fetchAllAppointment');
        Route::get('admin/appointment/{id}',                                'AdminController@showAppointment');
        Route::get('admin/appointments/clinics/{id}',                       'AdminController@fetchAllClinicAppointment');

        // ADMIN - WALKIN APPOINTMENTS
        Route::post('admin/appointment/walkin',                             'AdminController@storeWalkIn');
        Route::post('admin/appointment/walkin/group',                       'AdminController@storeWalkInGroup');
        Route::delete('admin/appointment/{id}/walkin',                      'AdminController@dropWaklIn');
        Route::post('admin/appointment/payment/walkin',                     'AdminController@payWalkIn');

        // ADMIN - DATA ANALYTICS REPORTS
        Route::get('admin/reports/appointments',                            'AdminReportsController@adminFetchAppointments');
        Route::get('admin/reports/appointments/total/filterby',             'AdminReportsController@totalAppointment');
        Route::get('admin/reports/appointments/overview',                   'AdminReportsController@appointmentOverview');

        Route::get('admin/reports/clinics/total',                           'AdminReportsController@totalClinics');
        Route::get('admin/reports/individual/total',                        'AdminReportsController@totalUsers');
        Route::get('admin/reports/appointments-result/overview',            'AdminReportsController@appointmentResultsOverview');

        // ADMIN - SALES REPORTS
        Route::get('admin/reports/sales/filterby',                          'AdminReportsController@adminRangeSalesFilterDate');
        Route::get('admin/reports/sales/total/filterby',                    'AdminReportsController@adminRangeTotalSalesFilterDate');
        Route::get('admin/reports/sales/pods/total-sales',                  'AdminReportsController@adminRangePodsTotalSalesFilterDate');
        Route::get('admin/reports/sales/pods/payment-methods',              'AdminReportsController@adminRangeTotalSalesPerPaymentMethod');
        Route::get('admin/reports/sales/pods/total-count',                  'AdminReportsController@adminTotalAppointmentsPerPods');
        Route::get('admin/reports/sales/pods/data',                         'AdminReportsController@adminSummarizeSalesPerPods');
        Route::get('admin/reports/sales/generate/export',                   'AdminReportsController@adminSalesReportExport');
        Route::get('admin/reports/appointments/generate/export',            'AdminReportsController@adminAppointmentsReportExport');
        Route::get('admin/reports/sales/summary/total',                     'AdminReportsController@summaryReport');
        Route::get('admin/reports/sales/overview',                          'AdminReportsController@salesOverview');

        // ADMIN - USERS AND PATIENTS
        Route::post('admin/individual',                                     'AdminController@storeUserIndividual');
        Route::get('admin/individuals',                                     'AdminController@fetchUserIndividual');
        Route::get('admin/individual/{id}/show',                            'AdminController@showUserIndividual');
        Route::patch('admin/individual/{id}/edit',                          'AdminController@updateUserIndividual');
        Route::patch('admin/individual/{id}/status',                        'AdminController@changeUserIndividualStatus');
        Route::get('admin/individual/patients',                             'AdminController@fetchAllPatient');
        Route::get('admin/individual/patients/{id}/show',                   'AdminController@showPatient');






        /** 
         * CLINIC PANEL ENDPOINTS
         * TESTING CENTERS USE
         * **/

        // CLINIC SIGNOUT
        Route::post('providers/account/signout',                            'ServiceProviderAuthController@logout');

        // CLINIC - ACCOUNT PROFILE
        Route::get('providers/profile',                                     'ClinicProfileController@show'); 
        Route::patch('providers/profile ',                                  'ClinicProfileController@update');
        Route::get('providers/profile/address',                             'ProfileController@showAddresses');
        Route::post('providers/profile/address',                            'ProfileController@storeAddress');
        Route::patch('providers/profile/address/{id}',                      'ProfileController@updateAddress');

        // CLINIC - CLINIC PROFILE

        // Route::patch('provider/clinic/{id}/edit', 'ClinicController@update');
        Route::patch('provider/clinic',                                     'ClinicController@update');
        Route::get('provider/clinic/show',                                  'ClinicController@showServiceProviderClinic');

        // CLINIC - CLINIC SERVICES
        Route::get('providers/services/status/{status}',                    'ClinicServicesController@fetchByStatus'); 
        Route::get('providers/services',                                    'ClinicServicesController@fetch'); 
        Route::post('providers/services',                                   'ClinicServicesController@store');
        Route::patch('providers/services/{id}/edit',                        'ClinicServicesController@update');
        Route::get('providers/services/{id}/show',                          'ClinicServicesController@show');
        Route::delete('providers/services/{id}',                            'ClinicServicesController@drop');
        Route::get('providers/services-types',                              'ClinicServicesController@fetchServiceTypes');

        // CLINIC - CLINIC SERVICE SPECIMENS
        Route::get('providers/service-specimens',                           'ClinicSpecimensController@fetch'); 
        Route::get('providers/service-specimens/{id}/view',                 'ClinicSpecimensController@show');
        Route::post('providers/service-specimens',                          'ClinicSpecimensController@store');
        Route::patch('providers/service-specimens/{id}',                    'ClinicSpecimensController@update');
        Route::delete('providers/service-specimens/{id}',                   'ClinicSpecimensController@drop');

        // CLINIC - SERVICE TESTING KITS
        Route::get('providers/servicekits',                                 'ClinicAssayKitController@fetch'); 
        Route::get('providers/servicekits/{id}/view',                       'ClinicAssayKitController@show');
        Route::post('providers/servicekits',                                'ClinicAssayKitController@store');
        Route::patch('providers/servicekits/{id}',                          'ClinicAssayKitController@update');
        Route::delete('providers/servicekits/{id}',                         'ClinicAssayKitController@drop');

        // CLINIC - SERVICE EVENTS
        Route::get('providers/service-event/types',                         'ClinicServiceEventController@fetchEventTypes'); 
        Route::get('providers/service-events',                              'ClinicServiceEventController@fetch');
        Route::get('providers/service-events/status/{event_status}',        'ClinicServiceEventController@fetchByStatus');
        Route::post('providers/service-events',                             'ClinicServiceEventController@store');
        Route::patch('providers/service-events/{id}/edit',                  'ClinicServiceEventController@update');
        Route::get('providers/service-events/{id}/show',                    'ClinicServiceEventController@show');
        Route::delete('providers/service-events/{id}',                      'ClinicServiceEventController@drop');
        Route::post('providers/service-events/timeslots',                   'ClinicServiceEventController@fetchTimeslots'); 

        // CLINIC - MEDICAL TEAM
        Route::post('providers/medical-team',                               'ClinicMedicalTeamController@storeMember');
        Route::get('providers/medical-team',                                'ClinicMedicalTeamController@fetchTeam');
        Route::post('providers/medical-team/{id}/edit',                     'ClinicMedicalTeamController@updateDetails');
        Route::delete('providers/medical-team/{id}',                        'ClinicMedicalTeamController@deleteMember');
        // organize
        Route::get('providers/medical-team/organize',                       'ClinicMedicalTeamController@organizeMember');
        
        // CLINIC - APPOINTMENTS REPORTS
        Route::get('providers/reports/appointment/status/{status}',        'ClinicReportsController@fetchAppointmentTotalByStatus');
        Route::get('providers/reports/appointment/type/{type}',            'ClinicReportsController@fetchAppointmentTotalByType');
    
        Route::get('providers/reports/appointment/total',                       'ClinicReportsController@totalAppointment');
        Route::get('providers/reports/appointment/total/today',                 'ClinicReportsController@totalAppointmentToday');
        Route::get('providers/reports/appointment/total/weekly',                'ClinicReportsController@totalAppointmentWeekly');
        Route::get('providers/reports/appointment/total/walkin',                'ClinicReportsController@TotalWalkinAppointments');
        Route::get('providers/reports/appointment/total/today/walkin',          'ClinicReportsController@TotalWalkinAppointmentsToday');
        Route::get('providers/reports/appointment/total/patients',               'ClinicReportsController@TotalPatientAppointments');
        Route::get('providers/reports/appointment/total/today/pending',         'ClinicReportsController@TotalPendingAppointmentToday');
    
        
        // sales REPORT
        // get total data sales report
        Route::get('providers/reports/sales/total/filterby/{range}',        'ClinicSalesReportsController@filterRangeTotalSales');
        Route::get('providers/reports/sales/total/filterby',                'ClinicSalesReportsController@filterRangeTotalSalesFilterDate');

        // listing data sales report
        Route::get('providers/reports/sales/filterby/{range}',              'ClinicSalesReportsController@filterRangeSales');
        Route::get('providers/reports/sales/filterby',                      'ClinicSalesReportsController@filterRangeSalesFilterDate');

        // list sales report filter by payment method and code
        Route::get('providers/reports/sales/payment-method/{method}/payment-code/{code}',     'ClinicSalesReportsController@filterRangePaymentSales');

        // summary daily
        Route::get('providers/reports/sales/summary/daily',                  'ClinicSalesReportsController@dailySummary');


        
        // CLINIC - PATIENTS
        Route::get('providers/individual/patients',                         'ClinicPanelController@fetchPatients'); 
        Route::get('providers/individual/patients/{id}/show',               'ClinicPanelController@showPatient'); 

        // CLINIC - APPOINTMENTS
        // mass import/export
        Route::get('providers/appointments/sheet/export',                                   'ClinicAppointmentController@exportTemplate');
        Route::post('providers/appointments/sheet/import',                                  'ClinicAppointmentController@importTemplate');
        // manual
        Route::post('providers/appointments/direct/single',                                 'ClinicAppointmentController@directAppointment');
        Route::post('providers/appointments/direct/bulk',                                   'ClinicAppointmentController@directBulkAppointment');
        // 
        Route::get('providers/appointment/statuses',                                        'AppointmentController@fetchBookingStatuses');
        Route::get('providers/appointments',                                                'ClinicPanelController@fetchAppointments'); 
        Route::get('providers/appointments/type/{appointment_type}',                        'ClinicPanelController@fetchAppointmentsByType');
        Route::get('providers/appointments/type/{appointment_type}/filterby/today',         'ClinicPanelController@fetchAppointmentsByTypeToday');
        Route::get('providers/appointments/{id}/view',                                      'ClinicPanelController@showAppointment'); 
        Route::patch('providers/appointments/{id}/edit',                                    'ClinicPanelController@updateAppointment');
        // result
        Route::get('providers/appointment-result',                                          'ClinicPanelController@fetchAppointmentResult');
        Route::get('providers/appointment-result/filterby/status/{bookingstatus}',          'ClinicPanelController@fetchAppointmentResultByBookingStatus');
        Route::get('providers/appointment-result/filterby/result/{patientstatus}',          'ClinicPanelController@fetchAppointmentResultByStatusResult');
        Route::get('providers/appointment-result/all/filterby/today',                       'ClinicPanelController@fetchAppointmentResultToday');
        Route::get('providers/appointment-result/{id}/view',                                'ClinicPanelController@showAppointmentResult');
        Route::patch('providers/appointment-result/{id}',                                   'ClinicPanelController@updateAppointmentResult');
        Route::get('providers/appointment-result/generate/{id}',                            'ClinicPanelController@generateAppointmentResultPDF');
        Route::get('providers/appointment-result/statuses',                                 'ClinicPanelController@fetchResultStatuses');
        Route::get('providers/appointments/patients/status/{status}',                       'ClinicPanelController@fetchPatientsByStatus'); 
        // payment
        Route::post('providers/appointments/payment',                                       'ClinicPanelController@makePaymentAppointment');

        // payments
        Route::get('payments', 'PaymentController@index');

        // clioic appointments
        Route::post('clinics/appointment',                                  'AppointmentController@store');
        Route::post('clinics/appointment/other',                            'AppointmentController@storeForSomeoneElse');
        Route::post('clinics/appointment/group',                            'AppointmentController@storeForGroup');
        Route::patch('clinics/appointment/{id}/edit',                       'AppointmentController@update'); 
        Route::get('clinics/appointment/{id}/show',                         'AppointmentController@show'); 
        Route::get('clinics/appointment/status/{status}',                   'AppointmentController@status');

        // invoice
        // Route::get('payment/invoice/{id}/show',                             'InvoiceController@findBooking');
    });


    /** 
     * PUBLIC ENDPOINTS
     */

    // PUBLIC - USER AUTH ENDPOINTS
    Route::post('user/signup',                                              'AuthController@store');
    Route::post('user/signin',                                              'AuthController@login');
    Route::post('user/refresh',                                             'AuthController@refresh');

    // PUBLIC - USER OTP
    Route::post('user/otp/validate',                                        'AuthController@validateMobileOtp');
    Route::post('user/otp/resend',                                          'AuthController@resendMobileOtp');

    // PUBLIC - USER PASSWORD RESET
    Route::post('user/password/reset',                                      'ForgotPasswordController@forgotPassword')->name('password.reset');
    Route::post('user/password/reset/confirm',                              'ForgotPasswordController@resetPassword');

    // PUBLIC - LOCATIONS
    Route::get('regions',                                                   'LocationController@getRegion');
    Route::get('provinces/{id}',                                            'LocationController@getProvince');
    Route::get('cities/{id}',                                               'LocationController@getCities');
    Route::get('brgys/{id}',                                                'LocationController@getBrgys');

    // PUBLIC - USER SELF CHECKER
    Route::post('selfchecker/record/create',                                'SelfCheckerController@storeSelfCheckerRecord');
    Route::post('selfchecker/symptom/create',                               'SelfCheckerController@storeSelfCheckerSymptom');
    Route::post('selfchecker/question/create',                              'SelfCheckerController@storeSelfCheckerQuestion');
    Route::get('selfchecker/symptom/fetch',                                 'SelfCheckerController@fetchSymptomsList');
    Route::get('selfchecker/question/fetch',                                'SelfCheckerController@fetchQuestionsList');

    // PUBLIC - USER APPOINTMENTS
    Route::post('public/clinic/appointment',                                'PublicUserController@storeAppointment');
    Route::get('public/clinic/appointment/{booking_code}/view',             'PublicUserController@viewAppointment');
    Route::post('public/clinic/appointment/walkin',                         'PublicUserController@storeWalkinAppointment');

    // PUBLIC - USER APPOINTMENTS
    // Route::get('user/patient/result/{id}',                                  'UserAppointmentController@fetchPatientResult');

    // PUBLIC - PAYMENTS
    Route::post('public/payment/paynow',                                    'PublicUserController@makePayment');
    Route::get('payments/methods',                                          'PaymentController@getPaymentMethods');

    // PUBLIC - CLINIC AUTH ENDPOINTS
    Route::post('providers/account/refresh',                                'ServiceProviderAuthController@refresh');
    Route::post('providers/account/signin',                                 'ServiceProviderAuthController@login');
    Route::post('providers/account/signup',                                 'ServiceProviderAuthController@store');

    // PUBLIC - CLINIC USER OTP
    Route::post('providers/account/otp/validate',                           'ServiceProviderAuthController@validateMobileOtp'); 
    Route::post('providers/account/otp/resend',                             'ServiceProviderAuthController@resendMobileOtp');

    // PUBLIC - ADMIN AUTH
    Route::post('admin/signin',                                             'AdminAuthController@login');
    Route::post('admin/refresh',                                            'AdminAuthController@refresh');
    
    // PUBLIC - CLINICS
    Route::get('clinics',                                                   'ClinicController@index');
    Route::get('clinics/featured',                                          'ClinicController@featured');
    Route::post('clinics',                                                  'ClinicController@store');
    Route::patch('clinics/{id}/edit',                                       'ClinicController@update');
    Route::get('clinics/{id}/show',                                         'ClinicController@show');
    Route::get('clinics/nearby',                                            'ClinicController@nearby');
    Route::get('clinic/search/{eventtype}/{searchdata}',                    'ClinicController@search');

    // PUBLIC - CLINIC SERVICES
    Route::get('clinics/services',                                          'ServicesController@index');
    Route::get('clinics/{id}/services',                                     'ServicesController@provider');
    Route::post('clinics/services',                                         'ServicesController@store');
    Route::patch('clinics/services/{id}',                                   'ServicesController@update');
    Route::get('clinics/services/{id}',                                     'ServicesController@show');
    Route::delete('clinics/services/{id}',                                  'ServicesController@drop');

    // PUBLIC - CLINIC SERVICE EVENTS
    Route::get('clinics/events',                                            'ServiceEventsController@index');
    Route::get('clinics/{id}/events',                                       'ServiceEventsController@provider');
    Route::get('clinics/events/featured',                                   'ServiceEventsController@featured');
    Route::post('clinics/events',                                           'ServiceEventsController@store');
    Route::get('clinics/events/{id}/show',                                  'ServiceEventsController@show');
    Route::patch('clinics/events/{id}/edit',                                'ServiceEventsController@update');
    Route::get('clinics/events/nearby',                                     'ServiceEventsController@nearby');
    Route::post('clinics/events/type',                                      'ServiceEventsController@storeEventType');
    Route::post('clinics/events/timeslots',                                 'ServiceEventsController@showTimeslot');
    Route::get('clinic/events/search/{eventtype}/{searchdata}',             'ServiceEventsController@search'); 

    // THIRD PARTY CALLBACK WEBHOOK - ENDPOINT
    Route::post('payments/webhook',                                         'PaymentController@webhook');
    
});
