<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Center</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_center";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$form_submitted = false; // Flag to track form submission

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare and execute SQL query to insert data into database
    $stmt = $conn->prepare("INSERT INTO membership_inquiries (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        $form_submitted = true; // Set flag if form is submitted successfully
    } else {
        echo "<p id='formResult' style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>

<!-- Navbar -->
<header>
    <nav class="navbar">
        <div class="nav-brand">
            <h1>Fitness Center</h1>
        </div>
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#calculator">Calculator</a></li>
            <li><a href="#membership">Membership</a></li>
        </ul>
    </nav>
</header>

<!-- Sidebar for mobile view -->
<aside class="sidebar" id="sidebar">
    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#calculator">Calculator</a></li>
        <li><a href="#membership">Membership</a></li>
    </ul>
</aside>

<!-- Hero Section with Image and Intro -->
<section id="home" class="hero">
    <div class="hero-text">
        <h2>Welcome to Fitness Center</h2>
        <p>Achieve your fitness goals with us!</p>
    </div>
</section>

<div class="services" id="services">
    <h1>What I Offer</h1>
    <div class="card-container">
        <!-- Card 1 -->
        <div class="card">
            <img src="./team1.png" alt="Image 1">
            <div class="card-content">
                <h3>Body Building</h3>
                <p>Building strength, resilience, and discipline—bodybuilding is a journey of self-transformation.</p>
            </div>
        </div>
      
        <!-- Card 2 -->
        <div class="card">
            <img src="./team2.png" alt="Image 2">
            <div class="card-content">
                <h3>Muscle Gain</h3>
                <p>Fuel your growth, push your limits—muscle gain is the path to a stronger you.</p>
            </div>
        </div>
      
        <!-- Card 3 -->
        <div class="card">
            <img src="./team3.png" alt="Image 3">
            <div class="card-content">
                <h3>Weight Loss</h3>
                <p>Transform your body, boost your confidence—weight loss is the first step to a healthier you.</p>
            </div>
        </div>
    </div>
</div>

<!-- Calorie Burn Calculator Section -->
<section id="calculator" class="calculator">
    <h2>Calorie Burn Calculator</h2>
    <div>
        <input type="number" id="duration" placeholder="Duration (minutes)" required>
    </div>
    <div>
        <input type="number" id="intensity" placeholder="Intensity (1-10)" required>
    </div>
    <button onclick="calculateCalories()">Calculate</button>
    <p id="result" style="color: red;"></p>
</section>

<!-- Membership Inquiry Form Section -->
<section id="membership" class="membership-form">
    <h2>Membership Inquiry</h2>
    <p id="formResult" style="color: red;"></p>
    <form id="membershipForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <input type="hidden" name="form_submitted" value="<?php echo $form_submitted; ?>"> <!-- Hidden field -->
        <button type="submit">Submit</button>
    </form>
</section>

<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> Fitness Center. All rights reserved.</p>
</footer>
<script src="script.js"></script>
    
</body>
</html>
