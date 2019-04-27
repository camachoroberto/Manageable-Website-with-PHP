<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 22/04/2019
 * Time: 13:39
 */

include __DIR__ . '/db.php';

if (resolve('/admin/users')) {
    $users = $users_all();

    render('admin/users/index', 'admin', compact('users'));

} elseif (resolve('/admin/users/create')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $users_create();
        return header('location: /admin/users');
    }
    render('admin/users/create', 'admin');

} elseif ($params = resolve('/admin/users/(\d+)')) {
    $user = $users_view($params[1]);
    render('admin/users/view', 'admin', ['user' => $user]);

} elseif ($params = resolve('/admin/users/(\d+)/edit')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $users_edit($params[1]);
        return header('location: /admin/users/' . $params[1]);
    }

    $user = $users_view($params[1]);
    render('admin/users/edit', 'admin', compact('user'));

} elseif ($params = resolve('/admin/users/(\d+)/delete')) {
    $users_delete($params[1]);
    return header('location: /admin/users');

}