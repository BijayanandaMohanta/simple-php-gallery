<?php
// Set the upload directory and allowed file types
$upload_dir = 'promotionimage/';
$allowed_types = array('jpg', 'jpeg', 'png', 'gif');

// Check if a file was uploaded
if ($_FILES['file']['name']) {
  // Get the file extension
  $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
  
  // Check if the file type is allowed
  if (in_array(strtolower($extension), $allowed_types)) {
    // Set the file name and path
    $file_name = 'my_picture.' . $extension;
    $file_path = $upload_dir . $file_name;
    
    // Check if the file already exists
    if (file_exists($file_path)) {
      // Delete the old file
      unlink($file_path);
    }
    
    // Upload the new file
    move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    echo 'File uploaded successfully!';
  } else {
    echo 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
  }
}
?>
