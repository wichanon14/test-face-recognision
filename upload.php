<?php
session_start();
error_reporting(E_ALL);

            if(isset($_POST["btnSubmit"]))
            {
                $errors = array();
                $uploadedFiles = array();
                $extension = array("jpeg","jpg","png","gif");
                $bytes = 1024;
                $KB = 1024;
                $totalBytes = $bytes * $KB;
                $UploadFolder = "/var/www/html/FaceRecognize/train";
                //$UploadFolder = "train";
                $name = $_FILES["files"]["name"][0];
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                $savename = $_POST['filename'].$ext;
                
                $counter = 0;
                
                print_r($_FILES);

                $name = $_POST['filename'];
                $start_index = 0;
                $i=0;

                if(file_exists($UploadFolder."/".$name."_".$i.".".$ext) == true){
                    
                    while(file_exists($UploadFolder."/".$name."_".$i.".".$ext) == true){
                        $i++;
                    }
                    $start_index = $i;
                    echo "start index >> ".$i;
                }else{
                    echo "start index >> ".$i;

                }

                print_r($_FILES["files"]);

                foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
                    $temp = $_FILES["files"]["tmp_name"][$key];
                    
                    $name = $_FILES["files"]["name"][$key];
                    
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    $rename = $_POST["filename"]."_".$start_index.".".$ext;
                    
                    
                    if(empty($temp))
                    {
                        break;
                    }
                    
                    $counter++;
                    $UploadOk = true;
                    
                    if($_FILES["files"]["size"][$key] > $totalBytes)
                    {
                        $UploadOk = false;
                        array_push($errors, $name." file size is larger than the 1 MB.");
                    }
                    
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    
                    if(in_array($ext, $extension) == false){
                        $UploadOk = false;
                        array_push($errors, $name." is invalid file type.");
                    }
                    
                    if($UploadOk == true){
                        chmod($temp, 0777);
                        move_uploaded_file($temp,$UploadFolder."/".$rename);
                        
                        array_push($uploadedFiles, $name);
                    }

                    $start_index += 1;
                }
                
                if($counter>0){
                    if(count($errors)>0)
                    {
                        echo "<b>Errors:</b>";
                        echo "<br/><ul>";
                        foreach($errors as $error)
                        {
                            echo "<li>".$error."</li>";
                        }
                        echo "</ul><br/>";
                        $_SESSION["upload-result"] = 9;
                    }
                    
                    if(count($uploadedFiles)>0){
                        echo "<b>Uploaded Files:</b>";
                        echo "<br/><ul>";
                        foreach($uploadedFiles as $fileName)
                        {
                            echo "<li>".$fileName."</li>";
                        }
                        echo "</ul><br/>";
                        
                        echo count($uploadedFiles)." file(s) are successfully uploaded.";
                        $_SESSION["upload-result"] = 1;
                        header("location:upload_for_train.php");
                    }                                
                }
                else{
                    echo "Please, Select file(s) to upload.";
                    $_SESSION["upload-result"] = 9;
                }
            }
        ?>