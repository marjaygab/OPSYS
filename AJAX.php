<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajax Tutorial</title>
    <script type="text/javascript" src="jquery-3.3.1\jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#btn1').click(function() {
          $('#div1').load('Load.php');
        });
      });
    </script>
  </head>
  <body>
    <div id="div1">
      <p id="parag1">Ajaxx is cool.</p>
    </div>
    <button id="btn1" type="button" name="button">Click me.</button>
  </body>
</html>
