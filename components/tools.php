<?php
    require_once('../constants.php');

    /*
    *   Builds an html head with a title, an array of stylesheets names and with 
    *   the possibility of including the bootstrap CDN.
    */
    function buildHtmlHead($title, $stylesheets = array(), $bootstrap = false)
    {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>'. $title .'</title>
    
            <link href="'.ROOT_DIR.'/css/main.css" rel="stylesheet">';
        
        // CSS
        foreach($stylesheets as $css)
            echo '<link href="'.ROOT_DIR.'/css/'. $css .'.css" rel="stylesheet">';
    
        // Bootstrap
        if($bootstrap)
        {
            echo '
            <link 
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
                rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
                crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">';
        }

        echo '</head>
        <body>';
    }
    
    /*
    *   Builds an html end of file with an array of JS scripts names and with 
    *   the possibility of including the JQuery lib and the bootstrap JS script.
    */
    function buildHtmlFooter($scripts = array(), $jquery = false, $bootstrap = false)
    {
        // JQuery
        if($jquery)
        {
            echo '
            <script 
                src="https://code.jquery.com/jquery-3.5.1.min.js" 
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                crossorigin="anonymous">
            </script>';
        }
        
        // Boostrap
        if($bootstrap)
        {
            echo '<script 
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" 
                crossorigin="anonymous">
            </script>';
        }

        echo '<script src="'.ROOT_DIR.'/js/main.js"></script>';

        // JS
        foreach($scripts as $s)
            echo '<script src="../../js/'. $s .'.js"></script>';

        echo '</body>
            </html>';
    }

    /*
    *   Echoes an error message with bootstrap styling.
    *   $repo : repository which contains the "error" or "success" data.
    */
    function showBootstrapMessage($repo, $type)
    {
        switch($type)
        {
            case BaseRepository::SpecialData::Error:
                if($repo->hasSpecialData(BaseRepository::SpecialData::Error))
                    echo '<div class="alert alert-danger mb-3" role="alert">'.$repo->geSpecialData(BaseRepository::SpecialData::Error).'</div>';
                break;
            case BaseRepository::SpecialData::Success:
                if($repo->hasSpecialData(BaseRepository::SpecialData::Success))
                    echo '<div class="alert alert-success mb-3" role="alert">'.$repo->getSpecialData(BaseRepository::SpecialData::Success).'</div>'; 
                break;
            default: 
                break;
        }
    }

?>