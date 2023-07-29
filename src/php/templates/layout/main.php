<?php

use League\Plates\Template\Template;

/** @var Template $this */
/** @var ?string $page */
if (empty($title)) {
    $title = 'Obsidian Pages';
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title ?></title>

        <?= $this->loadFiles('page') ?>
        <?= $this->loadFiles($page) ?>
    </head>
    <body data-bs-target="dark">
        <?=$this->section('content')?>
    </body>
</html>