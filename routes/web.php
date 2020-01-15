<?php

use Illuminate\Support\Facades\Route;
use Kingsleyudenewu\AuditTrail\Models\AuditTrail;

Route::group(['prefix' => 'audit'], function () {
    Route::get('/logs', function (){
        $logs = AuditTrail::getAllLogs(25, true);
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $logs
        ]);
    });

    Route::get('/logs/{id}', function ($id){
        $user_log = AuditTrail::where('user_id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $user_log
        ]);
    });
});
