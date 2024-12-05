<?php

use App\Http\Controllers\Mdd\CompanyController;
use App\Http\Controllers\Mdd\SuperAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\superadmin\BillController;
use App\Http\Controllers\SuperAdmin\ComplaintController;
use App\Http\Controllers\SuperAdmin\CustomerController;
use App\Http\Controllers\SuperAdmin\EmployeeController;
use App\Http\Controllers\SuperAdmin\InstallationController;
use App\Http\Controllers\SuperAdmin\IsolateController;
use App\Http\Controllers\Superadmin\PaymentController;
use App\Http\Controllers\SuperAdmin\RecordMeterController;
use App\Http\Controllers\SuperAdmin\ReportController;
use App\Http\Controllers\SuperAdmin\SettingsController;
use App\Http\Controllers\SuperAdmin\TariffCategoryController;
use App\Http\Controllers\TariffLevelController;
use Illuminate\Support\Facades\Route;

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

use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorPNG;

// Route::get('/', function () {
//     session_start();
//     if(Auth::check()) {
//         if (Auth::user()->hasRole('mdd')) {
//                     session()->flash("toast_true", 2);
//         session()->flash("toast_false", 1);
//             return redirect()->to('mdd');
//         }

//         if (Auth::user()->hasRole('superadmin')) {
//                     session()->flash("toast_true", 2);
//         session()->flash("toast_false", 1);
//             return redirect()->to('superadmin');
//         }
//     } else {
//         return view('auth.login');
//     }
// });

Route::get('/', function () {
    session_start();
    if (Auth::check()) {

        if (Auth::user()->hasRole('mdd')) {
            return redirect()->to('mdd');
        }

        if (Auth::user()->hasRole('superadmin')) {
            return redirect()->to('superadmin');
        }
    } else {
        return view('auth.login');
    }
});



Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('main-dashboard');

Route::get('/mdd', function () {
    return view('pages.mdd.index');
})->middleware(['auth', 'verified', 'role:mdd'])->name('mdd-dashboard');

