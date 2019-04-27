<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 05/04/2019
 * Time: 10:35
 */

auth_protection();

if (resolve('/admin')) {
    render('admin/home', 'admin');

} elseif (resolve('/admin/auth.*')) {
    include __DIR__ . '/auth/routes.php';

} elseif (resolve('/admin/pages.*')) {
    include __DIR__ . '/pages/routes.php';

} elseif (resolve('/admin/users.*')) {
    include __DIR__ . '/users/routes.php';

} elseif (resolve('/admin/upload/image')) {
//    echo 'Deu certo na routes'; //verifica em inspecionar pagina Console
//    echo json_encode($_FILES); // verifica em inspecionar pagina Network image e esta a routa e detalhas do arquivo
    $file = $_FILES['file'] ?? null;

    if (!$file) {
        http_response_code(422);
        echo 'nemhum arquivo enviado';
        exit;
    }

    $allowedTypes = [
        'image/gif',
        'image/jpg',
        'image/jpeg',
        'image/png'
    ];

    if (!in_array($file['type'], $allowedTypes)) {
        http_response_code(422);
        echo 'arquivo não permitido';
        exit;
    }

    $name = uniqid(rand(), true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

    move_uploaded_file($file['tmp_name'], __DIR__ . '/../public/upload/' . $name);

    echo '/upload/' . $name;

} else {
    http_response_code(404);
    echo 'Pagina nao encontrada';
}
