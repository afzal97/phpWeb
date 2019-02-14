<?php

require_once 'Model/CampsiteDataSet.php';

require_once 'Model/UserDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Campsite Page";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;

if (isset($_GET['hshid'])) {
    $campsiteID = $_SESSION['campsiteID']; 
    $hashID = $_GET['hshid'];
    if( password_verify($campsiteID, $hashID))
    {
        $campsite = $campsiteData->getCampsite($campsiteID);    
    }

    else {
        header('Location:errorPage.php');
    }
   
    
}

if (isset($_POST['submit'])) {
    $campsiteID = $_POST['campsiteID']; 
    $ratingValue = $_POST['rating-input-5'];
    if ($ratingValue == 'rating-input-1-1-5') {
        $ratingValue = 1;   
    }
    elseif ($ratingValue == 'rating-input-1-2-5') {
        # code...
        $ratingValue = 2;
    }
    elseif ($ratingValue == 'rating-input-1-3-5') {
        # code...
        $ratingValue = 3;
    }
    elseif ($ratingValue == 'rating-input-1-4-5') {
        # code...
        $ratingValue = 4;
    }
    elseif ($ratingValue == 'rating-input-1-5-5') {
        # code...
        $ratingValue = 5;
    }
    $campsiteData->insertRating($campsiteID, $ratingValue); 
}



require_once 'View/campsitePage.phtml';
