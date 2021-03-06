<?php
/**
 * File Name: web.php
 * PHP Version 7
 *
 * @category None
 * @package  None
 * @author   Jack Chen <redchenjs@live.com>
 * @license  https://server.zyiot.top/lem public
 * @version  GIT: <v0.4>
 * @link     https://server.zyiot.top/lem
 */

const DB_HOST = 'localhost:3306';
const DB_USER = 'lemadmin';
const DB_PASS = 'lempasswd';
const DB_NAME = 'lem_db';

/**
 * 显示系统日志
 *
 * @return none
 */
function listLog()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if (!$conn) {
        die('Access denied.');
    }
    mysqli_select_db($conn, DB_NAME);
    mysqli_set_charset($conn, 'utf8');

    // 查询log_tbl中的最后20条记录
    $sql = "SELECT * FROM (SELECT * FROM `log_tbl` ORDER BY `create_time` DESC LIMIT 20) AS `tbl` ORDER BY `create_time` ASC";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Query failed.');
    }
    // 输出查询结果
    echo '<header>';
    echo '<meta http-equiv="refresh" content="3">';
    echo '</header>';
    echo '<h2> 实验室设备管理系统日志 <h2>';
    echo '<table border="1" width=75%> <tr>'.
            '<td> 用户 </td>'.
            '<td> 位置 </td>'.
            '<td> 时间 </td>'.
            '<td> 备注 </td>'.
         '</tr>';
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        echo '<tr>'.
                '<td> '.$row['user'].' </td>'.
                '<td> '.$row['location'].' </td>'.
                '<td> '.$row['create_time'].' </td>'.
                '<td> '.$row['comment'].' </td>'.
             '</tr>';
    }
    echo '</table>';
}
?>
