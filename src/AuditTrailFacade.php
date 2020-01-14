<?php

namespace Kingsleyudenewu\AuditTrail;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kingsleyudenewu\AuditTrail\Skeleton\SkeletonClass
 */
class AuditTrailFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'audit-trail';
    }
}
