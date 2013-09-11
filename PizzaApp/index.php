<?php
session_start();

$xmlMenu = simplexml_load_file('pizza_db.xml');
$categoryCounter = 0;

$priceTypes = ['small', 'medium', 'large'];

function findPrice($product, $priceType)
{
    return array_shift($product->xpath("Price[@type='$priceType']"));
}

function displayPrice($product, $priceType)
{
    $price = findPrice($product, $priceType);
    print(isset($price) ? '$' . number_format((double)$price, 2) : '-');
}

/*
 * 1. Shopping cart
 * 2. Logging mechanism ?
 * 3. Saving order to xml
 */
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
                                <?php $categoryName = $category["name"] ?>
                                <li>
                                    <a href="#<?php print($categoryName) ?>">
                                        <?php print($categoryName) ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                </ul>
                <p class="navbar-text pull-right">
                    Logged in as <a href="#" class="navbar-link">Username</a>
                </p>
            </div>
            <!--/.nav-collapse -->
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

    <div class="row">

        <div class="span7">

            <form action="process_order.php" method="post">

                <div class="accordion" id="accordion2">

                    <?php foreach ($xmlMenu->Category as $category) : ?>
                        <a id="<?php print($category["name"]) ?>"></a>

                        <div class="accordion-group">

                            <div class="category accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                   href="#collapse<?php print($categoryCounter) ?>">
                                    <?php print($category["name"]) ?>
                                </a>
                            </div>

                            <div id="collapse<?php print($categoryCounter) ?>"
                                 class="accordion-body collapse <?php if ($categoryCounter == 0) print("in") ?>">

                                <div class="row product accordion-inner header">
                                    <div class="span2">Name</div>
                                    <div class="span1">Small</div>
                                    <div class="span1">Medium</div>
                                    <div class="span1">Large</div>
                                    <div class="span1">Add</div>
                                </div>

                                <?php foreach ($category->Product as $product) : ?>

                                    <div class="row product accordion-inner">
                                        <div class="span2">
                                            <?php print($product["name"]) ?>
                                        </div>

                                        <?php foreach ($priceTypes as $priceType) : ?>
                                            <div class="span1">
                                                <?php displayPrice($product, $priceType); ?>
                                            </div>
                                        <?php endforeach ?>

                                        <div class="span1">
                                            <button class="btn btn-mini"><i class="icon-plus"></i></button>
                                        </div>

                                    </div>
                                <?php endforeach ?>

                                <?php $note = $category['note']; ?>

                                <?php if (isset($note)) : ?>
                                    <p class="note accordion-inner">
                                        <small> <?php print($note) ?> *</small>
                                    </p>
                                <?php endif ?>

                            </div>

                        </div>
                        <?php $categoryCounter++ ?>
                    <?php endforeach ?>

                </div>

            </form>

        </div>

        <div class="span5">
            <div class="category">Shopping Cart</div>
            <button class="btn btn-success btn-large"><i class="icon-white icon-ok"></i> Submit Order</button>
        </div>

    </div>
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