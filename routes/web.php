<?php

use Illuminate\Support\Facades\Route;
use Kingsleyudenewu\AuditTrail\AuditTrail;
use Kingsleyudenewu\AuditTrail\Models\AuditTrail as Audit;

Route::group(['prefix' => 'audit'], function () {
    Route::get('/logs', function (){
        $logs = new AuditTrail();
        $logs->getAllLogs(25, true);
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $logs
        ]);
    });

    Route::get('/logs/{id}', function ($id) {
        $user_log = Audit::where('user_id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $user_log,
        ]);
    });
});
