<?php

class Custom_Portal_Auth
{
    public function login(string $username, string $password): bool
    {
        return wp_signon(trim($username), $password);
    }

    public function logout(): void
    {
        wp_logout();
    }
}