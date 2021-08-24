<?php 
    session_start();
    include_once "./config.php";

    $fname = mysqli_escape_string($conn, $_POST['fname']);
    $lname = mysqli_escape_string($conn, $_POST['lname']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //email validation
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            
            if(mysqli_num_rows($sql) > 0){ //if email already exist
                echo($email."email already in use"); 
            }else {
                //check if file is uploaded or not
                if(isset($_FILES['image'])){  //if file is uploaded
                    $img_name = $_FILES['image']['name']; //get file name
                    $img_type = $_FILES['image']['type']; //get file type
                    $tmp_name = $_FILES['image']['tmp_name']; //this tmprary name will used to save file in folder
                    
                    //get image extension using explode
                    // var_dump($_FILES['image']);

                    $img_explode =  explode('.',$img_name);
                    $img_ext =  end($img_explode);

                    $extensions =  ["jpeg", "jpg" , 'png'];

                    if(in_array($img_ext,$extensions) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;
                        
                        if( move_uploaded_file($tmp_name, "images/".$new_img_name)){ 
                            $status = 'Active'; //after signup status will be active
                            $random_id = rand(time(),10000000); //create random id for users
                        
                            // //insert into db
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                            VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}' ,'{$status}')"); 
                            // var_dump($sql2);
                            if($sql2){ //if datainserted success
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0 ){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id']; //using this session  we  used user unique_id in other php files
                                    echo "success";
                                }

                            }else {
                                echo  "Some thing went wrong";
                            }
                        }


                    }else{
                        echo "plese select an image with - jpeg, jpg , png";
                    }



                }else {
                    echo("plase set an image file");
                }
            }

        }else {
            echo($email . 'email not valid');
        }
    }else {
        echo "all input are required";
    }