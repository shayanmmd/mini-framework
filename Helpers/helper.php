<?php

function view($path, $data = []) #for example :: errors.404
{
    extract($data);
    if (is_null($path) || empty($path))
        throw new Exception();
    $path = str_replace('.', '/', $path);
    include_once BASE_PATH . "views/" . $path . ".php";
    die();
}

function css($path)
{
    return BASE_PATH . "Assets/Css/" . $path;
}

function js($path)
{
    return BASE_PATH . "Assets/Js/" . $path;
}

function image($path)
{
    return BASE_PATH . "Assets/Images/" . $path;
}
