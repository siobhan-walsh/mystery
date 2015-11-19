<?php
include("connection.php");
mysql_select_db("funkint1_mystery",$con);
$result=mysql_query("select * from user",$con);

echo "<table border='1' >
<tr>
<td align=center><b>ID</b></td>
<td align=center><b>First Name</b></td>
<td align=center><b>Last Name</b></td>
<td align=center><b>Username</b></td></td>
<td align=center><b>Email</b></td>";

while($data = mysql_fetch_row($result))
{   
    echo "<tr>";
    echo "<td align=center>$data[0]</td>";
    echo "<td align=center>$data[1]</td>";
    echo "<td align=center>$data[2]</td>";
    echo "<td align=center>$data[3]</td>";
    echo "<td align=center>$data[5]</td>";
    echo "</tr>";
}
echo "</table>";
?>