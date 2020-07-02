<?php

namespace Api;

class Users extends AbstractApi
{
    public function getCurrentUser($login)
    {
        $users = $this->client->user->getCurrentUser(['login' => $login]);
        if (isset($users['user'])) {
            return $users['user'];
        }

        return null;
    }
}
