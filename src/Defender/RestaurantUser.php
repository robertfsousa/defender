<?php

namespace Artesaos\Defender;

use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Database\Eloquent\Model;

class RestaurantUser extends Model
{

    use HasDefender;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    /**
     * Many-to-many role-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        $roleModel = config('defender.role_model', 'Artesaos\Defender\Role');
        $roleUserTable = 'role_restaurant_user';
        $roleKey = config('defender.role_key', 'role_id');

        return $this->belongsToMany($roleModel, $roleUserTable, 'restaurant_user_id', $roleKey);
    }

    /**
     * Many-to-many permission-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(
            config('defender.permission_model'),
            'permission_restaurant_user',
            'restaurant_user_id',
            config('defender.permission_key')
        )->withPivot('value', 'expires');
    }

    public function getRolesStrAttribute()
    {
        return $this->roles->implode('name', ', ');
    }


}
