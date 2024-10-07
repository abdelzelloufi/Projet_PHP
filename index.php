<?php 
    $firstname = $name = $phone= $email=$message="";
    $firstnameError = $nameError = $phoneError = $emailError = $messageError = "";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $firstname=verifyInput($_POST["firstname"]);
        $name=verifyInput($_POST["name"]);
        $phone=verifyInput($_POST["phone"]);
        $email=verifyInput($_POST["email"]);
        $message=verifyInput($_POST["message"]);
        if(empty($firstname))
        {
            $firstnameError="Je veux ton prénom !";
        }
        if(empty($name))
        {
            $nameError="Je veux ton nom également !";
        }
        if(empty($email))
        {
            $emailError="Ton mail, pour te contacter ;) ";
        }
        if(empty($phone))
        {
            $phoneError="Ton numéro, au cas où. ";
        }
        if(empty($message))
        {
            $messageError="Ton mail, pour te contacter ;) ";
        }
    }
    function verifyInput($var){
        $var=trim($var);
        $var=stripcslashes($var);
        $var=htmlspecialchars($var);
        return $var;
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Contactez-moi</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>
            <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" role="form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="firstname">Prénom <span class="blue">*</span></label>
                        <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname?>" >
                        <p class="comment"><?php echo $firstnameError ?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Nom <span class="blue">*</span></label>
                        <input id="name" type="text" name="name" class="form-control" placeholder="Votre prénom" value="<?php echo $name?>" >
                        <p class="comment"><?php echo $nameError ?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="email">E-mail <span class="blue">*</span></label>
                        <input id="email" type="text" name="email" class="form-control" placeholder="Votre e-mail" value="<?php echo $email?>" >
                        <p class="comment"><?php echo $emailError ?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="phone">Téléphone <span class="blue">*</span></label>
                        <input id="phone" type="tel" name="phone" class="form-control" placeholder="Votre numéro" value="<?php echo $phone?>">
                        <p class="comment"><?php echo $phoneError ?></p>
                    </div>
                    <div class="col-md-12">
                        <label for="message">Message <span class="blue">*</span></label>
                        <textarea id="message" name="message" class="form-control" placeholder="Votre message" value="<?php echo $message?>"></textarea>
                        <p class="comment"><?php echo $messageError ?></p>
                    </div>
                    <div class="col-md-12">
                        <p class="blue">* Ces informations sont requises.</p>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="button1" value="Envoyer">
                    </div>
                </div>
                <p class="thank you">Votre message a bien été envoyé. Merci de m'avoir contacté ;)</p>
            </form>
        </div>
    </body>
</html>
