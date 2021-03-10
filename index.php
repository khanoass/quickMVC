<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting</title>
</head>
<body>
    <p>Redirecting, click <a href="view/exampleView.php">here</a> if this takes too long.</p>
    <?php header('Location: view/exampleView.php'); ?>
</body>
</html>