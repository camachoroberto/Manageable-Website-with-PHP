<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 05/04/2019
 * Time: 10:15
 */

require __DIR__ . '/../admin/pages/db.php';

if (resolve('/contato')) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $from = filter_input(INPUT_POST, 'from');
        $subject = filter_input(INPUT_POST, 'subject');
        $message = filter_input(INPUT_POST, 'message');
        $headers = 'From: ' . $from . "\r\n" .
            'Reply-To' . $from . "\r\n".
            'X-Mailer: PHP/' . phpversion();

        if (mail('camachof.roberto@gmail.com', $subject, $message, $headers)){
            flash('Email enviado com sucesso', 'success');
        }else{
            flash('Algo deu errado e o email não foi enviado, tente usar o telefone', 'error');
        }
        return header('location: /contato');
    }
        $pages = $pages_all();
    render('site/contato', 'site', compact('pages'));
} elseif ($params = resolve('/(.*)')) {
    $pages = $pages_all();

    foreach ($pages as $page) {
        if ($page['url'] == $params[1]) {
            break;
        }
    }
    render('site/page', 'site', compact('pages', 'page'));
}


//paginas não encontradas
/*else{
    http_response_code(404);
    echo 'Pagina nao encontrada';
}*/
