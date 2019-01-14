<div class="container">
	<div class="row">
    <div class="col-md-6 col-sm-12">
      <?php echo '<img class="img-responsive img-rounded" src="' . base_url() . $recipes->recipe[$recipe_number]->imagepath . '" alt="Picture of ' . $recipes->recipe[$recipe_number]->title . '">' ?>
    </div>
    <div class="col-md-6 col-sm-12">
      <h2><?php echo $recipes->recipe[$recipe_number]->title?></h2>
    </div>
	</div>
	<div class="row">
    <div class="col-sm-12">
      <h3>Ingredients</h3>
      <ul class="recipe-list-unordered">
        <?php foreach($recipes->recipe[$recipe_number]->ingredient->li as $item) { echo '<li>' . $item . '</li>'; } ?>
      </ul>
    </div>
	</div>
	<div class="row">
    <div class="col-sm-12">
      <h3>Directions</h3>
      <ol class="recipe-list-ordered">
        <?php foreach($recipes->recipe[$recipe_number]->recipetext->li as $item) { echo '<li>' . $item . '</li>'; } ?>
      </ol>
    </div>
	</div>
</div>
<div class="container comment-sec">
	<h3>Comments</h3>
  
  <div id="comment">
    <script>getComments(<?php echo $recipe_number; ?>)</script>
  </div>
  
  <?php if(!empty($username)) { ?>
    <form>
      <div class="form-group" <?php echo (!empty($this->session->flashdata('comment_error'))) ? 'has-error' : ''; ?>>
        <label for="comment">Comment:</label>
        <textarea class="form-control" name="comment" id="comment" maxlength="255"></textarea>
        <input type="hidden" name="recipe_number" value=<?php echo $recipe_number; ?>>
        <span class="help-block"><?php echo $this->session->flashdata('comment_error'); ?></span>
      </div>
      <input type="submit" id="submit-comment" class="btn btn-primary" value="Submit">
      <input type="reset" class="btn btn-default" value="Reset">
    </form>
  
  <?php } else { ?>
    <span class="help-block">You must sign in to comment.</span>
  <?php } ?>
</div>
