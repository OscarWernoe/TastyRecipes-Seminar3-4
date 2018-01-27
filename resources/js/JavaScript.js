function getComments(recipe, username) {
    $.getJSON("GetComments", "recipe_number=" + recipe,
        function (comments) {
            if(typeof comments !== "undefined") {
                $.each(comments, function (key, comment) {
                    if(comment.username === username) {
                        $("#comment").append('<div class="media">' +
                            '<div class="media-body">' +
                            '<h4 class="media-heading">' + comment.username + '</h4>' +
                            '<p>' + comment.comment + '</p>' +
                            '</div>' +
                            '<div class="media-right">' +
                            '<button class="btn btn-danger" name="' + comment.id + '" onclick="deleteComment(' + comment.id + ')">Delete</button>' +
                            '</div>' +
                            '</div>')
                    } else {
                        $("#comment").append('<div class="media">' +
                            '<div class="media-body">' +
                            '<h4 class="media-heading">' + comment.username + '</h4>' +
                            '<p>' + comment.comment + '</p>' +
                            '</div>' +
                            '</div>')
                    }
                })
            }
    });
}

function deleteComment(commentId) {
    $.getJSON("DeleteComment", "comment_id=" + commentId,
        function (result) {
            if(result) {
                $('[name="' + commentId + '"]').parent().remove();
            }
    })
}

function postComment() {
    var recipe = $('[name="recipe_number"]').val();
    var username = $('[name="username"]').val();
    var comment = $.trim($('[name="comment"]').val());
    if(comment !== "") {
        $.post("PostComment", {recipe_number: recipe, comment: comment},
            function (result) {
                //console.log(result);
                if(result) {
                    $("#comment").append('<div class="media">' +
                        '<div class="media-body">' +
                        '<h4 class="media-heading">' + username + '</h4>' +
                        '<p>' + comment + '</p>' +
                        '</div>' +
                        '</div>')
                }
            })
    }
}