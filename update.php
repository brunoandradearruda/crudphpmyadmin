<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nome = $telefone = $email = "";
$nome_err = $telefone_err = $email_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Insira um nome.";
    } elseif(!filter_var($input_nome, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nome_err = "Insira um nome válido.";
    } else{
        $nome = $input_nome;
    }
    
    // Validate content content
    $input_telefone = trim($_POST["telefone"]);
    if(empty($input_telefone)){
        $telefone_err = "Insira um telefone.";     
    } else{
        $telefone = $input_telefone;
    }
    // Validate tags
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter the tags amount.";     
    } else{
        $email = $input_email;
    }
    
    // Check input errors before inserting in database
    if(empty($nome_err) && empty($telefone_err) && empty($email_err)){
        // Prepare an update statement
        $sql = "UPDATE cadastro SET nome=?, telefone=?, email=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_nome, $param_telefone, $param_email, $param_id);
            
            // Set parameters
            $param_nome = $nome;
            $param_telefone = $telefone;
            $param_email = $email;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM cadastro WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nome = $row["nome"];
                    $telefone = $row["telefone"];
                    $email = $row["email"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cadastro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	    <link rel="icon" type="image/png" href="https://www.htmlhints.com/image/fav-icon.png">
    <meta name="msvalidate.01" content="B7807734CA7AACC0779B341BBB766A4E" />
    <meta name="p:domain_verify" content="78ad0b4e41a4f27490d91585cb10df4a"/>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145078782-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-145078782-1');
    </script>

        <style>
                    .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    .hh_button {
    display: inline-block;
    text-decoration: none;
    background: linear-gradient(to right,#ff8a00,#da1b60);
    border: none;
    color: white;
    padding: 10px 25px;
    font-size: 1rem;
    border-radius: 3px;
    cursor: pointer;
    font-family: 'Roboto', sans-serif;
    position: relative;
    margin-top: 30px;
    margin: 0px;
    position: absolute;
    right: 20px;
    top: 1.5%;
    }
    header {
    color: white;
    padding: 20px;
    margin-bottom: 20px;
    }
    header a,  header a:hover {
        text-decoration: none;
        color: white;
    }
    </style>
</head>
<body>
            <header>
         
      </header>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Atualizar Cadastro</h2>
                    </div>
                    <p>Insira os dados para atualização.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($telefone_err)) ? 'has-error' : ''; ?>">
                            <label>telefone</label>
                            <input name="telefone" class="form-control"><?php echo $telefone; ?></input>
                            <span class="help-block"><?php echo $telefone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="atualizar">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <ins class="adsbygoogle my-3"
style="display:block"
data-ad-format="fluid"
data-ad-layout-key="-fb+5w+4e-db+86"
data-ad-client="ca-pub-1506739985879215"
data-ad-slot="5016195832"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</body>
</html>