<?php
session_start();
$conn = new mysqli("localhost", "root", "", "e_voting");

// Check if form is submitted for candidate update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $party = $_POST['party'];
    $experience = $_POST['experience'];
    $manifesto = $_POST['manifesto'];

    // Handle image upload
    $image_path = "";
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    }

    // Update candidate details
    if ($image_path != "") {
        $query = "UPDATE candidates SET name='$name', party='$party', experience='$experience', manifesto='$manifesto', image_path='$image_path' WHERE id='$id'";
    } else {
        $query = "UPDATE candidates SET name='$name', party='$party', experience='$experience', manifesto='$manifesto' WHERE id='$id'";
    }

    if ($conn->query($query) === TRUE) {
        echo "Candidate details updated successfully!";
    } else {
        echo "Error updating candidate details: " . $conn->error;
    }
}

// Fetch Candidates
$query = "SELECT * FROM candidates";
$candidates = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Candidates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #e0e0e0;
            text-align: center;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #1f1f1f;
            border-bottom: 1px solid #333;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        header h1 {
            margin: 0;
            color: #e0e0e0;
        }
        header img {
            height: 50px;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px;
            margin-top: 70px;
        }
        nav a {
            color: #e0e0e0;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            transition: background-color 0.3s, transform 0.3s;
        }
        nav a:hover {
            background-color: #444;
            transform: scale(1.1);
        }
        .content {
            padding: 100px 20px 20px; /* Adjust padding to account for fixed header */
        }
        .candidate-form {
            background-color: #1f1f1f;
            border: 1px solid #333;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            width: 50%;
            text-align: left;
        }
        .candidate-form h2 {
            color: #e0e0e0;
        }
        .candidate-form label {
            display: block;
            margin: 10px 0 5px;
        }
        .candidate-form input, .candidate-form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #333;
            color: #e0e0e0;
        }
        .candidate-form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .candidate-form button:hover {
            background-color: #45a049;
        }
        .candidate-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>E VOTING SYSTEM</h1>
        <img src="C:\wamp64\www\e_voting\images\logo.jpg" alt="Logo">
    </header>
    <nav>
        <a href="index.php">HOME</a>
        <a href="candidates.php">CANDIDATES</a>
        <a href="results.php">RESULTS</a>
        <a href="register.php">REGISTER</a>
        <a href="admin.php">ADMIN</a>
    </nav>
    <div class="content">
        <h1>Update Candidates</h1>
        <?php while ($row = $candidates->fetch_assoc()): ?>
            <form class="candidate-form" method="POST" action="" enctype="multipart/form-data">
                <h2><?php echo $row['name']; ?></h2>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required>
                
                <label for="party">Party:</label>
                <input type="text" name="party" id="party" value="<?php echo $row['party']; ?>" required>
                
                <label for="experience">Experience (years):</label>
                <input type="number" name="experience" id="experience" value="<?php echo $row['experience']; ?>" required>
                
                <label for="manifesto">Manifesto:</label>
                <textarea name="manifesto" id="manifesto" required><?php echo $row['manifesto']; ?></textarea>
                
                <label for="image">Update Image:</label>
                <input type="file" name="image" id="image" accept="image/*">
                
                <?php if ($row['image_path']): ?>
                    <img src="<?php echo $row['image_path']; ?>" alt="Candidate Image" class="candidate-image">
                <?php endif; ?>
                
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit">Update</button>
            </form>
        <?php endwhile; ?>
    </div>
</body>
</html>
