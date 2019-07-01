<html>
    <head>
        <title>PHP upload file demo</title>
    </head>
    <body>
        
        <form method="post" action="upload.php" enctype="multipart/form-data" name="formUploadFile">        
            <label>Select single file to upload:</label>
            <input type="file" name="files[]" multiple="multiple" />
            <input type="text" name="filename"/>
            <input type="submit" value="Upload File" name="btnSubmit"/>
        </form>        
        
    </body>
</html>