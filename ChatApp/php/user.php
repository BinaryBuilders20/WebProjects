<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM users WHERE unique_id != {$outgoing_id}";
$output = "";
if ($result = mysqli_query($connection, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['unique_id'];
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = $user_id OR outgoing_msg_id = $user_id) AND (outgoing_msg_id = $outgoing_id OR incoming_msg_id = $outgoing_id) ORDER BY msg_id DESC LIMIT 1";
            if ($query2 = mysqli_query($connection, $sql2)) {
                if (mysqli_num_rows($query2) > 0) {
                    $row2 = mysqli_fetch_assoc($query2);
                    $msg = strlen($row2['msg']) > 28 ? substr($row2['msg'], 0, 28) . '...' : $row2['msg'];
                    $offline = $row['status'] === "Offline now" ? "offline" : "";
                    $you = ($outgoing_id == $row2['outgoing_msg_id']) && !empty($row2['msg']) ? "You: " : "";
                } else {
                    $msg = "No messages";
                    $you = ""; // Set $you to an empty string when there are no messages
                    $offline = $row['status'] === "Offline now" ? "offline" : "";
                }
            }
            $output .= '
            <a href="message.php?user_id=' . $row['unique_id'] . '">
                <div class="content">
                    <img src="php/images/' . $row['img'] . '">
                    <div class="detail">        
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                </div>
                <div class="status-dot ' . $offline . '"><i class="fa fa-circle"></i></div>
            </a>
            ';
        }
        echo $output;
    } else {
        echo "No users available";
    }
} else {
    echo "Error: " . mysqli_error($connection);
}
?>