Route::get('/company-data', function () {
    return view('company-data');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('company-data');

Route::middleware(['auth', 'verified', 'role:mdd'])->group(function () {
    Route::get('/mdd/company-data', [CompanyController::class, 'index'])->name('mdd-company-data');
    Route::get('/mdd/company-data/details/{id_company}', [CompanyController::class, 'details'])->name('mdd-company-data-details');
    Route::get('/mdd-company-data/create', [CompanyController::class, 'create'])->name('mdd-company-data-create');
    Route::post('/storecom', [CompanyController::class, 'storecom'])->name('company.store');
    Route::put('/updatecom/{id_company}', [CompanyController::class, 'updatecom'])->name('company.update');
    Route::delete('/deletecom/{id_company}', [CompanyController::class, 'deletecom'])->name('company.delete');

    Route::get('/mdd/sadmin-data', [SuperAdminController::class, 'index'])->name('mdd-sadmin');
    Route::post('/storemin', [SuperAdminController::class, 'storemin'])->name('sadmin.store');
    Route::put('/updatemin/{id}', [SuperAdminController::class, 'updatemin'])->name('sadmin.update');
    Route::delete('/deletemin/{id}', [SuperAdminController::class, 'deletemin'])->name('sadmin.delete');
});

Route::get('/superadmin', function () {
    return view('pages.superadmin.dashboard-superadmin');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('superadmin-dashboard');

Route::middleware(['auth', 'verified', 'role:superadmin'])->group(function () {
    // Company
    Route::post('/storebea', [CompanyController::class, 'storebea'])->name('company.storebea');
    //Customer Barcode
    Route::get('/customer', [CustomerController::class, 'index'])->name('superadmin-customer');
    Route::post('/customer/print-barcode', [CustomerController::class, 'cetakBarcode'])->name('print-barcode');

    //Installation
    Route::get('/install', [InstallationController::class, 'index'])->name('superadmin-install');
    Route::get('/search', [InstallationController::class, 'search'])->name('superadmin-search');
    Route::post('install/store', [InstallationController::class, 'store'])->name('install.store');
    Route::post('install/update/{id_customer}', [InstallationController::class, 'update'])->name('install.update');
    Route::delete('install/delete/{id_customer}', [InstallationController::class, 'delete'])->name('install.delete');
    Route::delete('install/deleteallcus', [InstallationController::class, 'deleteall'])->name('install.deleteall');
    Route::post('/customer/cetak-barcode', [InstallationController::class, 'cetakBarcode'])->name('cetak-barcode');
    Route::put('/customer/{id_customer}/isolated', [InstallationController::class, 'isolate'])->name('install.isolated');

    //Report
    Route::get('/customer/report', [ReportController::class, 'reportCustomer'])->name('customer.report');
    Route::get('/customer/export', [ReportController::class, 'exportCustomer'])->name('customer.export');
    Route::get('/payment/report', [ReportController::class, 'reportPayment'])->name('payment.report');
    Route::get('/payment/export', [ReportController::class, 'exportPayment'])->name('payment.export');
    Route::get('/payment/date', [ReportController::class, 'filterDate'])->name('payment.date');


    //isolate
    Route::get('/isolate', [IsolateController::class, 'index'])->name('superadmin-isolate');

    //Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('superadmin-employee');
    Route::post('/storem', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/updatem/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/deletem/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    Route::delete('/deleteallem', [EmployeeController::class, 'deleteall'])->name('employee.deleteall');

    //Record Meter
    Route::get('/Rmeter', [RecordMeterController::class, 'index'])->name('superadmin-rmeter');
    Route::put('/customer/addMeter', [RecordMeterController::class, 'addMeter'])->name('rmeter.addMeter');

    //Complaint
    Route::get('/Complaint', [ComplaintController::class, 'index'])->name('superadmin-complaint');

    //Setting Profile
    Route::get('/setting', [SettingsController::class, 'index'])->name('superadmin.profile');
    Route::put('/setting/{id}/update', [SettingsController::class, 'update'])->name('setting.update');

    //bill
    Route::get('/Bills', [BillController::class, 'index'])->name('superadmin-bills');
    Route::put('/Bills/{id}/approve', [BillController::class, 'approve'])->name('bill.approve');

    //payment
    Route::get('/Payment', [PaymentController::class, 'index'])->name('superadmin-payment');

    // Tariff Group
    Route::get('/tariff', [TariffCategoryController::class, 'index'])->name('superadmin-tariff');
    Route::post('/tariff/store', [TariffCategoryController::class, 'store'])->name('tariff.store');
    Route::post('/tariff/update/{id}', [TariffCategoryController::class, 'update'])->name('tariff.update');
    Route::delete('/tariff/{id}', [TariffCategoryController::class, 'delete'])->name('tariffs.delete');

    Route::post('/tariff-level', [TariffLevelController::class, 'store'])->name('tariff-level-store');
    Route::get('/tariff-level/create/{group_id}', [TariffLevelController::class, 'create'])->name('tariff-level-create');
    Route::put('/tariff-level/{id}', [TariffLevelController::class, 'update'])->name('tariff-level.update');
    Route::delete('/tariff-group/{id}', [TariffLevelController::class, 'destroy'])->name('tariff-group-delete');
});



// Employee Data
Route::get('/employee-data', function () {
    return view('pages.superadmin.employee-data');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('superadmin-employee-data');

// Company Data
Route::get('/company-data', function () {
    return view('pages.superadmin.company-data');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('superadmin-company-data');

// Isolated Data
Route::get('/isolated-customers', function () {
    return view('pages.superadmin.isolated-customers-data');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('superadmin-isolated-data');

// New Install meter
Route::get('/new-install-data', function () {
    return view('pages.superadmin.new-install-data');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('new-install-data');

// Bill Data
Route::get('/bill-data', function () {
    return view('pages.superadmin.bill-data');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('bill-data');

// Payment Data
Route::get('/payment-data', function () {
    return view('pages.superadmin.payment-data');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('payment-data');

// Complaint Data
Route::get('/complaint-data', function () {
    return view('pages.superadmin.complaint-data');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('complaint-data');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/* Spatie */
// Route::get('mdd', function() {
//     return '<h1>Hai MDD</h1>';
// })->middleware(['auth', 'verified', 'role:mdd']);

// Route::get('superadmin', function() {
//     return '<h1>Hai Super Admin</h1>';
// })->middleware(['auth', 'verified', 'role:superadmin']);

// Route::get('admin', function() {
//     return '<h1>Hello Buddys</h1>';
// })->middleware(['auth', 'verified', 'role_or_permission:view_dashboard_admin|superadmin']);

/* from minible */

// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
// // Language Translation

// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');



require __DIR__ . '/auth.php';
