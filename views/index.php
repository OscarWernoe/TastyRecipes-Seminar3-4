<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tasty Recipes</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/normalize.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../resources/css/main.css">
    </head>
    <body>
        <?php
        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'header.php';
        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'nav.php';
        ?>
        <div class="container text-center">
            <h2>Recipes</h2>
        </div>
        <div class="container text-center recipes">
            <a href="Recipe?recipe=0">
                <div class="col-sm-12 col-md-6 recipe-box recipe1-image" title="Meatballs">
                    <div><span class="label label-primary recipe-label">Meatballs</span></div>
                </div>
            </a>
            <a href="Recipe?recipe=1">
                <div class="col-sm-12 col-md-6 recipe-box recipe2-image" title="Pancakes">
                    <div><span class="label label-primary recipe-label">Pancakes</span></div>
                </div>
            </a>
        </div>
        <?php
        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'footer.php';
        ?>
    </body>
</html>