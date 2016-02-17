  <script>
    function warning()
    {
        var msg="Confirm Delete?This action is irrevocable!";
        var ch=confirm(msg);
        if (ch==1)
        {
            location.replace("clear_db.php");
//          alert("msg done");      
        }
    }
    </script>

<?php
	include "navigation.php";
?>
<head>
   <title>Clear</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Clear
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Clear
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Dump Entire database content:</h3>
                            </div>
                             <div class="panel-body">
                                <div class="alert alert-danger">
                                    <strong>Warning!</strong> This action is irrevocable!.
                                </div>
                                <div class="form-group">
                                  <button type="button" class="btn btn-lg btn-danger" onclick = warning()>Dump memory</button>
                                </div>
                            
                             
                            </div>
                               
                                
                </div>
                           
           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
