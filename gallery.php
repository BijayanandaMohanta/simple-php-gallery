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

// Check if the delete button was clicked
if (isset($_POST['delete'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  
  // Retrieve the image name from the database
  $sql = "SELECT image_name FROM images WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $image_name = $row['image_name'];
    
    // Delete the record from the database
    $sql = "DELETE FROM images WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
      // Delete the image from the folder
      $file_path = 'uploads/' . $image_name;
      
      if (file_exists($file_path)) {
        unlink($file_path);
      }
      
      echo 'Record deleted successfully!';
    } else {
      echo 'Error deleting record: ' . mysqli_error($conn);
    }
  }
}

// Retrieve all the image records from the database
$sql = 'SELECT * FROM images';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Loop through each record and display the image and delete button
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $image_name = $row['image_name'];
    $description = $row['description'];
    
    echo '<span>';
    echo '<img src="uploads/' . $image_name . '" alt="' . $description . '">';
    echo '<p>' . $description . '</p>';
    echo '<form method="POST">';
    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo '<button type="submit" name="delete">Delete</button>';
    echo '</form>';
    echo '</span>';
  }
} else {
  echo 'No images found.';
}

mysqli_close($conn);
?>
