<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    <?php
                    //Displaying the user analytics or admin dashboard based on user role
        include "../actions/login_user.php";
        if ($_SESSION['is_seller'] == 0): ?>
            <li id="login-signup" class="nav-list"> <a href="../view/admin/dashboard.php"><button>Admin Dashboard</button></a> </li>
        <?php elseif ($_SESSION['is_seller'] == 1): ?>
            <li id="login-signup" class="nav-list"> <a href="../view/user_analytics.php"><button>User Analytics</button></a> </li>
            <li id="login-signup" class="nav-list"> <a href="../actions/logout.php"><button>Logout</button></a> </li>
        <?php endif; ?>
    
    
    </body>
</html>