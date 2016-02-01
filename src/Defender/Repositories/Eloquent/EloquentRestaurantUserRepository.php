<?php

namespace Artesaos\Defender\Repositories\Eloquent;

use Artesaos\Defender\Contracts\Repositories\RestaurantUserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Foundation\Application;

class EloquentRestaurantUserRepository extends AbstractEloquentRepository implements RestaurantUserRepository
{
    public function __construct(Application $app, Model $user)
    {
        parent::__construct($app, $user);
    }

    public function attachRole($roleName)
    {
        return $this->model->attachRole($roleName);
    }

    public function attachPermission($permissionName, array $options = [])
    {
        return $this->model->attachPermission($permissionName, $options);
    }
}
