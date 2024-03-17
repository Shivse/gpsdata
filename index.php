<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV and Send Data</title>
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
        <h2 class="text-center mb-4">Upload CSV File</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" id="csvfile" class="form-control" accept=".csv">
            </div>
            <button type="button" id="postDataBtn" class="btn btn-primary">Post Data</button>
        </form>
        <div id="resultSection" class="mt-4" style="display: none;">
            <p id="successCount">Data sent successfully for 0 entries.</p>
            <p id="failCount">Failed to send data for 0 entries. Check your server logs or the CSV file for errors.</p>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-qZKPpATkyEhLGcwCU4k6eJi7fUsI0MPUy+pFsPrtWEj3mZUjXJ0+35rl/nvJh4ZB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        document.getElementById('postDataBtn').addEventListener('click', function() {
            var fileInput = document.getElementById('csvfile');
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append('csvfile', file);

            fetch('180.150.248.51/GSRTCService/Gpsdata.ashx', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var successCount = 0;
                var failCount = 0;

                if (data.success) {
                    successCount++;
                } else {
                    failCount++;
                }

                document.getElementById('successCount').textContent = "Data sent successfully for " + successCount + " entries.";
                document.getElementById('failCount').textContent = "Failed to send data for " + failCount + " entries. Check your server logs or the CSV file for errors.";
                document.getElementById('resultSection').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
