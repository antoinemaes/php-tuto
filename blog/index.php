<?php
require('controller/front.php');
$action=isset($_GET['action'])? $_GET['action'] : 'showArticles';

switch($action) {

    case 'showArticles':
        showArticles();
        break;
    case 'showComments':
        showComments();
        break;
    case 'postComment':
        postComment();
        break;
    default:
        echo '<p>Error : invalid value for action parameter.</p>';

}
