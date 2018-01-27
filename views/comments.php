<div class="container comment-sec">
    <h3>Comments</h3>

    <div id="comment">
        <script>getComments(<?php echo $recipe_number; ?>, "<?php echo $username; ?>")</script>
    </div>

    <?php

    if(!empty($username)) {
        ?>
        <form onsubmit="postComment(); return false" method="post">
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" name="comment" id="comment" maxlength="255"></textarea>
                <input type="hidden" name="recipe_number" value=<?php echo $recipe_number; ?>>
                <input type="hidden" name="username" value=<?php echo $username; ?>>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </form>
        <?php
    }

    else {
        ?>
        <span class="help-block">You must sign in to comment.</span>
        <?php
    }
    ?>
</div>
