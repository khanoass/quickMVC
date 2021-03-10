<?php
session_start();
require_once('../constants.php');

// Include repository
require_once(ROOT_DIR.'/model/exampleRepository.php');
$repo = new ExampleRepository();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example</title>
</head>
<body>
    <p>Example View</p>
    <?= 'Root directory: '.ROOT_DIR ?>
    
    <?php
        // Using the model ($repo)

        // Example error handling
        if($repo->hasData('error'))
        {
            echo('<p>Error: '.$repo->getData('error').'</p>');
        }

        // Get random data
        if($repo->hasData('stuff'))
        {
            $data = $repo->getData('stuff');
            foreach($data as $d)
            {
                echo('<p>'.$d.'</p>');
            }
        }
        else
        {
            echo('<p>No data to be displayed.</p>');
        }
    ?>
</body>
</html>