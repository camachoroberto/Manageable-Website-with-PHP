<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 22/04/2019
 * Time: 14:43
 */

function users_get_data($redirectOnError)
{
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (!$email) {
        flash('Informe o campo email', 'error');
        header('location: ' . $redirectOnError);
        die();
    }

    return compact('email', 'password');
}

$users_all = function () use ($conn) {
    $result = $conn->query('SELECT * FROM users');
    return $result->fetch_all(MYSQLI_ASSOC);
};

$users_view = function ($id) use ($conn) {

    $sql = 'SELECT * FROM users where id=?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();

};


$users_create = function () use ($conn) {
    $data = users_get_data('/admin/users/create');

    $sql = 'INSERT INTO users (email, password, updated, created) VALUE (?,?, NOW(), NOW())';

    if (is_null($data['password'])) {
        flash('Informe o campo email', 'error');
        header('location: /admin/users/create');
        die();
    }

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $data['email'], $data['password']);

    flash('Salvo com sucesso', 'success');

    return $stmt->execute();
};

$users_edit = function ($id) use ($conn) {
    var_dump('ok');
    $data = users_get_data('/admin/users/' . $id . '/edit');

    $sql = 'UPDATE users SET email=?, updated=NOW() WHERE id=?';

    if ($data['password']) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = 'UPDATE users SET email=?, password=?, updated=NOW() WHERE id=?';
    }

    $stmt = $conn->prepare($sql);

    if ($data ['password']) {
        $stmt->bind_param('ssi', $data['email'], $data['password'], $id);
    } else {
        $stmt->bind_param('si', $data['email'], $id);
    }

    flash('Atualizou registro com sucesso', 'success');

    return $stmt->execute();
};

$users_delete = function ($id) use ($conn) {

    $sql = 'DELETE FROM users WHERE id= ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    flash('Removeu usuario com sucesso', 'success');

    return $stmt->execute();
};

