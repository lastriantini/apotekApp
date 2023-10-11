<?php
use App\Http\Controllers\MedicineController;
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

Route::get('/', function () {
    return view('index');
});
//prefix:awalan, semua patch url yang ada di dalam group nya 
//nanti ketika diakses hatus terlebih dahulu diawali dengan patch
//name: awalan value name route yang ada di dalam group
//group: mengelompokkan route yang memiliki akses data modifikasi yang sama
Route::prefix('medicine')->name('medicine.')->group(function() {
    //ketika patch /medicine/cerate diakse, akan ditangani oleh mendicineControler bagian func create, 
    //kemudian jika ingin menggunakan route ini di kodenya dipanngil melalui name medicine.create
    Route::get('/create', [MedicineController::class, 'create'])->name('create');
    Route::post('/store', [MedicineController::class, 'store'])->name('store');
    Route::get('/data', [MedicineController::class, 'index'])->name('index');
    //path yang ada tanda {} nya disebut dengna path parameter/path dinamis uag isinya bakal beribah2 terganting apa yang mau diambil 
    //(mengambil data spesifik), dan ketika pemeanggilan name route nya, path parameter ini wajib diisi
    Route::get('/edit/{id}', [MedicineController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [MedicineController::class, 'update'])->name('update');
    //update bisa patch atau put
    Route::delete('/delete/{id}', [MedicineController::class, 'destroy'])->name('delete');
    Route::get('/stock', [MedicineController::class, 'stockData'])->name('stock');
    Route::get('/{id}', [MedicineController::class, 'show'])->name('show');
    
});

