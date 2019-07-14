<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BASE</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        #outer-container{
            border: 1px solid black;
            padding: 15px;
        }
        .main-header {
            font-weight: bold;
            text-transform: uppercase;
            margin: 3% 0;
        }
        .jumbotron {
            background-color: #e9ecef;  
            
        }
        @media(max-width:768px) {
            .main-content{
                text-align: justify;
            }
            .container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="jumbotron container">
        <div id="outer-container">
            <div align=center>
                <img src="http://intimasia.co.in/ems/images/liva_intimasia_logo.jpg" alt="Intimasia Logo" width="300px" height="150px">
            </div>
            <div class="container" id="main-body">
                
                <div class="main-header" align=center>
                    <?php echo $mainHeader;?>
                </div>

                <?php if(isset($user)): ?>
                    <div class="subject-to">
                        Dear <?php echo $user; ?>,
                    </div><br>
                <?php endif ?>

                <div class="main-content">
                    <p><?php echo $content1; ?></p>
                </div><br>
                
                <?php if (isset($content2)): ?>
                    <div class="main-content">
                        <p><?php if (isset($content2)) echo $content2; ?></p>
                    </div><br>
                <?php endif ?>

                <?php if (isset($content3)): ?>
                    <div class="main-content">
                        <p><?php  echo $content3; ?></p>
                    </div><br>
                <?php endif ?>

                <div class="from">
                Warm Regards,<br> <br>
                Farheen Khan<br>
                Sr. Marketing & PR Executive<br>
                +91-80808-99927<br><br>
                <i>This is a system generated mail.</i>
                <br><span style='color:rgb(153, 0, 0)'>Brand Strategy | Events & Promotions | Exhibitions | Shoot Management | Publishing</span><br>
                <b>Peppermint Communications Pvt. Ltd.</b><br>
                Unit No. B-135, Antophill Warehousing Complex, V.I.T. College Road, Wadala (E), Mumbai - 400037<br>
                Tel: +91-22-40956666 (Board) Web: <a href='www.peppermint.co.in'>www.peppermint.co.in</a> | <a href='www.innersecrets.co.in'>www.innersecrets.co.in</a> | <a href='www.iaai.co.in'>www.iaai.co.in</a><br>
                <img width=100% src='http://intimasia.co.in/ems/images/mail_signature.png' alt='Intimasia mail signature'/>
                </div>
            </div>
        </div>
    </div>
</body>
</html>