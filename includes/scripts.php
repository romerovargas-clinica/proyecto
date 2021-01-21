<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- fa-icons -->
<script src="https://kit.fontawesome.com/42adee8d9b.js" crossorigin="anonymous"></script>
<script>
  const selectElement = document.getElementById('selectlang');
  selectElement.addEventListener('change', (event) => {
    let url = window.location.href.toString();
    console.log(url);
    const regex = /\?lang\=[a-z]*/g;
    url = url.replace(regex, '');
    window.location.href = url + '?lang=' + selectElement.value;
  });
</script>