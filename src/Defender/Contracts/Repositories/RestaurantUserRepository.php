<?php

namespace Artesaos\Defender\Contracts\Repositories;

interface RestaurantUserRepository extends AbstractRepository
{
    public function attachRole($roleName);

    public function attachPermission($permissionName, array $options = []);
}
