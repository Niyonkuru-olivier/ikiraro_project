<?php
 /*Start session to store user info after registration
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $firstName = $_POST['firstName'];
    $secondName = $_POST['secondName'];
    $telephone = $_POST['telephone'];
    $continent = $_POST['continent'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $idCard = $_POST['idCard'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if any required fields are empty
    if (empty($firstName) || empty($secondName) || empty($telephone) || empty($continent) || empty($country) || 
        empty($city) || empty($idCard) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required!";
        exit();
    }

    // Validate the National ID/Passport (16 digits)
    if (!preg_match("/^[0-9]{16}$/", $idCard)) {
        echo "National ID/Passport must be 16 digits.";
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $servername = "localhost"; // Change this to your DB server
    $username = "root"; // Your DB username
    $dbpassword = ""; // Your DB password
    $dbname = "ikiraro_db"; // Your DB name

    // Create connection
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the user data into the database
    $stmt = $conn->prepare("INSERT INTO users (first_name, second_name, telephone, continent, country, city, id_card, email, password) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $firstName, $secondName, $telephone, $continent, $country, $city, $idCard, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Redirect to success page
        $_SESSION['user_email'] = $email; // Store user email in session for use on other pages
        header("Location: appreciate-promoter.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>*/

<?php
$conn = mysqli_connect("localhost","root","","ikiraro project");
if(!$conn){
    die ("connection error");
}else{

        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $telephone = $_POST["telephone"];
        $continent = $_POST["continent"];
        $country = $_POST["country"];
        $city = $_POST["city"];
        $idcard = $_POST["idcard"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        
        
        $sql = "INSERT INTO create-account (firstname,lastname,telephone,continent,country,city,idcard,email,password,confirmpassword)
         VALUES ('$First_Name','$Last_Name','$Phone_Number','$Select_Continent','$Country','$City','$ID_Number','$Email_Address','$Password','$Confirm_Password')";
         $run_sql = mysqli_query($conn,$sql);
         if($run_sql){
            header("location: service.html");
            die ("inserting data is done well");
         }else{
            die ("inserting data not done please!");
         }
}
?>

