<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BASE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style>
        #outer-container{
            border: 1px solid black;
        }
        .main-header {
            font-weight: bold;
            text-transform: uppercase;
            margin: 3% 0;
        }
        @media(max-width:768px) {
            .main-content{
                text-align: justify;
            }
        }
    </style>
</head>
<body>
    <div class="jumbotron">
        <div class="container" id="outer-container">
            <div align=center>
                <img src="http://intimasia.co.in/img/logo_old.png" alt="Intimasia Logo">
            </div>
            <div class="container" id="main-body">
                <div class="main-header" align=center>
                    <?php echo $mainHeader;?>
                </div>

                <div class="subject-to">
                    Dear <?php echo $user; ?>,
                </div><br>
                
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
                Warm Regards,<br> 
                Exbhitor Management System<br><br>
                <i>This is a system generated mail.</i>
                <br><span style='color:rgb(153, 0, 0)'>Brand Strategy | Events & Promotions | Exhibitions | Shoot Management | Publishing</span><br>
                <b>Peppermint Communications Pvt. Ltd.</b><br>
                Unit No. B-135, Antophill Warehousing Complex, V.I.T. College Road, Wadala (E), Mumbai - 400037<br>
                Tel: 91-22-40956666 (Board) Web: <a href='www.peppermint.co.in'>www.peppermint.co.in</a> | <a href='www.innersecrets.co.in'>www.innersecrets.co.in</a> | <a href='www.iaai.co.in'>www.iaai.co.in</a><br>
                <img width=100% src='http://superjuniorz.com/images/super-email-header.jpg' alt='Super Juniorz Logo'/>
                </div>
            </div>
        </div>
    </div>
</body>
</html>