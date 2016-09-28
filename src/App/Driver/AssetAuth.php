<?php

namespace App\Driver;

use Xinix\BonoAuth\Driver\NormAuth;

class AssetAuth extends NormAuth
{
    public function authenticate(array $options = array())
    {
        $app = \App::getInstance();


        if (!isset($options['username']) && !isset($options['password'])) {
            return null;
        }

        $userCollection = \Norm\Norm::factory(@$this->options['userCollection'] ?: 'User');

        $user = $userCollection->findOne(array(
            '!or' => array(
                array('username' => $options['username']),
            ),
        ));


        if (function_exists('salt')) {
            $options['password'] = salt($options['password']);
        }

        if (is_null($user) || $user['password'].'' !== $options['password']) {
            return null;
        }

        if (empty($options['keep'])) {
            $app->session->reset();
        } else {
            $app->session->reset(array(
                'lifetime' => 365 * 24 * 60 * 60
            ));
        }
        $client = \Norm::factory('Client')->findOne();
        $_SESSION['user'] = $user->toArray();
        $_SESSION['client'] = $client->toArray();
        return $user->toArray();

    }

    public function authorize($options = '')
    {
        if (empty($options)) {
            $options = array(
                'uri' => \App::getInstance()->request->getPathInfo(),
            );
        }

        if (is_string($options)) {
            $options = array('uri' => $options);
        }

        $authorized = f('auth.authorize', $options);
        if (is_bool($authorized)) {
            return $authorized;
        }

        if (!empty($_SESSION['user'])) {
            return true;
        }
    }

    public function revoke()
    {
        $app = \App::getInstance();

        $app->session->reset();

        $app->redirect($this->options['unauthorizedUri']);
    }
}
