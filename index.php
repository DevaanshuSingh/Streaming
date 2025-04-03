<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  
  <div class="container-fluid">

    <form id="login-form">
      <div class="heading mb-4">
        <h3><b>LOGIN</b></h3>
      </div>

      <div class="col-8 mb-2">
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Email">
      </div>

      <div class="col-8 mb-2">
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
      </div>

      <div class="col-8 form-check mb-2 p-0">
        <button type="button" class="btn" id="submit-button">SUBMIT</button>
      </div>
      <div id="message" class="text-center mt-5"> <strong>
          <i> </i>
        </strong> </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
  <script>
  </script>
</html>