<?php
if (!isset($_POST['fullname']) and !isset($_POST['position_of_employer']) and !isset($_POST['position']) and !isset($_POST['number']) and !isset($_POST['orgname']) and !isset($_POST['to']))
{
    exit(1);
} else {
    print '<html lang="ru" style="padding: 0; margin: 0; text-align: center; align-items: center;"><body><script>setTimeout(() => {console.log("Waiting..."); }, 5000);</script><h1>Checking your browser...</h1><br><h2>Please, wait about 5 seconds...</h2><p>DDos защита</p></body></html>';
//    sleep(5);

    $fullname = $_POST['fullname'];
    $number = $_POST['number'];
    $orgname = $_POST['orgname'];
    $to = $_POST['to'];
    $position = $_POST['position'];
    $position_of_employer = $_POST['position_of_employer'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // LOAD MPDF
    require 'vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();

    // OPTIONAL META DATA
    $mpdf->SetTitle($number);
    $mpdf->SetAuthor($fullname);
    $mpdf->SetCreator("Vladislav Argun");


    //$mpdf->SetProtection([], "user", "password");

    // THE HTML
    $html = '
    <!doctype html>
    <html lang="en" style="margin: 0; padding: 0; display: flex; flex-direction: column; align-items: center; background-color: black;">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body style="margin: 0; padding: 0; width: 210mm; height: 297mm; background-color: white;">
    <div style="display: flex; flex-direction: column; align-items: flex-start; padding: 0 3em 3em 3em;">
        <p>' . $orgname . '</p>
        <p>' . $address . ' тел. ' . $phone . '</p>
    </div>
    <h3 style="text-align: center;">СПРАВКА №' . $number . '</h3>
    <div style="max-width: 50em; margin: 3em, 5em, 3em, 3em; padding-top: 6em;">
        <p style="margin-left: 3em; margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0;">Выдана ' . $to . '</p>
    
        <p style="">в том, что он (она) действительно работает в ' . $orgname . '</p>
        <p>в должности ' . $position . '</p>
    
        <p style="word-spacing: 2em; margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0;">Справка дана для предоставления по месту требования</p>
    </div>
    <br><br><br>
    <div style="display: flex; flex-direction: row; justify-content: space-around;">
        <p style="padding-left: 3em;">' . $position_of_employer . ' ' . $orgname . ' <br><br>' . $fullname . '</p>
        <div style="padding: -3.5em; padding-left: 30em;">
            <p style="margin: 0; padding: 0; margin-top: 10px; text-align: center;">_________________</p>
            <p style="text-align: center; font-size: 10px; margin: 0; padding: 0;">(подпись работодателя)</p>
        </div>
    </div>
    </body>
    </html>
    ';

    // WRITE TO PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output($number . '.pdf', 'I');

//header('Location: ./sertificates/'.$number.'.pdf');
};