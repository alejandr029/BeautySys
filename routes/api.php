<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AlergiasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$verificationLimiter = config('fortify.limiters.verification', '6,1');

Route::group(
    ['prefix' => config('app.api_version'),
        'as' => config('app.api_version'),
    ],

    function () {
        $limiter = config('fortify.limiters.login');

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            -> middleware(array_filter([
                'guest:'.config('fortify.guard'),
                $limiter ? 'throttle:'.$limiter : null,
            ]));

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware(['guest:'.config('fortify.guard')]);

//        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
//            ->middleware(['guest:'.config('fortify.guard')])
//            ->name('password.email');

        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return $request->user();
        });

        Route::middleware('auth:sanctum')->get('/consulta/alergias/id={id}', [AlergiasController::class, 'getAlergias']);

    }
);
