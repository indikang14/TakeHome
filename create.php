<?php
// Include config file
require_once "MySql/config.php";
 
// Define employee variables and initialize
$first_name = $last_name = $salary = "";
$first_name_err = $last_name_err = $salary_err = "";

//var_dump($_SERVER);
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate task name
    $input_first_name = trim($_POST["firstname"]);
    if(empty($input_first_name)){
        $first_name_err = "Please enter a first name.";
    } elseif(!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $first_name_err = "Please enter a valid task name. Only Letters.";
    } else{
        $first_name = $input_first_name;
    }

    // Validate task description (punctuation is allowed)
    $input_last_name = trim($_POST["lastname"]);
    if(empty($input_last_name)){
        $last_name_err = "Please enter a last name.";
    }
    if(!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $last_name_err = "Please enter a valid last name. Only letters.";
    } else{
        $last_name = $input_last_name;
    }

     // Validate task assignment name
     $input_salary = trim($_POST["salary"]);
     if(empty($input_salary)){
        $salary_err = "Please enter an annual salary.";
     } elseif(!filter_var($input_salary, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
        $salary_err = "Please enter a valid salary. Only Numbers.";
     } else{
         $salary = $input_salary;
     }
    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($last_name_err) && empty($salary_err) ){
        // Prepare an insert statement into Employees table
        $sql = "INSERT INTO Employees (firstname, lastname, salary ) VALUES (?, ?, ?)";
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_first_name, $param_last_name, $param_salary);
            
            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Employee Record</title>
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
                    <h2 class="mt-5">Add Employee Record</h2>
                    <p>Please fill this form to add employee.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
                            <span class="invalid-feedback"><?php echo $first_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input name="lastname" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>"><?php echo $last_name; ?></input>
                            <span class="invalid-feedback"><?php echo $last_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salary(Annual)</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>