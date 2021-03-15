<?php
require_once('../constants.php');

// Include repository
require_once(ROOT_DIR.'/model/exampleRepository.php');
$repo = new ExampleRepository();

require_once('../components/tools.php');

// Build page head
buildHtmlHead('My Site');
?>

<p>Example View</p>
<?= 'Root directory: '.ROOT_DIR ?>

<?php

// Example error handling
if($repo->hasSpecialData(BaseRepository::SpecialData::Error))
{
    echo('<p>Error: '.$repo->getSpecialData(BaseRepository::SpecialData::Error).'</p>');
}

// Error handling with bootstrap
//showBootstrapMessage($repo, BaseRepository::SpecialData::Error);

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

// Build page end
buildHtmlFooter();
?>