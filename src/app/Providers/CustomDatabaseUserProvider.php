<?php
/**
 * Created by PhpStorm.
 * User: idn-lee
 * Date: 18-2-22
 * Time: 下午4:03
 */


namespace DDVue\AdminPanel\app\Providers;


use Adldap\Laravel\Auth\DatabaseUserProvider;
use Adldap\Laravel\Commands\Import;
use Adldap\Laravel\Commands\SyncPassword;
use Adldap\Laravel\Events\Authenticated;
use Adldap\Laravel\Events\AuthenticatedWithCredentials;
use Adldap\Laravel\Events\Authenticating;
use Adldap\Laravel\Events\AuthenticationFailed;
use Adldap\Laravel\Events\AuthenticationRejected;
use Adldap\Laravel\Events\AuthenticationSuccessful;
use Adldap\Laravel\Events\DiscoveredWithCredentials;
use Adldap\Laravel\Events\Imported;
use Adldap\Laravel\Facades\Resolver;
use Adldap\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;

class CustomDatabaseUserProvider extends DatabaseUserProvider
{

    /**
     * Constructor.
     *
     * @param Hasher $hasher
     * @param string $model
     */
    public function __construct()
    {
        $model = array_get(app('config'), 'auth.providers.ldap.model');
        parent::__construct(app('hash'), $model);
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveByCredentials(array $credentials)
    {
        $username = $credentials[ Resolver::getEloquentUsernameAttribute() ];
        //app('adldap')->connect(null, $username, $credentials['password']);

        app('adldap')->connect(null, $username, $credentials['password']);
        // Retrieve the LDAP user who is authenticating.

        $user = Resolver::byCredentials($credentials);

        if ($user instanceof User) {
            // Set the currently authenticating LDAP user.
            $this->user = $user;

            Event::fire(new DiscoveredWithCredentials($user));

            // Import / locate the local user account.
            return Bus::dispatch(
                new Import($user, $this->createModel(), $credentials)
            );
        }

        if ($this->isFallingBack()) {
            return $this->fallback->retrieveByCredentials($credentials);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validateCredentials(Authenticatable $model, array $credentials)
    {
        if ($this->user instanceof User) {
            // If an LDAP user was discovered, we can go
            // ahead and try to authenticate them.
            if ($this->authenticate($this->user, $credentials)) {
                Event::fire(new AuthenticatedWithCredentials($this->user, $model));

                // Here we will perform authorization on the LDAP user. If all
                // validation rules pass, we will allow the authentication
                // attempt. Otherwise, it is automatically rejected.
                if ($this->passesValidation($this->user, $model)) {
                    // Here we can now synchronize / set the users password since
                    // they have successfully passed authentication
                    // and our validation rules.
                    Bus::dispatch(new SyncPassword($model, $credentials));

                    // 去掉 -胜利油田
                    $model->displayname = '';
                    if (is_array($this->user->displayname) && !isEmpty($this->user->displayname[0]))
                        $model->displayname = explode('-', $this->user->displayname[0])[0];

                    $model->save();

                    if ($model->wasRecentlyCreated) {
                        // If the model was recently created, they
                        // have been imported successfully.
                        Event::fire(new Imported($this->user, $model));
                    }

                    Event::fire(new AuthenticationSuccessful($this->user, $model));

                    return true;
                }

                Event::fire(new AuthenticationRejected($this->user, $model));
            }

            // LDAP Authentication failed.
            return false;
        }

        if ($this->isFallingBack() && $model->exists) {
            // If the user exists in our local database already and fallback is
            // enabled, we'll perform standard eloquent authentication.
            return $this->fallback->validateCredentials($model, $credentials);
        }

        return false;
    }

    public function authenticate(User $user, array $credentials = [])
    {
        $attribute = $this->getLdapAuthAttribute();

        // If the developer has inserted 'dn' as their LDAP
        // authentication attribute, we'll convert it to
        // the full attribute name for convenience.
        if ($attribute == 'dn') {
            $attribute = $user->getSchema()->distinguishedName();
        }

        $username = $user->getFirstAttribute($attribute);

        $password = $this->getPasswordFromCredentials($credentials);

        Event::fire(new Authenticating($user, $username));

        if (\Adldap::getProvider('default')->auth()->attempt($username, $password, $bindAsUser = true)) {
            Event::fire(new Authenticated($user));

            return true;
        }

        Event::fire(new AuthenticationFailed($user));

        return false;
    }

    private function getLdapAuthAttribute(): string
    {
        return Config::get('adldap_auth.usernames.ldap.authenticate', 'distinguishedname');
    }

    private function getPasswordFromCredentials($credentials)
    {
        return array_get($credentials, 'password');
    }
}