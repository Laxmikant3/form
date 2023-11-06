<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nname = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $gender = $_POST["gender"];
    $city = $_POST["city"];
    
    
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=registration_form", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO user_information (nname, email, gender, city) VALUES (:nname, :email, :gender, :city)");
        $stmt->bindParam(':nname', $nname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':city', $city);
        $stmt->execute();

        header("Location: Display.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
