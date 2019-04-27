<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 24/04/2019
 * Time: 17:19
 */

function get_user()
{
    return $_SESSION['auth'] ?? null;
}

function auth_protection()
{
    $user = get_user();

    if (!$user and !resolve('/admin/auth.*')) {
        header('location: /admin/auth/login');
        die();
    }
}

function logout()
{
    unset($_SESSION['auth']);
    flash('Você se desconectou', 'success');
    header('location: /admin/auth/login');
    die();
}