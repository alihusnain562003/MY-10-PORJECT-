<?php
$localhost = "localhost";
$username = "root";
$password = "";
$db = "Lecfile";

$con = mysqli_connect($localhost, $username, $password, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize file names
function sanitize_filename($filename) {
    return preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $filename);
}

// Handle file upload
if (isset($_FILES["files"])) {
    $name = $_FILES["files"]["name"];
    $tmpName = $_FILES["files"]["tmp_name"];
    $type = $_FILES["files"]["type"];
    $size = $_FILES["files"]["size"];
    
    // Allowed file types
    $allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
    
    // Validate file type
    if (!in_array($type, $allowedTypes)) {
        echo "Error: Only PDF, DOCX, and image files (JPEG, PNG) are allowed!";
        exit();
    }

    // Sanitize file name
    $safeName = sanitize_filename($name);
    $path = "uploaded-file/" . $safeName;

    // Ensure the 'uploaded-file' directory exists
    $uploadDir = __DIR__ . "/uploaded-file/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
    }

    // Move the uploaded file
    $upload = move_uploaded_file($tmpName, $uploadDir . $safeName);

    if ($upload) {
        // Insert record into the database
        $sqlinsert = "INSERT INTO `info`(`Name`, `path`) VALUES ('$safeName','$path')";
        $res = mysqli_query($con, $sqlinsert);
        if ($res) {
            echo "Resume uploaded successfully!";
        } else {
            echo "Database error: " . mysqli_error($con);
        }
    } else {
        echo "File upload failed!";
    }
}

// Handle file deletion
if (isset($_POST['delete'])) {
    $fileId = $_POST['file_id'];
    
    // Fetch file details from database
    $sql = "SELECT * FROM `info` WHERE `id` = $fileId";
    $result = mysqli_query($con, $sql);
    $fileData = mysqli_fetch_assoc($result);
    
    if ($fileData) {
        $filePath = __DIR__ . "/" . $fileData['path'];

        // Delete file from server
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete record from database
        $sqlDelete = "DELETE FROM `info` WHERE `id` = $fileId";
        mysqli_query($con, $sqlDelete);

        echo "File deleted successfully!";
    }
}

// Fetch all uploaded resumes for displaying and counting
$sql = "SELECT * FROM `info`";
$result = mysqli_query($con, $sql);

// Initialize counters for different file types
$pdfCount = 0;
$docxCount = 0;
$imageCount = 0;

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $fileType = pathinfo($row['Name'], PATHINFO_EXTENSION);

        // Increment counters based on file types
        if ($fileType === 'pdf') {
            $pdfCount++;
        } elseif ($fileType === 'docx') {
            $docxCount++;
        } elseif (in_array($fileType, ['jpeg', 'jpg', 'png'])) {
            $imageCount++;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Upload</title>
    <style>
        /* Basic styling for body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        /* Form styling */
        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 16px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Counter styling */
        .counter {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .counter h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
        }

        .counter span {
            display: block;
            font-size: 16px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td a, td form input[type="submit"] {
            color: #4CAF50;
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
        }

        td a:hover, td form input[type="submit"]:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            form {
                width: 90%;
                margin: 0 auto;
            }

            table {
                font-size: 14px;
            }

            .counter {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <!-- Display the file upload count -->
    <div class="counter">
        <h3>Uploaded Files Count</h3>
        <span>PDFs: <?php echo $pdfCount; ?></span>
        <span>DOCX: <?php echo $docxCount; ?></span>
        <span>Images (JPEG, PNG): <?php echo $imageCount; ?></span>
    </div>

    <h1>Upload Your Resume</h1>
    <form action="resumeupload.php" method="post" enctype="multipart/form-data">
        <label for="uf">Select Resume (PDF, DOCX, JPEG, PNG):</label>
        <input type="file" name="files" id="uf" required>
        <input type="submit" value="Submit">
    </form>

    <h2>Uploaded Resumes</h2>
    <table>
        <tr>
            <th>Resume Name</th>
            <th>Download</th>
            <th>Delete</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            // Re-fetch results for displaying
            mysqli_data_seek($result, 0);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['Name']) . "</td>
                        <td><a href='" . htmlspecialchars($row['path']) . "' download>Download</a></td>
                        <td>
                            <form action='resumeupload.php' method='post'>
                                <input type='hidden' name='file_id' value='" . $row['id'] . "'>
                                <input type='submit' name='delete' value='Delete'>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No resumes uploaded yet.</td></tr>";
        }
        ?>
    </table>

</body>
</html>
