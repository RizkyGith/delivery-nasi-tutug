<?php
namespace App\Driver;

use Xinix\BonoAuth\Driver\NormAuth;

class MemberAuth extends NormAuth
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
                array('email' => $options['username']),
                array('normalized_username' => str_replace('.', '', $options['username'])),
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

        $_SESSION['user'] = $user->toArray();

        $app->redirect(\URL::site('static'));

        return $user->toArray();

    }

    public function authorize($options = '')
    {
        if (empty($options)) {
            $options = array(
                // 'uri' => \App::getInstance()->request->getPathInfo(),
                'uri' => '/test',
                'uri' => '/home',
                'uri' => '/static',
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

        $app->redirect(\URL::site('home'));
    }
}
