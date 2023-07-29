<?php
declare(strict_types=1);

use League\Plates\Template\Template;

/** @var Template $this */
$this->layout('layout::main', ['page' => 'index']);
?>

<p>Hello</p>