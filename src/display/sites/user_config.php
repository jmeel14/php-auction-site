<?PHP
    require('../../control/objects/session_user.php');
    session_start();
    
    require('../../control/functions/no_go/authent.php');
    
    $pTitle = 'User configuration';
    require('../require/head.php');
        require('../require/header.php');
        require('../require/nav.php');
        require('../require/bids_table.php');
    require('../require/footer.php');
?>

