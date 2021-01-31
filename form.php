<form method="POST" name="email_form_with_php"
action="form.php" enctype="multipart/form-data"> 

<label for='name'>Name: </label>
<input type="text" name="name" >

<label for='email'>Email: </label>
<input type="text" name="email" >

<label for='message'>Message:</label>
<textarea name="message"></textarea>

<label for='uploaded_file'>Select A File To Upload:</label>
<input type="file" name="uploaded_file">

<input type="submit" value="Submit" name='submit'>
</form>
<?php
$mail_to = "tbouakline@gmail.com"; //Destinataire
$from_mail = "support@amimer.com"; //Expediteur
$from_name = "Nom"; //Votre nom, ou nom du site
$reply_to = "support@amimer.com"; //Adresse de réponse
$subject = "Objet du mail";    
if(isset($_FILES["uploaded_file"]) &&  $_FILES['uploaded_file']['name'] != ""){ //Vérifie sur formulaire envoyé et que le fichier existe
        $nom_fichier = $_FILES['fichier']['name'];
        $source = $_FILES['fichier']['tmp_name'];
        $type_fichier = $_FILES['fichier']['type'];
        $taille_fichier = $_FILES['fichier']['size'];}
		
/*$file_name = ;
$path = $_SERVER['DOCUMENT_ROOT']."/fichiers";
$typepiecejointe = filetype($path.$file_name);
$data = chunk_split( base64_encode(file_get_contents($path.$file_name)) );*/
//Génération du séparateur
$boundary = md5(uniqid(time()));
$entete = "From: $from_mail \n";
$entete .= "Reply-to: $from_mail \n";
$entete .= "X-Priority: 1 \n";
$entete .= "MIME-Version: 1.0 \n";
$entete .= "Content-Type: multipart/mixed; boundary=\"$boundary\" \n";
$entete .= " \n";
$message  = "--$boundary \n";
$message .= "Content-Type: text/html; charset=\"iso-8859-1\" \n";
$message .= "Content-Transfer-Encoding:8bit \n";
$message .= "\n";
$message .= "Bonjour,<br />Veuillez trouver ci-joint le bon de commande<br/>Cordialement";
$message .= "\n";
$message .= "--$boundary \n";
$message .= "Content-Type: $typepiecejointe; name=\"$file_name\" \n";
$message .= "Content-Transfer-Encoding: base64 \n";
$message .= "Content-Disposition: attachment; filename=\"$file_name\" \n";
$message .= "\n";
$message .= $data."\n";
$message .= "\n";
$message .= "--".$boundary."--";
mail($mail_to, $subject, $message, $entete);
?>