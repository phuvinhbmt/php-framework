<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload new CSV</title>
        <link rel="stylesheet" href="./public/css/styles.css">
    </head>
    <body>
        <div id="header"></div>
        <form action=""  method="post" enctype="multipart/form-data">
            <h3>Upload new CSV</h3>
            Select CSV to upload <br>
            <input type="file" value="Choose File" name="file" id="uploadFile"><br>
            <input type="submit" value="Upload CSV" name="submit"><br>
        </form>