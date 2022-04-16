<html>

<head>
    <title>Main Page</title>
</head>

<body>
    <h2>Main Page</h2>

    <form enctype="multipart/form-data" method="POST">

        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

        Send this file: <input name="userfile" type="file" />
        <input type="submit" value="Send File" />
    </form>

    <?php
    $uploaddir = 'uploads/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    echo $uploadfile;

    echo '<pre>';
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Possible file upload attack!\n";
    }

    echo 'Here is some more debugging info:';
    print_r($_FILES);

    print "</pre>";

    ?>
</body>

</html>