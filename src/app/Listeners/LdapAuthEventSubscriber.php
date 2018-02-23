<?php
/**
 * Created by PhpStorm.
 * User: idn-lee
 * Date: 18-2-13
 * Time: 下午6:56
 */

namespace DDVue\AdminPanel\app\Listeners;


use Adldap\Laravel\Events\Authenticating;

class LdapAuthEventSubscriber
{


    /**
     * connect to ldap before ldap login
     * @param Authenticating $event
     */
    public function beforeLdapLogin(Authenticating $event) {
        console.log('sdfsdf');
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {

        $events->listen(
            Authenticating::class,
            'DDVue\AdminPanel\app\Listeners\LdapAuthEventSubscriber@beforeLdapLogin'
        );
    }
}