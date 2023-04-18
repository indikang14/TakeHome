<?php
// Include config file
require_once "HttpRequestBase.php";
 
// Define variables and initialize with empty values
$first_name = $last_name = $salary = "";
$first_name_err = $last_name_err = $salary_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate first name
    $input_first_name = trim($_POST["firstname"]);
    if(empty($input_first_name)){
        $first_name_err = "Please enter a first name.";
    } elseif(!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $first_name_err = "Please enter a valid task name. Only Letters.";
    } else{
        $first_name = $input_first_name;
    }
    // Validate last name 
    $input_last_name = trim($_POST["lastname"]);
    //var_dump($input_last_name);
    if(empty($input_last_name)){
        $last_name_err = "Please enter a last name.";
    } elseif(!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $last_name_err = "Please enter a valid last name. Only letters.";
    } else{
        $last_name = $input_last_name;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter an annual salary.";
     } elseif(!filter_var($input_salary, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
        $salary_err = "Please enter a valid salary. Only Numbers.";
     } else{
         $salary = $input_salary;
     }
    
    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($last_name_err) && empty($salary_err)){
        
            if(isset($_POST["id"])) {
                $id = trim($_POST["id"]);
                $url = "http://localhost/TakeHome/employee/update/".$id."/";
               
                $curl = new HttpRequestBase();
                $curl->setUpCurlUrl("http://localhost/TakeHome/employee/update/".$id."/");
                $updateEmployeeDetails = array("firstname" => $first_name,
                                                "lastname"=> $last_name,
                                                "salary" => $salary);
                $curl->setUpPostReq($updateEmployeeDetails);
                $result = $curl->executeCurl();
            
                header("location: index.php");
                exit();
                
                
            }
      
            // Records updated successfully. Redirect to landing page
            
            
            //echo "Oops! Something went wrong. Please try again later.";
        
        }
        
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
       

        $curl = new HttpRequestBase();
        //api call to grab the employee info of singular id
        $curl->setUpCurlUrl("http://localhost/TakeHome/employee/list/".$id."/");
        $curl->setUpGetReq();
        
        $employees = (array) $curl->executeCurl();
        $employeesFinal = $employees['output'];

        $singleEmployee = (array) $employeesFinal[0];
        if(sizeof($employeesFinal) == 1) {
            $first_name = $singleEmployee["firstname"];
            $last_name = $singleEmployee["lastname"];
            $salary = $singleEmployee["salary"];
        }
        $curl->killCurl();
        
            
    } else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Employee Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
                            <span class="invalid-feedback"><?php echo $first_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>"></input>
                            <span class="invalid-feedback"><?php echo $last_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>