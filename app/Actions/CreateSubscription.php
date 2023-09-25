<?php

namespace App\Actions;

use App\Models\Subscription;

class CreateSubscription
{
    /** @param $data array
     * @return Subscription
     *
     */
    public function __invoke($data): Subscription
    {
        return Subscription::create($data);
    }
}
