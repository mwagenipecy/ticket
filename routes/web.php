<?php


// Redirect to login page

Route::redirect("/register", "/login");
Route::redirect('/', 'login');

// Group routes that require authentication
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/System', \App\Http\Livewire\System::class)->name('System');

    Route::fallback(function() {
        return view('pages/utility/404');
    });
});








