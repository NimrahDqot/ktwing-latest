<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
       <h1>{{$error}}</h1>
    @endforeach
@endif
<div class="container">
  <h2>Vertical (basic) form</h2>
  <form action="{{route('maha-kumbh')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="pwd">Name:</label>
        <input type="text" class="form-control"   placeholder="Enter name" name="name">
      </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control"  placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
        <label for="email">Phone:</label>
        <input type="text" class="form-control"  placeholder="Enter phone" name="phone">
      </div>
    <div class="form-group">
      <label for="pwd">image:</label>
      <input type="file" class="form-control" placeholder="Enter password" name="image">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
