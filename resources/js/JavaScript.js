$(document).ready(function() {

  $("#login-btn").click(function(e) {
    e.preventDefault();

    console.log('click');

    $.ajax({
      type: "POST",
      cache: false,
      url: "http://localhost:8888/index.php/pages/sign_in",
      data: {
        'username' : $('[name="username"]').val(),
        'password' : $('[name="password"]').val(),
      },
      dataType: 'json',
      success: function() {
        window.location.replace("http://localhost:8888/index.php/home");
      }
    })
  })

  $("#logout-btn").click(function(e) {
    e.preventDefault();

    console.log('click');

    $.ajax({
      type: "POST",
      cache: false,
      url: "http://localhost:8888/index.php/pages/sign_out",
      success: function() {
        location.reload();
      }
    })
  })

  $("#submit-comment").click(function(e) {
    e.preventDefault();

    console.log('click');

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

    console.log('click');

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
    success: function(res) {
      comments = res.comments;
      for(i = 0; i < comments.length; i++) {
        if(res.logged_in && (res.username == comments[i].username)) {
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