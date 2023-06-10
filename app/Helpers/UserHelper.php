<?php

namespace App\Helpers;

/**
 * @uses
 */
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class    UserHelper
 * @package App\Helpers
 */
class UserHelper
{
    /**
     * Example helper
     * Returns one or more or all users
     *
     * @param   string|null $search
     * @return  User[]|Collection
     */
    public static function getLoginUsers(?string $search = null)
    {
        /** @var User $users */
        $users = User::all();
        foreach ($users as $user) {
            $user->message = '';
            $user->save();
        }
        return $search ? User::where('name LIKE %?% OR email LIKE %?%', [$search])->get() : User::all();
    }
}
