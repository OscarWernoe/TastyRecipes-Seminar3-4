$(document).ready(function() {

  $("#submit-comment").click(function(e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      cache: false,
      url: "http://localhost:8888/index.php/recipe/post_comment",
      data: {
        'comment' : $('[name="comment"]').val(),
        'recipe_number' : $('[name="recipe_number"]').val(),
      },
      dataType: 'json',
      success: function() {
        console.log('success');
        location.reload();
      }
    })
  })

  $(document).on("click", "#delete-comment", function(e) {
    e.preventDefault();

    var commentId = $(this).attr('value');

    $.ajax({
      type: "POST",
      cache: false,
      url: "http://localhost:8888/index.php/recipe/delete_comment",
      data: {
        'comment_id' : commentId
      },
      dataType: 'json',
      success: function() {
        console.log('success');
        location.reload();
      }
    })
  })
})

function getComments(recipe) {
  $.ajax({
    type: "POST",
    cache: false,
    url: "http://localhost:8888/index.php/recipe/get_comments/" + recipe,
    data: null,
    dataType: 'json',
    success: function(response) {
      comments = response.comments;
      for(i = 0; i < comments.length; i++) {
        if((response.username == comments[i].username) && response.logged_in) {
          $("#comment").append(
            '<div class="media">' +
            '<div class="media-body">' +
            '<h4 class="media-heading">' + comments[i].username + '</h4>' +
            '<p>' + comments[i].comment + '</p>' +
            '</div>' +
            '<div class="media-right">' +
            '<button id="delete-comment" class="btn btn-danger" type="submit" value="' + comments[i].comment_id + '">Delete</button>' +
            '</div>' +
            '</div>'
          );
        } else {
          $("#comment").append(
            '<div class="media">' +
            '<div class="media-body">' +
            '<h4 class="media-heading">' + comments[i].username + '</h4>' +
            '<p>' + comments[i].comment + '</p>' +
            '</div>' +
            '</div>'
          );
        }
      }
    }
  })
}