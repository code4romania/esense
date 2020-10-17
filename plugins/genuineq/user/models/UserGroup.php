<?php namespace Genuineq\User\Models;

use October\Rain\Auth\Models\Group as GroupBase;
use ApplicationException;

/**
 * User Group Model
 */
class UserGroup extends GroupBase
{
    const GROUP_GUEST = 'guest';
    const GROUP_REGISTERED = 'registered';

    /**
     * @var string The database table used by the model.
     */
    protected $table = 'user_groups';

    /**
     * Validation rules
     */
    public $rules = [
        'name' => 'required|between:3,64',
        'code' => 'required|regex:/^[a-zA-Z0-9_\-]+$/|unique:user_groups',
    ];

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'users'       => [User::class, 'table' => 'users_groups'],
        'users_count' => [User::class, 'table' => 'users_groups', 'count' => true]
    ];

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    protected static $guestGroup = null;
    protected static $registeredGroup = null;

    /**
     * Returns the requested group based on the group code.
     * @param string $code The group code
     * @return Genuineq\User\Models\UserGroup
     */
    public static function getGroup($code)
    {
        return UserGroup::whereCode($code)->first();
    }

    /**
     * Returns the guest user group.
     * @return Genuineq\User\Models\UserGroup
     */
    public static function getGuestGroup()
    {
        if (self::$guestGroup !== null) {
            return self::$guestGroup;
        }

        $group = self::where('code', self::GROUP_GUEST)->first() ?: false;

        return self::$guestGroup = $group;
    }

    /**
     * Returns the registered user group.
     * @return Genuineq\User\Models\UserGroup
     */
    public static function getRegisteredGroup()
    {
        if (self::$registeredGroup !== null) {
            return self::$registeredGroup;
        }

        $group = self::where('code', self::GROUP_REGISTERED)->first() ?: false;

        return self::$registeredGroup = $group;
    }
}