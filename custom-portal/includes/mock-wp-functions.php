<?php

function is_user_logged_in(): bool
{
    return isset($_SESSION['user']);
}

function wp_signon(string $username, string $password): bool
{
    $valid_users = ['admin' => 'admin123'];

    if (!isset($valid_users[$username]) || $valid_users[$username] !== $password) {
        return false;
    }

    $_SESSION['user'] = [
        'display_name' => 'Administrator',
        'user_login' => $username,
        'user_email' => 'admin@example.test',
        'role' => 'administrator',
    ];

    return true;
}

function wp_get_current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function wp_logout(): void
{
    unset($_SESSION['user']);
}