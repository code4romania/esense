<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    const GROUP_GUEST = 'guest';
    const GROUP_REGISTERED = 'registered';

    public array $rules = [
        'name' => 'required|between:3,64',
        'code' => 'required|regex:/^[a-zA-Z0-9_\-]+$/|unique:user_group',
    ];

    public array $belongsToMany = [
        'users'       => [User::class, 'table' => 'users_groups'],
        'users_count' => [User::class, 'table' => 'users_groups', 'count' => true]
    ];

    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    protected static $guestGroup = null;
    protected static $registeredGroup = null;


    public static function getGroup(string $code): self
    {
        return UserGroup::whereCode($code)->first();
    }

    public static function getGuestGroup(): self
    {
        if (self::$guestGroup !== null) {
            return self::$guestGroup;
        }

        $group = self::where('code', self::GROUP_GUEST)->first() ?: false;

        return self::$guestGroup = $group;
    }

    public static function getRegisteredGroup(): self
    {
        if (self::$registeredGroup !== null) {
            return self::$registeredGroup;
        }

        $group = self::where('code', self::GROUP_REGISTERED)->first() ?: false;

        return self::$registeredGroup = $group;
    }

    public function delete(): bool
    {
        $this->users()->detach();
        return parent::delete();
    }
}
