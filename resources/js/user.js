$(document).ready(function() {

  $("#sign-in").click(function(e) {
    e.preventDefault();

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

  $("#sign-out").click(function(e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      cache: false,
      url: "http://localhost:8888/index.php/pages/sign_out",
      success: function() {
        location.reload();
      }
    })
  }) 
});