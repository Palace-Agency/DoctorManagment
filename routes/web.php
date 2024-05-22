<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\MotifController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SpecialityController;
use App\Http\Controllers\Auth\RegisterDoctorController;
use App\Http\Controllers\Doctor\DashboardDocController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\Patient\ClientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Doctor\ActCareController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\CabinetController;
use App\Http\Controllers\Doctor\CalendarController;
use App\Http\Controllers\Doctor\CategoryExpenseController;
use App\Http\Controllers\Doctor\EmployeeController;
use App\Http\Controllers\Doctor\ExpenseController;
use App\Http\Controllers\Doctor\MyPatientController;
use App\Http\Controllers\Doctor\WorkingHourController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\PdfController;
use App\Models\Medicament;
use Carbon\Carbon;
use Illuminate\Http\Request;

// use \App\Http\Controllers\Doctor\DoctorController;
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
//for enter cities from the api
// Route::get('/store',[App\Http\Controllers\CityController::class,'store']);

Auth::routes();

// Route::get('/', function () {
//     return view('landing-page');
// })->name('homepage');
// Route::get('/admin/create',[HomeController::class,'createAdmin']);
Route::get('/',[HomeController::class,'index'])->name('homepage');
Route::get('/register/doctor',[RegisterDoctorController::class,'index'])->name('register.docotr');
Route::get('/register/doctor/active/{id}', [RegisterDoctorController::class, 'active'])->name('active.doc');
Route::post('/register/doctor/activeAccount',[RegisterDoctorController::class,'activeAccount'])->name('register.active');
Route::post('/registe/store', [RegisterDoctorController::class, 'store'])->name('register.store');
Route::get('/showdoctor/{id}', [HomeController::class, 'doctorProfile'])->name('doctor.info');
Route::get('/speciality-list',[HomeController::class,'specialityListAjax'])->name('specialityList');
Route::get('/city-list',[HomeController::class,'cityListAjax'])->name('cityList');
Route::post('/search-product',[HomeController::class, 'searchDoctor'])->name('searchdoctor');
Route::get('/all-doctors', [HomeController::class, 'allDoctors'])->name('alldoctors');

