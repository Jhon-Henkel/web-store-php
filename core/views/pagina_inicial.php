<h1><?= $titulo ?></h1>
<h2><?= $titulo ?></h2>
<h3><?= $titulo ?></h3>
<h4><?= $titulo ?></h4>
<h5><?= $titulo ?></h5>
<h6><?= $titulo ?></h6>

<h1><i class="fa-solid fa-trash"></i></h1>

<ul>
<?php foreach ($clientes as $cliente):?>
    <li><?= $cliente ?></li>
<?php endforeach;?>
</ul>