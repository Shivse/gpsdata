<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES['csvfile']['tmp_name'])) {
    $filePath = $_FILES['csvfile']['tmp_name'];
    $file = fopen($filePath, "r");

    $successCount = 0;
    $errorCount = 0;

    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        // Assuming the first row of your CSV contains the data to be posted
        $postData = implode(",", $data); // Convert array to comma-separated string

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '180.150.248.51/GSRTCService/Gpsdata.ashx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData, // Use data from CSV
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/plain'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);

        // Check response here. Assuming $response being true indicates success.
        if ($response) {
            $successCount++;
        } else {
            $errorCount++;
        }
    }
    fclose($file);
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL POST</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Custom CSS for form alignment */
        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="container-fluid form-container">
        <form method="POST" enctype="multipart/form-data">
            <h2 class="text-center mb-4">Results...</h2>
            <table class="table table-bordered" align="center">
                <tbody align="center">
                    <tr>
                        <td>Successful Count</td>
                        <td><?php echo "$successCount"; ?></td>
                    </tr>
                    <tr>
                        <td>Faield Count</td>
                        <td><?php echo "$errorCount"; ?></td>
                    </tr>
                    <tr>
                        <td>Go Back</td>
                        <td><button type="submit" class="btn btn-primary">Back To Post
                        </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">Thanks To Sagar</td>
                        
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-qZKPpATkyEhLGcwCU4k6eJi7fUsI0MPUy+pFsPrtWEj3mZUjXJ0+35rl/nvJh4ZB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

<?php

    // Output results
 //   echo "<table border='2' align='center'><tr><td>Successful   Posts</td><td>$successCount</td></tr>";
  //  echo "<tr><td>Failed Posts</td><td>$errorCount</td></tr>";
  //  echo "<tr><td>Go Back</td><td><button type='submit'class='btn btn-primary'><a href='TEST.php'>Back</a></button></td></tr></table>";
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL POST</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Custom CSS for form alignment */
        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="container-fluid form-container">
        <form method="POST" enctype="multipart/form-data">
            <h2 class="text-center mb-4">URL POST</h2>
            <table class="table table-bordered">
                <tbody align="center">
                    <tr>
                        <td>Select File</td>
                        <td><input type="file" name="csvfile" accept=".csv" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Throw Url</td>
                        <td><button type="submit" class="btn btn-primary">POST DATA</button></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">Thanks To Sagar</td>
                        
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-qZKPpATkyEhLGcwCU4k6eJi7fUsI0MPUy+pFsPrtWEj3mZUjXJ0+35rl/nvJh4ZB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
?>
