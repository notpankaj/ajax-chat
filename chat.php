<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CN | CA</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header('location: ./login.php ');
    }

?>


<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>

            <?php 
                include_once "php/config.php";
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }

            ?>

                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="<?php echo  "php/images/" . $row['img'] ?>" alt="">
                <div class="details">
                    <span><?php echo($row['fname'] . ' ' . $row['lname'])  ?></span>
                    <p><?php echo $row['status'] ?></p>
                </div>
            </header>

            <div class="chat-box">
                <div class="chat outgoing">
                    <div class="details">
                        <p>wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwt.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="img.jpg" alt="">
                    <div class="details">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>
            
            <form action="" class="typing-area">
                <input type="hidden" name="outgoing_id" value="<?php echo $_SESSION['unique_id'] ?>">
                <input type="hidden" name="incomming_id" value="<?php echo $user_id?>">
                <input type="text" name="message" class="input-filed" placeholder="Type a message here...">
                <button><i class="fas fa-telegram-plane"></i></button>
            </form>

        </section>
    </div>
    <script src="javascript/chat.js"></script>
</body>

</html>