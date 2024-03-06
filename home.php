<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link to css-->
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
<div class="home-container">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "project");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentSheetLink = mysqli_real_escape_string($conn, $_POST["std_url"]);
        $rubricSheetLink = mysqli_real_escape_string($conn, $_POST["rub_url"]);
        $date = mysqli_real_escape_string($conn, $_POST["date"]);
     
    $sql = "INSERT INTO assessments (student_sheet_link, rubric_sheet_link, assessment_date) 
            VALUES ('$studentSheetLink', '$rubricSheetLink', '$date')";

    if (mysqli_query($conn, $sql)) {
        echo "Assessment submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }

mysqli_close($conn);
    ?>
    <div class="assesment-btn">
        <button type="submit" id="newAssesment">New Assesment</button>
    </div>
    <div class="home-form-box">
    <p id="formTitle">Assessment Form</p>
        <form action="home.php" method="post" id="assessmentForm">
           
                <div class="std-sheet">
                    <input type="link" accept=".xls,.xlsx" name="std_url" id="student_url" placeholder="Student Sheet link">
                </div>
                <div class="rub-sheet">
                    <input type="link" accept=".xls,.xlsx" name="rub_url" id="rubric_url" placeholder="Rubric Sheet link">
                </div>
                <div class="dateinput">
                    <input type="date" name="date" id="date" placeholder="Select Date" required>
                </div>
                <div class="home-btn-field">
                    <button type="submit" id="submitBtn">Submit</button>
                </div>
       </form>
    </div>    
</div>
<script src="main.js"></script>
</body>
</html>