<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="upload_img.php" enctype="multipart/form-data">
  <label for="image">Image:</label>
  <input type="file" name="file" id="image">
  
  <label for="description">Description:</label>
  <input type="text" name="description" id="description">
  
  <button type="submit" name="submit">Upload</button>
</form>

</body>
</html>