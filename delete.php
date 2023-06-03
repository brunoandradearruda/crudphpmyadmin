<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM cadastro WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
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
    <title>Delete Record</title>
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
                        <h1 style="background-color: #da1b60;">Apagar resgistro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Confirma a EXCLUSÃO?</p><br>
                            <p>
                                <input type="submit" value="SIM" class="btn btn-danger"Não>
                                <a href="index.php" class="btn btn-default">Não</a>
                            </p>
                        </div>
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