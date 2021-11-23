<?php
    $action = "";
    if (!empty($_POST["action"])) $action = $_POST["action"];
    $editId = "";
    if ($action == "edit")
    {


    $editId = $_POST["editId"];
            $fileName = "filename.txt";
            $readData = file("filename.txt", FILE_IGNORE_NEW_LINES);    


    list($name, $age, $gender, $address, $status, $time) = array_pad(explode("|---|", $readData[$editId], 7), 7, null);  
        $action = "edit";
        $submit = "Update";
        $formTitle = "Edit Record";
    }

    else
    {   
        $name = "";
        $age = "";
        $gender = "";
        $address = "";
        $status = "";
        $time = "";
        $action = "add";
        $submit = "Add";
        $formTitle = "Add New Record";

}
?>

<html>
    <head>
           <title>Records</title>
    </head>
    <body>
        <center>
            <form action="display.php" method="post" name="recordForm" id="recordForm">
            <label><?=$formTitle?></label>
                <table style="border:3px solid black;" width="350">                                     
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="username" id="username" size="21" style="font-family:Verdana; 
                          font-size:16px;" value="<?=$name?>"/></td>
                    </tr>
                    <tr>
                        <td>age:</td>  
                        <td><input type="text" name="userage" id="userage" size="21" style="font-family:Verdana; 
                          font-size:16px;" value="<?=$age?>"/></td>
                    </tr>
                    <tr>
                        <td>gender:</td>  
                        <td><input type="text" name="gender" id="gender" size="21" style="font-family:Verdana; 
                          font-size:16px;" value="<?=$gender?>"/></td>
                    </tr>
                    <tr>
                        <td>address:</td>  
                        <td><input type="text" name="address" id="address" size="21" style="font-family:Verdana; 
                          font-size:16px;" value="<?=$address?>"/></td>
                    </tr>
                    <tr>
                        <td>time:</td>  
                        <td><input type="text" name="time" id="time" size="21" style="font-family:Verdana; 
                          font-size:16px;" value="<?=$time?>"/></td>
                    </tr>
                    <tr>
                        <td>status:</td>  
                        <td><input type="text" name="status" id="status" size="21" style="font-family:Verdana; 
                          font-size:16px;" value="<?=$status?>"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>                         
                        <td>
                            <input type="hidden" id="editId" name="editId" value="<?=$editId?>"/>
                            <input type="submit" id="btnSubmit" name="btnSubmit" value="<?=$submit?>"/>
                            <input type="hidden" name="action" id="action" value="<?=$action?>"/> 
                        </td>
                    </tr>
                </table>
            </form> 
        </center>
    </body>
</html>