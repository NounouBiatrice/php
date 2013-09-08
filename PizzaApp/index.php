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
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
    <![endif]-->
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">
<header class="jumbotron subhead">
    <div class="container">
        <img src="img/pizza_big.png">
        <h1 class="muted">Pizza ML</h1>
    </div>
</header>

<div class="container">
    <div class="jumbotron">

    </div>

    <form action="process_order.php" method="post">
        <?php
        $xmlMenu = simplexml_load_file('pizza_db.xml');
        $left = true;

        foreach ($xmlMenu->Category as $category) {
            if ($left) {
                echo '<div class="row">';
            }

            echo '<div class="span5">';

            echo '<div class="category">' . $category["name"] . '</div>';

            foreach ($category->Product as $product) {
                echo '<div class="row product">';
                echo '<div class="span2">';
                echo $product["name"];
                echo '</div>';

                echo '<div class="span1">';
                echo '$'.$product->Price[0];
                echo '</div>';
                echo '<div class="span1">';
                $price2 = $product->Price[1];
                echo empty($price2) ? '-' : '$'.$product->Price[1];
                echo '</div>';

                echo '<div class="span1">';
                echo '<button class="btn btn-mini"><i class="icon-plus"></i></button>';
                echo '</div>';
                echo '</div>';
            }

            $note = $category['note'];
            if (!empty($note)) {
                echo '<p class="note"><small>'.$note.'*</small></p>';
            }

            echo '</div>';

            if (!$left) {
                echo '</div>';
            }

            $left = !$left;
        }
        ?>

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