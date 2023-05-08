<?php
// Connect to the database (replace the placeholders with your own values)
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'test';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Check if a file was uploaded
if ($_FILES['file']['name']) {
  // Get the file extension
  $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
  
  // Set the file name and path
  $file_name = uniqid() . '.' . $extension;
  $file_path = 'uploads/' . $file_name;
    
  // Upload the file
  move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
  
  // Get the description from the form
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  
  // Insert the record into the database
  $sql = "INSERT INTO images (image_name, description) VALUES ('$file_name', '$description')";
  
  if (mysqli_query($conn, $sql)) {
    echo 'Record added successfully!';
  } else {
    echo 'Error adding record: ' . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<?php header("location:upload_index.php")?>
