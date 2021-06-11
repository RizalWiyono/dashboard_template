<?php
include('../../../src/connection/connection.php');

$no = 1;
$query = mysqli_query($connect, "SELECT * FROM tb_account WHERE role = '' ORDER BY account_id ASC");
while($row = mysqli_fetch_array($query)){
    $param_name = $row['username'];
?>
    <tr class="sub-title-table">
        <td><?=$no?>.</td>
        <td><?=$row['username']?></td>
        <?php
        $query_pr = mysqli_query($connect, "SELECT * FROM tb_activity WHERE username LIKE '%$param_name%'");
        while($data = mysqli_fetch_array($query_pr)){
        ?>
        <td><?=$data['date']?></td>
        <?php
        }
        ?>
        <td>
            <button value="<?=$row['account_id']?>" class="btn-acc" id="btn_acc[]" onclick="getvalue()">Accept</button>
        </td>
    </tr> 
<?php
$no++;
}
?>