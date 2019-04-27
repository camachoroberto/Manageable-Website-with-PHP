<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 24/04/2019
 * Time: 16:03
 */

require __DIR__ . '/db.php';

if (resolve('/admin/auth/login')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($login ()) {
            flash('Autenticado com sucesso', 'success');
            return header('location: /admin');
        }
        flash('Dados invalidos', 'error');
    }
    render('admin/auth/login', 'admin/login');
} elseif (resolve('/admin/auth/logout')) {
    logout();
}