<?php
    session_start();

    $xmlMenu = simplexml_load_file('pizza_db.xml');
    $left = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Three Aces's Pizza®</title>
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

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="#">Three Aces's Pizza</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($xmlMenu->Category as $category) : ?>
                                    <li>
                                        <a href="#<?php print($category["name"]) ?>">
                                            <?php print($category["name"]) ?>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    </ul>
                    <p class="navbar-text pull-right">
                        Logged in as <a href="#" class="navbar-link">Username</a>
                    </p>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>

    <div class="container">
        <div class="hero-unit">
            <div class="center">
                <img class="" src="img/pizza_big.png">
                <h2 class="muted center">Three Aces's Pizza®</h2>
            </div>
        </div>

        <form action="process_order.php" method="post">

            <?php foreach ($xmlMenu->Category as $category) : ?>
                <a id="<?php print($category["name"]) ?>"></a>
                <?php if ($left) : ?>
                    <div class="row">
                <?php endif ?>

                <div class="span6">

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