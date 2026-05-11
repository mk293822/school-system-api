<?php

use App\Tenancy\Http\Controllers\Api\V1\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/tenants', [TenantController::class, 'index']);
