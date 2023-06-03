<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nome = $telefone = $email = "";
$nome_err = $telefone_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Selecione um nome.";
    } else{
        $nome = $input_nome;
    }
    
    // Validate telefone
    $input_telefone = trim($_POST["telefone"]);
    if(empty($input_telefone)){
        $telefone_err = "Insira um telefone.";     
    } else{
        $telefone = $input_telefone;
    }
    
    // Validar email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Insira um email.";     
    } else{
        $email = $input_email;
    }
    
    // Check input errors before inserting in database
    if(empty($nome_err) && empty($telefone_err) && empty($email_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO cadastro (nome, telefone, email) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nome, $param_telefone, $param_email);
            
            // Set parameters
            $param_nome = $nome;
            $param_telefone = $telefone;
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" telefone="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	    <link rel="icon" type="image/png" href="https://www.htmlhints.com/image/fav-icon.png">
    <meta name="msvalidate.01" telefone="B7807734CA7AACC0779B341BBB766A4E" />
    <meta name="p:domain_verify" telefone="78ad0b4e41a4f27490d91585cb10df4a"/>
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
                        <h2 style="background-color: #ff8a00;">Cadastrar Cliente</h2>
                    </div>
                    <p>Insira os dados abaixo para cadastro.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>Nome:</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($telefone_err)) ? 'has-error' : ''; ?>">
                            <label>Telefone:</label>
                            <input name="telefone" class="form-control"><?php echo $telefone; ?></input>
                            <span class="help-block"><?php echo $telefone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email:</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
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