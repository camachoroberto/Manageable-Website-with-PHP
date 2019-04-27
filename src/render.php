<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 05/04/2019
 * Time: 13:15
 */

function render($content, $template, array $data = [])
{
    $content = __DIR__ . '/../templates/' . $content . '.tpl.php';
    return include __DIR__ . '/../templates/' . $template . '.tpl.php';
}
