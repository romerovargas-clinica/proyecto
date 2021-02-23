<script>
  function newUser() {
    var valid = true;
    valid = validateUser();
    if (valid) {
      $.post("admin/newUser.php", {
        firstname: $("#firstname").val(),
        lastname: $("#lastname").val(),
        email: $("#email").val(),
        phone: $("#phone").val(),
        address: $("#address").val(),
        postalCode: $("#postalCode").val(),
        city: $("#city").val(),
        province: $("#province").val(),
        lang: '<?= $lang ?>'
      }, function(m) {
        if (m["code"] == 200) {
          $('#messageBox').html(m["msg"]);
          $('#messageBox').attr("class", "alert alert-success");
          $('#messageBox').attr("style", "visibility = visible");
          $('#firstname').empty();
          $('#lastname').empty();
          $('#email').empty();
          $('#phone').empty();
          $('#address').empty();
          $('#postalCode').empty();
          $('#city').empty();
          $('#province').empty();
          $("#firstname").css('background-color', '#FFFFFF');
          $("#lastname").css('background-color', '#FFFFFF');
          $("#email").css('background-color', '#FFFFFF');
          $("#phone").css('background-color', '#FFFFFF');
          $("#address").css('background-color', '#FFFFFF');
          $("#postalCode").css('background-color', '#FFFFFF');
          $("#city").css('background-color', '#FFFFFF');
          $("#province").css('background-color', '#FFFFFF');
        } else {
          $('#messageBox').html(m["msg"]);
          $('#messageBox').attr("class", "alert alert-warning");
          $('#messageBox').attr("style", "visibility = visible");
        }
      })
    }
  }

  function validateUser() {
    var valid = true;
    if (!$("#email").val()) {
      $("#email").css('background-color', '#FFFFDF');
      valid = false;
    }
    if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
      $("#email").css('background-color', '#FFFFDF');
      valid = false;
    }
    if (!$("#phone").val()) {
      $("#phone").css('background-color', '#FFFFDF');
      valid = false;
    }
    if (!$("#lastname").val()) {
      $("#lastname").css('background-color', '#FFFFDF');
      valid = false;
    }
    if (!$("#firstname").val()) {
      $("#firstname").css('background-color', '#FFFFDF');
      valid = false;
    }
    return valid;
  }
</script>