<?php
$name = "";
$age = "";
$action = "";
$editId = "";
$gender = "";
$time = "";
$status = "";
$address = "";

if (!empty($_POST["username"])) $name = $_POST["username"];
if (!empty($_POST["userage"])) $age = $_POST["userage"];
if (!empty($_POST["gender"])) $gender = $_POST["gender"];
if (!empty($_POST["address"])) $address = $_POST["address"];
if (!empty($_POST["time"])) $time = $_POST["time"];
if (!empty($_POST["status"])) $status = $_POST["status"];
if (!empty($_POST["action"])) $action = $_POST["action"];
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>webfinals</title>
    <link href="index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
  </head>
    <body>
    <nav class="navbar">
      <div class="container-fluid">
        <h2>WELCOME</h2>
        <h1>Display Page</h1>
      </div>
    </nav>
        <?php


        if ($action == "add")
        {
            $fileName = "filename.txt";
            $data = fopen($fileName, "a");
            fwrite($data, $name."|---|".$age."|---|".$gender."|---|".$address."|---|".$time."|---|".$status."\r\n");
            fclose($data);
        }
        else if($action == "delete")
        {
            $deleteId = $_POST['deleteId'];         
            $readData = file("filename.txt", FILE_IGNORE_NEW_LINES);            
            $arrOut = array();

            foreach ($readData as $key => $val)
            {
                 if ($key != $deleteId) $arrOut[] = $val;
            }           

            $strArr = implode("\n",$arrOut);
            $fp = fopen('filename.txt', 'w');
            if (count($readData) < 0)
            {
             fwrite($fp, $strArr."\r\n");
            }
            else
            fwrite($fp, $strArr);   
            fclose($fp);
        }
        else if($action == "edit")
        {   
            $editId= $_POST["editId"];
            $readData = file("filename.txt", FILE_IGNORE_NEW_LINES);
            $readData[$editId] = ($name."|---|".$age."|---|".$gender."|---|".$address."|---|".$time."|---|".$status);
            $writeData = implode("\r\n", $readData);
            $fileWrite = fopen('filename.txt', 'w');
            fwrite($fileWrite, $writeData."\r\n"); 
            fclose($fileWrite);
        }


        $fileName = "filename.txt";
        $readData = file("filename.txt", FILE_IGNORE_NEW_LINES);
        ?>
        <table border="1" width="50%">
            
            <tr>
                <td>Sr. No</td>
                <td>Name</td>
                <td>Age</td>
                <td>Gender</td>
                <td>Address</td>
                <td>time</td>
                <td>Consultation Status</td>
                <td colspan = "2">Action</td>
            </tr>
          
            
        <?php
        $cnt = 1;
        if (count($readData) > 0)
        {
            foreach ($readData as $key => $val)
            {
                list($name, $age, $gender, $address, $time, $status) = array_pad(explode("|---|", $val, 7), 7, null);    
            ?>
           
                <tr>
                    <td><?=$cnt?></td>
                    <td><?=$name?></td>
                    <td><?=$age?></td>
                    <td><?=$gender?></td>
                    <td><?=$address?></td>
                    <td><?=$time?></td>
                    <td><?=$status?></td>
                    <td>
            
                        <form action="add.php" method="post" name="editForm" id="editForm">
                            <input type="submit" id="btnEdit" name="btnEdit" value="Edit"/>
                            <input type="hidden" id="editId" name="editId" value="<?php echo $key; ?>"/> 
                            <input type="hidden" name="action" id="action" value="edit"/>
                        </form>
                        <form action="" method="post" name="deleteForm" id="deleteForm">
                            <input type="submit" id="delete" name="delete" value="Delete" onclick="return confirm('Do you want to delete this record?');"/>
                            <input type="hidden" id="deleteId" name="deleteId" value="<?php echo $key; ?>"/>
                            <input type="hidden" name="action" id="action" value="delete"/>
                        </form>
                    </td>
                </tr>
            <?php
                $cnt++;
            }
        }
        else
        {
            echo "No Record Found";
        }
        ?>
            <tr>
                <td colspan = "7"><p>[ <a href="add.php">Add New Record</a> ]</p></td>
            </tr>
        </table>
    </body>
</html>