<?php
namespace gift\app\services\utils;

class CsrfService {
    /**
     * generate() : generates a token, stores it in session and returns
     */
    function generateToken() {
        $token = $this->generateToken();
        $this->storeToken($token);
        return $token;
    }

    /**
     * check() : compares the received token to the token stored in session,
     * raises an exception in case of failure,
     * removes the token in session.
     */
    function checkToken($token) {
        if ($token !== $this->getToken()) {
            throw new \Exception('Invalid CSRF token');
        }
        $this->removeToken();
    }
}