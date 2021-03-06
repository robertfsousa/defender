<?php

namespace Artesaos\Defender;

use Illuminate\Database\Eloquent\Model;
use Artesaos\Defender\Traits\Permissions\RoleHasPermissions;

/**
 * Class Role.
 */
class Role extends Model
{
    use RoleHasPermissions;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table;

    /**
     * Mass-assignment whitelist.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'readable_name',
        'type'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('defender.role_table', 'roles');
    }

    /**
     * Many-to-many role-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            config('auth.model'),
            config('defender.role_user_table'),
            config('defender.role_key'),
            'user_id'
        );
    }

    /**
     * Many-to-many role-restaurant_user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function restaurant_users()
    {
        return $this->belongsToMany(
            config('defender.restaurant_user_model')
        )->withPivot('value', 'expires');
    }

}
