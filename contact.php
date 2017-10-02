<?php include 'config/config.php' ?>
<html lang="en">
<title>Contact</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>
<?php
if (isset($_POST['action']) && $_POST['action'] == 'envoyer') {
    $send_error = "";
    $required_fields = array('to', 'subject', 'message');
    foreach ($required_fields AS $v) {
        if (empty($_POST[$v])) {
            $send_error = "Un ou plusieurs champs sont vides, veuillez vérifier le formulaire.";
        }
    }
    if (empty($send_error)) {
        extract($_POST);
        $headers = "From: Sendmail Tests" . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
        if (!mail($to, $subject, $message, $headers)) {
            $send_error = "Erreur lors de l'envoi de l'email :(";
        }
    }
}
?>


<div class="container">
    <div class="page-header">
        <h1>Test d'envoi d'email au format HTML</h1>
    </div>
    <form method="post" action="">
        <?php
        if (isset($_POST['action']) && $_POST['action'] == 'envoyer' && empty($send_error)) {
            echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a>Email envoyé avec succès !</div>';
        } else if (isset($send_error)) {
            echo '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a>' . $send_error . '</div>';
        }
        ?>
        <div class="control-group">
            <label for="to">Email</label>
            <div class="controls">
                <input type="text" name="to" id="to" class="span12" value="<?php if (isset($_POST['to'])) echo $_POST['to']; ?>" />
            </div>
        </div>
        <div class="control-group">
            <label for="subject">Subject</label>
            <div class="controls">
                <input type="text" name="subject" id="subject" class="span12" value="<?php if (isset($_POST['subject'])) echo $_POST['subject']; ?>" />
            </div>
        </div>
        <div class="control-group">
            <label for="message">Message</label>
            <div class="controls">
                <textarea name="message" id="message"class="span12" rows="20" cols="50"><?php if (isset($_POST['message'])) echo $_POST['message']; ?></textarea>
            </div>
        </div>
        <div class="form-actions">
            <input type="hidden" name="action" value="envoyer" />
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>

<?php include 'footer.php' ?>

</html>



