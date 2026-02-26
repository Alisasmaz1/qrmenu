<?php
namespace Core;

class Security
{
    /**
     * Simple XSS clean function
     * 
     * @param array|string $field Field to be cleaned
     * 
     * @return array|string cleaned data 
     */

    private const CSRF_EXPIRE_MINUTES = 60;


    public static function xssClean($field)
    {
        if (is_array($field)) return array_map(Security::class . '::xssClean', $field);
        return htmlspecialchars($field, ENT_QUOTES);
    }


    /**
     * Get/Generate CSRF token and store in $_SESSION['_token'] field
     */
    public static function getCsrfToken()
    {
        if (
            is_null(session('_token')) || (time() - session('_token_time')) / 60 >= self::CSRF_EXPIRE_MINUTES
        ) {
            session('_token', bin2hex(random_bytes(32)));
            session('_token_time', time());
        }
        return session('_token');
    }


    /**
     * Check whether CSRF token is valid or not
     * 
     * @param string $token Token to be matched with one in session
     * 
     * @return bool
     */
    public static function checkCsrfToken($token)
    {
        return hash_equals(session('_token'), $token) && (time() - session('_token_time')) / 60 < self::CSRF_EXPIRE_MINUTES;
    }
}