Route::group(['middleware'=>'auth'],function(){
    Route::get('generate-pdf/{idordonnance}',[OrdonnanceController::class, 'generatePdf'])->name('pdf.ordonnance');
    Route::prefix('/admin')->middleware('role:admin')->group( function(){
        Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dash');
        Route::resource('permission', PermissionController::class);
        Route::delete('/permission/{idpermission}/delete', [PermissionController::class, 'destroy'])->name('permission.destroy');

        Route::resource('role',RoleController::class);
        Route::delete('/role/{idrole}/delete', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::get("role/{idrole}/give-permissions", [RoleController::class, 'addPermissionToRole'])->name('role.givepermissions');
        Route::put("role/{idrole}/give-permissions", [RoleController::class, 'givePermissionToRole'])->name('role.givepermissions');
        Route::prefix('/speciality')->controller(SpecialityController::class)->name("speciality.")->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/{idsp}/edit',"edit")->name('edit');
            Route::put('/{idsp}/update', "update")->name('update');
            Route::delete('/{idsp}/delete', 'destroy')->name('destroy');
            // Route::get('/addAll','addAll')->name('addAll');
        });

        Route::prefix('/motif')->controller(MotifController::class)->name("motif.")->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/{idm}/edit',"edit")->name('edit');
            Route::put('/{idm}/update', "update")->name('update');
            Route::delete('/{idm}/delete', 'destroy')->name('destroy');
            // Route::get('/getAll','getAll')->name('getAll');
        });

        Route::prefix('/doctor-management')->controller(DoctorController::class)->name("doctor.")->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/{iddoctor}/details', 'detailsDoctor')->name('details');
            Route::get('/{iddoctor}/destroy', 'destroy')->name('destroy');
            Route::get('/{iddoctor}/edit','edit')->name('edit');
            Route::post('/status/{iddoctor}', 'status')->name('status');
            Route::put('/{iddoctor}/update','update')->name('update');
        });
        Route::prefix('/patient-management')->controller(PatientController::class)->name("patient.")->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/{idpatient}/edit','edit')->name('edit');
            Route::put('/{idpatient}/update','update')->name('update');
            Route::get('/{idpatient}/destroy', 'destroy')->name('destroy');
            Route::post('/status/{idpatient}', 'status')->name('status');
            // Route::get('/{iddoctor}/details', 'detailsDoctor')->name('details');
        });
        Route::get('/medicament',[MedicamentController::class,'index'])->name('medicament.index');
        Route::get('/medicament/create',[MedicamentController::class,'create'])->name('medicament.create');
        Route::post('/medicament/import', [MedicamentController::class, 'import'])->name('medicament.import');
    });

    Route::prefix('/doctor')->middleware('role:doctor|employee')->group(function(){
        Route::get('/',[DashboardDocController::class,"index"])->name('cabinet.dash');
        Route::prefix('/category-expenses')->controller(CategoryExpenseController::class)->name('categoryexpense.')->group(function(){
            Route::get('','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::put('/update/{id}','update')->name('update');
            Route::get('/delete/{id}','delete')->name('destroy');
        });
        Route::prefix('/expenses')->controller(ExpenseController::class)->name('expense.')->group(function(){
            Route::get('','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::put('/update/{id}','update')->name('update');
            Route::get('/delete/{id}','delete')->name('destroy');
            Route::post('/status/{id}', 'status')->name('status');

        });
        // Route::prefix('/calendar')->controller()
        Route::get('/calendar',[CalendarController::class,'index'])->name('calendar');
        Route::get('/profile',[CabinetController::class,'profile'])->name("doctor.profile");
        Route::post('/profile/store',[CabinetController::class,'store'])->name("cabinet.store");
        Route::get('/work-office/profile/{idpicture}', [CabinetController::class, 'deletePicture'])->name('office-work.delete');
        Route::get('/business-days',[WorkingHourController::class,'index'])->name("bussinss.days");
        Route::post('/business-days',[WorkingHourController::class,'store'])->name("bussinss.store");
        Route::post('/business-days/holiday',[WorkingHourController::class,'vacance'])->name("bussinss.vacance");

        Route::get('/patients',[MyPatientController::class,'index'])->name('mypatient.index');
        Route::get('/patients/create',[MyPatientController::class,'create'])->name('mypatient.create');
        Route::post('/patients/store',[MyPatientController::class,'store'])->name('mypatient.store');

        Route::post('/details/make-appointment/{idmypatient}', [MyPatientController::class, 'makeAppointment'])->name('mypatient.makeapp');
        Route::prefix('/details')->group(function(){
            Route::get('/{idmypatient}', [MyPatientController::class, 'details'])->name('mypatient.details');
            Route::post('/update/{idmypatient}', [MyPatientController::class, 'update'])->name('mypatient.update');
            Route::post('/observation/{idmypatient}', [MyPatientController::class, 'observation'])->name('mypatient.observation');
            Route::get('/getObser/{observationId}', [MyPatientController::class, 'getObservationId'])->name('getObser');
            Route::put('/observation/update/{idobservation}', [MyPatientController::class, 'observationUpdate'])->name('observation.update');
            Route::get('/observation/delete/{idobservation}', [MyPatientController::class, 'deleteobservation'])->name('observation.delete');
            Route::get('/observation/get/{idpatient}', [MyPatientController::class, 'getObservation'])->name('observation.get');
            Route::get('/appointment/get/{idpatient}', [MyPatientController::class, 'getAppointment'])->name('appointment.get');
            Route::get('/appointment/destroy/{idappointment}', [MyPatientController::class, 'destroyAppointment'])->name('appointmentget.deleted');
            Route::put('/appointment/update/{idappointment}', [MyPatientController::class, 'updateAppointment'])->name('appointmentget.update');
        });
        Route::prefix('/ordonnance')->controller(OrdonnanceController::class)->name('ordonnance.')->group(function(){
            Route::post('/store/{id}', 'ordonnanceStore')->name('store');
            Route::get('/get/{id}', 'ordonnanceGet')->name('get');
            Route::get('/delete/{id}','delete')->name('delete');
            Route::get('/get-specifique-ordonnance/{idordonnance}', 'getOrdonnanceId')->name('getspecifique');
        });

        Route::get('/getDaysInMonth', [MyPatientController::class, 'getDays'])->name('getDaysInMonth');

        Route::prefix('/appointment')->controller(AppointmentController::class)->name('appointment.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/modify/{appointmentId}', 'modify')->name('modify');
            Route::put('/update', 'update')->name('update');
            Route::get('/destroy/{id}','delete')->name('destroy');
            Route::get('/historique-appointments','historique')->name('historique');
        });

        Route::prefix('/acte-care')->controller(ActCareController::class)->name('actcare.')->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store-act-care','storeAct')->name('storeAct');
            Route::get('/get','get')->name('get');
            Route::post('/store-cat', 'storeCat')->name('store');
            Route::get('/delete-cat/{id}','delete')->name('delete');
            Route::get('/delete-act-care/{id}', 'deleteAct')->name('deleteAct');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::put('/update/{id}','update')->name('update');
        });

        Route::prefix('/Emplyee')->controller(EmployeeController::class)->name('employee.')->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::post('/status/{idemployee}', 'statusChange')->name('status');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::put('/update/{id}','update')->name('update');
            Route::get('/delete/{id}','delete')->name('delete');
            Route::get('/give-permission/{id}','givePermissions')->name('givepermissions');
            Route::put('/store-permission/{idemployee}', 'givePermissionsStore')->name('storePermissions');
        });


    });


    Route::prefix('/patient')->controller(ClientController::class)->middleware('role:patient')->name('client.')->group(function () {
        Route::get('/index', "index")->name('index');
        Route::put('/update/{id}', 'update')->name('update');
        Route::post('/make-appointment/{id}', 'appointmentClient')->name('appointment');
        Route::get('/patient-doctor', 'showDoctor')->name('doctor');
        Route::get('/get-doctor/{iddoc}','getDoc')->name('get-doctor');
        Route::get('/patient-ordonnance', 'showOrdonnance')->name('ordonnance');
        Route::post('/appointment/cancelle/{idappointment}','changeStatus')->name('cancelle');
    });

});


