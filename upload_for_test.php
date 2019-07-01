<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Upload for test</title>
        <style>
            .upload{
                opacity: 0.4;
                cursor: pointer;
                border:dashed;
                border-radius:2em;
            }

            .upload:hover{
                opacity: 1;
                border:dashed;
                border-radius:2em;
            }

            .upload-show{
                cursor:pointer;
            }

        </style>
    </head>
    <body>
        <div class="container" >
            <form id="upload-form" method="post" enctype="multipart/form-data" name="formUploadFile">        
                <div class="row">
                    <div class="col-sm">

                    </div>
                    <div class="col-sm-3 bg-light border-primary text-center upload" 
                        style="height:15em;margin-top:8em;">
                        <img src="Upload2.png" style="height:3em;margin-top:4.5em;" />
                        <p class="text-dark mt-3">UPLOAD IMAGE FOR COMPARE</p>
                    </div>
                    <div class="col-sm">

                    </div>
                    <div class="col-sm-3 border-dark text-center" 
                        style="background-color:#9C9C9C;border:dashed;border-radius:2em;
                        height:15em;margin-top:8em;opacity:0.4;
                        cursor:not-allowed;">
                        <img src="./unknown-person.png" style="height:14.6em;" />
                    </div>
                    <div class="col-sm">

                    </div>
                </div>

                <input type="file" name="files[]" style="display:none;" id="upload_img"/>    
                <input type="submit" value="Search Match" name="btnSubmit" class="btn btn-dark" style="display:none;"/>
                
            </form>
            <div class="row mt-5">
                <div class="col-sm">

                </div>
                <div class="col-sm-5 mt-4 text-center">
                    <input type="button" value="Search Match" name="btnSubmit" class="btn btn-dark"/>
                </div>
                <div class="col-sm">

                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            $('.upload').click(function(){
                $('#upload_img').trigger('click');
                
                $('div + .upload-show').addClass('upload');
                $('div + .upload').removeClass('upload-show');
            });

            $('.upload-show').click(function(){
                $('#upload_img').trigger('click');

                $('div + .upload-show').addClass('upload');
                $('div + .upload').removeClass('upload-show');
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
                    listFileName = "<img src=\"Upload2.png\" style=\"height:3em;margin-top:4.5em;\" />";
                    listFileName += "<p class=\"text-dark mt-3\">UPLOAD IMAGE FOR COMPARE</p>";
                }
                $('.upload').html(listFileName);

                $('input[name=btnSubmit]').trigger('click');
            });

            $('#upload-form').submit( function(e) {
                e.preventDefault();

                if(jQuery('#upload_img')[0].files.length>1){
                    alert('Can\'t upload more than 1 image.');
                    jQuery('#upload_img').val('');
                    var listFileName = "<img src=\"Upload2.png\" style=\"height:3em;margin-top:4.5em;\" />";
                    listFileName += "<p class=\"text-dark mt-3\">UPLOAD IMAGE FOR COMPARE</p>";
                    $('.upload').html(listFileName);
                }else{
                    var data = new FormData(this);
                    data.append('btnSubmit',"Search Match");
                    jQuery.each(jQuery('#upload_img')[0].files, function(i, file) {
                        data.append('file['+i+']', file);
                        console.log('file >> ',file);
                    });
                    console.log('data >> ',data);
                    $.ajax({
                            url: '/FaceRecognize/uploadTest.php',
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',     
                            success: function(data){
                                
                                var url = data['url-img'];
                                var imgHTML = "";
                                if(!url){                
                                    var imgHTML = "<img src=\"Upload2.png\" style=\"height:3em;margin-top:4.5em;\" />";
                                    imgHTML += "<p class=\"text-dark mt-3\">UPLOAD IMAGE FOR COMPARE</p>";

                                    
                                    $('div + .upload-show').addClass('upload');
                                    $('div + .upload').removeClass('upload-show');
                                    
                                    $('.upload').html(imgHTML);
                                }else{
                                    var imgHTML = '<img src="'+url+'" style="height:inherit;width:inherit;margin-top:-3px;">';
                                    
                                    $('div + .upload').addClass('upload-show');
                                    $('div + .upload').removeClass('upload');

                                    $('.upload-show').html(imgHTML);
                                }
                                console.log('url >> ',url);
                                
                                
                                
                            }
                    });
                }

            });

        </script>
    </body>
</html>