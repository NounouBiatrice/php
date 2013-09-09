<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pizza ML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="css/pizza.css"/>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the top bar */
        }
    </style>
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">

<?php
$xmlMenu = simplexml_load_file('pizza_db.xml');
$left = true;
?>

<header class="jumbotron subhead">
    <div class="container">
        <img src="img/pizza_big.png">

        <h1 class="muted">Pizza ML</h1>
    </div>
</header>

<div class="container">
    <form action="process_order.php" method="post">

        <?php foreach ($xmlMenu->Category as $category) : ?>
            <?php if ($left) : ?>
                <div class="row">
            <?php endif ?>

            <div class="span5">

                <div class="category">
                    <?php print($category["name"]) ?>
                </div>

                <?php foreach ($category->Product as $product) : ?>
                    <div class="row product">
                        <div class="span2">
                            <?php print($product["name"]) ?>
                        </div>

                        <div class="span1">
                            <?php print('$' . $product->Price[0]) ?>
                        </div>
                        <div class="span1">
                            <?php
                            $price2 = $product->Price[1];
                            echo empty($price2) ? '-' : '$' . $product->Price[1];
                            ?>
                        </div>

                        <div class="span1">
                            <button class="btn btn-mini"><i class="icon-plus"></i></button>
                        </div>
                    </div>
                <?php endforeach ?>

                <?php $note = $category['note']; ?>

                <?php if (!empty($note)) : ?>
                    <p class="note">
                        <small> <?php print($note) ?> *</small>
                    </p>
                <?php endif ?>

            </div>

            <?php if (!$left) : ?>
                </div>
            <?php endif ?>

            <?php $left = !$left; ?>
        <?php endforeach ?>

        <button class="btn btn-success btn-large"><i class="icon-white icon-ok"></i> Submit Order</button>
    </form>
</div>

<div id="footer">
    <div class="container">
        <p class="modal-footer">Example Pizza App by <a href="http://nprogramming.wordpress.com">Jacek Spólnik</a>.</p>
    </div>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>