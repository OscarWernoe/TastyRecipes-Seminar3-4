<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tasty Recipes</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/normalize.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../resources/css/main.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/resources/js/JavaScript.js"></script>
    </head>
    <body>
        <?php
        if($recipes === false) {
            echo 'ERROR: Could not load the recipes!';
            exit;
        }

        if(!isset($recipe_number) || !is_numeric($recipe_number)) {
            echo 'ERROR: Could not find the specified recipe!';
            exit;
        }

        $recipe_number = (int) $recipe_number;
        if(empty($recipes->recipe[$recipe_number]) || $recipe_number < 0) {
            echo 'ERROR: Could not find the specified recipe!';
            exit;
        }

        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'header.php';
        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'nav.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?php
                    echo '<img class="img-responsive img-rounded" src="' . $recipes->recipe[$recipe_number]->imagepath . '" alt="Picture of ' . $recipes->recipe[$recipe_number]->title . '">'
                    ?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h2><?php echo $recipes->recipe[$recipe_number]->title?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Ingredients</h3>
                    <ul class="recipe-list-unordered">
                        <?php
                        foreach($recipes->recipe[$recipe_number]->ingredient->li as $item) {
                            echo '<li>' . $item . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Directions</h3>
                    <ol class="recipe-list-ordered">
                        <?php
                        foreach($recipes->recipe[$recipe_number]->recipetext->li as $item) {
                            echo '<li>' . $item . '</li>';
                        }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
        <?php
        include 'comments.php';
        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'footer.php';
        ?>
    </body>
</html>