<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Upload for train</title>
        <style>
            .upload{
                opacity: 0.4;
                cursor: pointer;
            }

            .upload:hover{
                opacity: 1;
            }

            .show{
                display: block;
            }

        </style>
    </head>
    <body>
        <div class="container" >

            <?php if( $_SESSION["upload-result"] && $_SESSION["upload-result"]==1): ?>
                <div class="row">
                    <div class="col-sm">

                    </div>
                    <div class="col-sm-5 bg-success border-primary text-center" 
                        style="border-radius:2em;height:3em;margin-top:8em;">
                        <p class="text-light" style="margin-top:0.8em;">UPLOAD SUCCESS</p>
                    </div>
                    <div class="col-sm">

                    </div>
                </div>
            <?php endif ?>

            <?php if( $_SESSION["upload-result"] && $_SESSION["upload-result"]==9): ?>
                <div class="row">
                    <div class="col-sm">

                    </div>
                    <div class="col-sm-5 bg-danger border-primary text-center" 
                        style="border-radius:2em;height:3em;margin-top:8em;">
                        <p class="text-light" style="margin-top:0.8em;">UPLOAD FAIL!</p>
                    </div>
                    <div class="col-sm">

                    </div>
                </div>
            <?php endif ?>
            
            <form method="post" action="upload.php" enctype="multipart/form-data" name="formUploadFile">        
                <div class="row">
                    <div class="col-sm">

                    </div>
                    <div class="col-sm-5 bg-light border-primary text-center upload" 
                    style="border:dashed;border-radius:2em;height:10em;margin-top:<?php echo ($_SESSION["upload-result"])?'1':'10'; ?>em;">
                        <img src="Upload2.png" style="height:3em;" class="mt-5" />
                        <p class="text-dark mt-1">Click for upload</p>
                    </div>
                    <div class="col-sm">

                    </div>
                </div>
                <input type="file" name="files[]" multiple="multiple" style="display:none;" id="upload_img"/>    
                <div class="row">
                    <div class="col-sm">

                    </div>
                    <div class="col-sm-5 mt-4">
                        <input type="text" name="filename" class="form-control" placeholder="Enter your name" autocomplete="off"/>
                    </div>
                    <div class="col-sm">

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">

                    </div>
                    <div class="col-sm-5 mt-4 text-center">
                        <input type="submit" value="Upload File" name="btnSubmit" class="btn btn-dark"/>
                    </div>
                    <div class="col-sm">

                    </div>
                </div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            $('.upload').click(function(){
                $('#upload_img').trigger('click');
            });

            $('input[type=file]').change(function(a,b){
                console.log("A >> ",$(this)[0].files);
                var length = $(this)[0].files.length;
                var listFileName = "";
                if(length>0){
                    listFileName += "<p class=\"text-dark mt-4\">";
                    for(var i=0;i<$(this)[0].files.length;i++){
                        listFileName += $(this)[0].files[i].name+"<br>";
                    }
                    listFileName += "</p>";
                }else{
                    listFileName = "<img src=\"Upload2.png\" style=\"height:4em;\" class=\"mt-4\">";
                    listFileName += "<p class=\"text-dark\">Click for upload</p>";
                }
                $('.upload').html(listFileName);
            });

        </script>
        <?php $_SESSION["upload-result"]=0; ?>
    </body>
</html>