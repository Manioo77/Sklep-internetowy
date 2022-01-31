<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora</title>
    <link rel="stylesheet" href="style/desktop123.css" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="navbar-header">
             <h3><a href="" class="admin_name"> Panel Administratora - <?php echo "Admin Name";?></a></h3> 
            </div><!--navbar-header --->

            <div class="navbar-right-header">

                <ul class="dropdown-navbar-right">
                    <li>
                        <a href=""><i class="fa fa-user"></i>&nbsp;<i class="fa fa-caret-down"></i></a>

                        <ul class="subnavbar-right">
                            <li><a href="">User Account</a></li>
                            <li><a href="">Logout</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div><!--header --->

        <div class="body_container">
            <div class="left_sidebar">
                This is left sidebar
            </div><!--left_sidebar --->
            <div class="content">
                This is content box
            </div><!--content --->
        </div><!--body_container --->

    </div><!--container --->
    
</body>
</html>

<script src="../js/jquery-3.4.1.js"></script>

<script>
            $(document).ready(function() {

                // Dolne wysuwane menu
                $(".dropdown-navbar-right").on('click',function() {
                    $(this).find(".subnavbar-right").slideToggle("fast");
                });

                //lewy wysuwany sidebar
                $(".left_sidebar_first_level li").on('click', this,function() {
                    $(this).find(".left_sidebar_second_level").slideToggle("fast");
                });
            });
        </script>