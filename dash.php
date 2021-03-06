<?php
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
date_default_timezone_set('America/Los_Angeles');
$date = date('m/d/Y h:i:s a', time());
$name = $_SESSION['name'];
if($name === null){
    http_response_code(403);
    header('Location: http://104.131.199.129:83/error/forbidden403.html');
    exit();
}
$access = $_SESSION['access'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dash.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/dash.js"></script>


    <title>Error Master</title>


</head>


<body>

<noscript><h4>Please Activate Javascript to Run Content</h4></noscript>

<!-- Navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dash.php">Error Master</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                        <span id ="userid"><?php echo $name ?></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="./php/logout.php">Logout</a></li>
                        <li id='changePass'><a href='#pass'>Change Password</a></li>
                        <?php
                        if($access === "owner"){
                            print "<li id='changeCode'><a href='#code'>Change Code</a></li> ";
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">

            <ul class="nav nav-sidebar">
                <li class="active"><a href="#"  id="summary">Summary</a></li>
                <li><a href="#" id="allerrors">All Errors</a></li>
                <?php
                if($access === "owner"){
                    print "<li><a href='#' id='settings'>Settings</a></li> ";
                    print "<li><a href='#' id='users'>Users</a></li> ";
                    print "<li><a href='#' id='accesslog'>Access Log</a></li>";
                }
                ?>
            </ul>
            <p>Logged In :
                <?php echo $date ?>
            </p>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="dashcontent">


        </div>

    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="addUserDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="First Name" name="first" required>
                    <input type="text" class="form-control" placeholder="Last Name" name="last" required>
                    <input type="email" class="form-control" placeholder="Email" name="email" maxlength="31" required>
                    <input type="password" class="form-control" placeholder="Password" name="password" maxlength="31" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" type="submit" id="adduser">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="editUserDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="First Name" name="first" required>
                    <input type="text" class="form-control" placeholder="Last Name" name="last" required>
                    <input id="email"type="email" class="form-control" placeholder="Email" name="email" maxlength="31" required disabled>
                    <input type="password" class="form-control" placeholder="Password" name="password" maxlength="31" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" type="submit" id="edituser">Edit</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" id="errorDetailDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="errorName"></h4>
            </div>
            <div class="modal-body">
                <h5><b>Time:&nbsp;</b><span id="timestamp"></span></h5>
                <h4 class='sub-header'>Logs</h4>
                <code id="errLog"></code>
                <h4 class='sub-header'>Comments</h4>
                <div class="input-group">
                    <form>
                        <textarea class="form-control" placeholder="Comments" id='comment' rows="10" cols="100"></textarea>
                        <div class="rating pull-right">
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                        </div>
                        <button type="button" class="btn btn-success" id="sendComment">Comment</button>
                    </form>
                </div>
                <hr>
                <div id="comments">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-sm" id="changePassDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="password" class="form-control" placeholder="New Password" name="pass" maxlength="31" required>
                    <button type="submit" class="btn btn-primary pull-right" id="changePassSubmit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade bs-example-modal-sm" id="changeCodeDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Change Code</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="password" class="form-control" placeholder="New Code" name="code" maxlength="31" required>
                    <button type="submit" class="btn btn-primary pull-right" id="changeCodeSubmit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>
