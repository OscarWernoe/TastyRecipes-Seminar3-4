function getComments(recipe, username) {
    $.getJSON("GetComments", "recipe_number=" + recipe,
        function(comments) {
            if(typeof comments !== "undefined") {
                $.each(comments, function(key, comment) {
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
        function(result) {
            if(result) {
                $('[name="' + commentId + '"]').parent().remove();
            }
    })
}

function postComment(username) {

}