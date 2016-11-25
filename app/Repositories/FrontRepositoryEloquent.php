<?php

namespace App\Repositories;

use App\Models\PostedJob;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class FrontRepositoryEloquent
 * @package namespace App\Repositories;
 */
class FrontRepositoryEloquent extends BaseRepository implements FrontRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostedJob::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
