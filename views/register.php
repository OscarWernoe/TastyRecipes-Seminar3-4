<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tasty Recipes</title>
        <link rel="stylesheet" type="text/css" href="/resources/css/normalize.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/resources/css/main.css">
    </head>
    <body>
        <?php
        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'header.php';
        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'nav.php';
        ?>
        <div class="container text-center">
            <h2>Register</h2>
        </div>
        <div class="container">
            <p>Please fill this form to create an account.</p>
            <form action="Register" method="post">
                <div class="form-group <?php echo (!empty($usernameError)) ? 'has-error' : ''; ?>">
                    <label for="username">Username:<sup>*</sup></label>
                    <input type="text" name="username" class="form-control" title="Username">
                    <span class="help-block"><?php echo $usernameError; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($passwordError)) ? 'has-error' : ''; ?>">
                    <label for="password">Password:<sup>*</sup></label>
                    <input type="password" name="password" class="form-control" title="Password">
                    <span class="help-block"><?php echo $passwordError; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirmPasswordError)) ? 'has-error' : ''; ?>">
                    <label for="confirm_password">Confirm Password:<sup>*</sup></label>
                    <input type="password" name="confirmPassword" class="form-control" title="Confirm Password">
                    <span class="help-block"><?php echo $confirmPasswordError; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
            </form>
        </div>
        <?php
        include TastyRecipes\Util\Constants::getViewFragmentsDir() . 'footer.php';
        ?>
    </body>
</html>