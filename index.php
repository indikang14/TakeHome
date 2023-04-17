<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            .wrapper{
                width: 600px;
                margin: 0 auto;
            }
            table tr td:last-child{
                width: 120px;
            }
        </style>
        <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Employee List</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                    <?php
                    // Include config file with db connection
                    require_once "HttpRequestBase.php";
                    //access list of employees through api using CurL
                    $curl = new HttpRequestBase();
                    $curl->setUpCurlUrl("http://localhost/TakeHome/employee/list");
                    $curl->setUpGetReq();
                    $employees = (array) $curl->executeCurl();
                    $employeesFinal = $employees['output'];
                    $curl->killCurl();


                    //var_dump($employeesFinal)
                    $i=0;
                    if($employeesFinal){
                        echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>First Name</th>";
                                    echo "<th>Last Name</th>";
                                    echo "<th>Salary</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = (array) $employeesFinal[$i]) {
                                echo "<tr>";
                                    echo "<td>" . $row['firstname'] . "</td>";
                                    echo "<td>" . $row['lastname'] . "</td>";
                                    echo "<td>" . $row['salary'] . "</td>";
                                    echo "<td>";
                                        // echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                        echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "</td>";
                                echo "</tr>";
                                $i++;
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                    } else{
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
            
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>