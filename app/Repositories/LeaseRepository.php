<?php

namespace  App\Repositories;

use App\Models\Tags;
use Illuminate\Support\Collection;

/**
 * Class LeaseRepository
 *
 * @package App\Repositories
 */
class LeaseRepository
{
    /**
     * Method where we define all the lease statusses used trough the application.
     *
     * @return Collection
     */
    public function getStatusses(): Collection
    {
        return Tags::whereSection('lease')->where('name', '!=', 'Nieuwe aanvraag')->pluck('name', 'id');
    }
}
