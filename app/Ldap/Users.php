<?php

namespace App\Ldap;

// use LdapRecord\Models\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;

class Users extends Model
{
    /**
     * The object classes of the LDAP model.
     */
    protected ?string $connection = 'usersldap';
    public static array $objectClasses = [];
}
