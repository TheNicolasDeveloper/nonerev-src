<?php
$title = "Download";
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';

if (!isset($_SESSION["user"])) {
    header("Location: /");
    exit;
}
?>

<?php echo PageBuilder::buildHeader(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloads</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .download-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }
        .download-item:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Downloads</h1>
        <div id="downloads" class="row"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'downloads.json',
                dataType: 'json',
                success: function(data) {
                    const downloadsContainer = document.getElementById('downloads');
                    data.forEach(item => {
                        const downloadItem = document.createElement('div');
                        downloadItem.classList.add('col-md-6');
                        downloadItem.innerHTML = `
                            <div class="download-item">
                                <h3>${item.title}</h3>
                                <p>${item.description}</p>
                                <a class="btn btn-primary download-link" href="${item.fileUrl}" download>Download</a>
                            </div>
                        `;
                        downloadsContainer.appendChild(downloadItem);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching JSON:', error);
                }
            });
        });
    </script>
</body>


<?php echo PageBuilder::buildFooter(); ?>
