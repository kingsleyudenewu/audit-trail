<?php

namespace Kingsleyudenewu\AuditTrail;

class AuditTrail
{
    // Build your next great package.
    public function getAllLogs($limit = 25, $paginate = true)
    {
        if ($paginate) {
            return \Kingsleyudenewu\AuditTrail\Models\AuditTrail::paginate($limit);
        }

        return \Kingsleyudenewu\AuditTrail\Models\AuditTrail::all();
    }

    public function getUserLog($user_id)
    {
        try {
            if (! is_null($user_id)) {
                \Kingsleyudenewu\AuditTrail\Models\AuditTrail::where('user_id', $user_id)->get();
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function log($action, $comment = null)
    {
        return \Kingsleyudenewu\AuditTrail\Models\AuditTrail::firstOrCreate([
            'user_id' => \Auth::id(),
            'model' => get_class($this),
            'action' => $action,
            'comment' => $comment,
        ]);
    }
}
