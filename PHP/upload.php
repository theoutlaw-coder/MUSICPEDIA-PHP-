<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Upload File</h1>
        <form action="upload_handler.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Choose a file:</label>
                <input type="file" class="form-control-file" name="file" id="file" accept=".txt, .pdf, .docx">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
    <!-- Bootstrap JS (optional, only if you need Bootstrap JS features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
