<?php

namespace App\Ldap\Rules;

use Illuminate\Database\Eloquent\Model as Eloquent;
use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\Model as LdapRecord;
use LdapRecord\Models\OpenLDAP\Group;

class OnlyUsers implements Rule
{
    /**
     * Check if the rule passes validation.
     */
    public function passes(LdapRecord $user, Eloquent $model = null): bool
    {
        
        return $user->groups()->exists([
            Group::findOrFail('ou=mathematicians,dc=example,dc=com'),
            Group::findOrFail('ou=scientists,dc=example,dc=com'),
        ]);
    }
}
