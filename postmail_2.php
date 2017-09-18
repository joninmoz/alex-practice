<?php 
header('Access-Control-Allow-Origin: *');

require 'mail/PHPMailerAutoload.php';
$config = parse_ini_file('mail/config.ini', true);

$mail = new PHPMailer;



$mail->setFrom('jon@equipmoz.org', 'Fonte da Vida');
 $mail->addAddress('jon@equipmoz.org', 'Jon Reinagel');
 $mail->addAddress('fonte@equipmoz.org', 'Fonte Group');

$mail->isHTML(false);
$name = $_REQUEST['name'];
$organization = $_REQUEST['organizacao'];

if(isset($_REQUEST['teaching'])) {
    $subject = "Fonte da Vida Copyright Submission";
    $message = $name . ", email: " . $_REQUEST['email'] . " from the organization " . $organization . " had a copyright concern about the following teaching:" . "\n\n" . $_REQUEST['teaching'] . "\n Details: " . $_REQUEST['issue'];
} else {
    $subject = "Fonte da Vida Partnership Submission";
    $message = "<h4>Recebemos requisicao de Parceria com os detalhes abaixo:</h4> Nome do Parceiro: <strong>".$name . "</strong><br/> Email de contacto: <strong>" . $_REQUEST['email'] . "</strong><br/> Contacto Telefonico: <strong>" . $_REQUEST['telefone']. "</strong><br/> Pais de Origem: <strong>". $_REQUEST['pais'] ."</strong><br/> Organizacao Responsavel <strong>" . $organization . "</strong><br/> Faz parte da Lideranca na Organizacao?: <strong>".$_REQUEST['lideranca']. "</strong><br/> .......................... <br/> Recursos que ira fornecer: <strong>".$_REQUEST['resources']."</strong><br/> Idioma dos recursos a fornecer: <strong>". $_REQUEST['idioma']."</strong>";
    }

$mail->Subject = $subject;
$mail->Body    = $message;

if (($name == "") && ($_REQUEST['telefone'] == "")) {
	echo 'Preencha todos os Campos do Formulario';
} else {
	if(!$mail->send()) {
	    echo 'Requisicao Nao Enviada. Tente Novamente.';
	    echo 'Requisicao Nao Enviada. Tente Novamente: ' . $mail->ErrorInfo;
	} else {
	    echo 'Requisicao Enviada Com Sucesso.';
	}
}
