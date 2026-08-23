<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
     $fullname = trim($_POST["fullname"] ?? "");
     $password = $_POST["password"] ?? "";
     $confirm_password = $_POST["confirm_password"] ?? "";
     $username = trim($_POST["username"] ?? "");
     $age = filter_var($_POST["age"] ?? "", FILTER_VALIDATE_INT);
     $gender = trim($_POST["gender"] ?? "");
     $address = trim($_POST["address"] ?? "");

     if ($fullname === "" || $password === "" || $confirm_password === ""
         || $username === "" || strlen($username) > 25 || $age === false
         || $age < 1 || $gender === "" || $address === "") {
       die("All fields are required.");
   }

   if (!in_array($gender, ["Male", "Female", "Others"], true)) {
       die("Please select a valid gender.");
   }

   if ($password !== $confirm_password) {
       die("Passwords do not match.");
   }

    $check = $conn->prepare("SELECT id FROM reg WHERE username = ? LIMIT 1");
   if (!$check) {
       die("Unable to check username.");
   }
   $check->bind_param("s", $username);
   $check->execute();
   $result = $check->get_result();

   if ($result->num_rows > 0) {
    die("Username already exists.");
   }

   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO reg (fullname, username, password, age, gender, address) VALUES (?, ?, ?, ?, ?, ?)");
   if (!$stmt) {
       die("Unable to prepare registration.");
   }
    $stmt->bind_param("sssiss", $fullname, $username, $hashed_password, $age, $gender, $address);
    if ($stmt->execute()) {
       header("Location: landing.php");
   } else {
       echo "Error: " . $stmt->error;
   }
   $stmt->close();
   $check->close();
   $conn->close();
}
?>