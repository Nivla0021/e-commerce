<?php
session_start();
if (!isset($_SESSION['role'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: landingPage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message User</title>
    <link rel="icon" type="image/png" href="pics/bastalogo.png">
    <script src="javscript/jquery-3.7.1.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .chat-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .user_message_profile {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .messages {
            max-height: 400px;
            overflow-y: auto;
            padding: 10px;
        }

        .message {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            max-width: 75%;
        }

        .sender {
            margin-left: auto;
            background-color: #dcf8c6;
        }

        .receiver {
            align-self: flex-start;
            background-color: #f1f0f0;
            border: 1px solid #ddd;
        }

        .message-text {
            margin: 0;
            font-size: 16px;
        }

        .message-time {
            align-self: flex-end;
            font-size: 12px;
            color: #888;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        textarea {
            width: calc(100% - 60px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }

        input[type="submit"] {
            width: 50px;
            margin-left: 10px;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .prof {
            width: 200px;
            margin-left: 30%;
            border-radius: 50%;
        }

        .back {
            width: 30px;
            position: absolute;
            top: 3px;
            left: 0px;
            cursor: pointer;
        }

        .username {
            margin-left: 35%;
        }

        .reProf {
            width: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .conte {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="user_message_profile">
        <?php
        include 'conn2.php';
        $id = $_POST['user_id'];
        $sql = "SELECT * from userinfo where id = '$id'";
        $result = $conn->query($sql);
        $pic = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pic = $row['image_path'];
                $fname = $row['first_name'];
                $lname = $row['last_name'];

                echo <<< HTML
                        <a href="user.php"><img src="pics/left-arrow.png" alt="back-btn" class="back"></a>
                        <img src="{$pic}" alt="logo" class="prof">
                        <h3 class="username">{$fname}  {$lname}</h3>
                        HTML;
            }
        }
        ?>

    </div>
    <?php
    include 'conn2.php';
    $currentUserId = $_SESSION['user_id'];
    $rec = $_POST['user_id'];
    $sql = "SELECT COUNT(*) AS unread_count
                FROM Messages
                WHERE receiverId = '$currentUserId' AND is_read = FALSE AND senderId = '$rec'";
    $conn->query($sql);

    function markMessagesAsRead($currentUserId, $conn)
    {
        $rec = $_POST['user_id'];
        $sql = "UPDATE Messages SET is_read = TRUE WHERE receiverId = '$currentUserId' AND is_read = FALSE AND senderId = '$rec'";
        $conn->query($sql);
    }

    markMessagesAsRead($currentUserId, $conn);
    ?>
    <div class="chat-container">
        <div class="messages" id="messages">
            <?php
            $sender = $_SESSION['user_id'];
            $rec = $_POST['user_id'];
            include 'conn2.php';
            $currentUserId = $_SESSION['user_id'];
            $sql = "SELECT 
            m.messageID,
            m.message,
            m.senderId,
            sender.email AS senderUsername,
            m.receiverId,
            receiver.email AS receiverUsername,
            m.timesend
          FROM 
            Messages m
          JOIN 
            UserInfo sender ON m.senderId = sender.id
          JOIN 
            UserInfo receiver ON m.receiverId = receiver.id
            WHERE 
                (m.senderId = '$sender' and m.receiverId = '$rec') or (m.senderId = '$rec' and m.receiverId = '$sender')
          ORDER BY 
            m.timesend ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $message = $row['message'];
                    $time = $row['timesend'];
                    $isSender = $row['senderId'] == $currentUserId;
                    $messageClass = $isSender ? 'sender' : 'receiver';

                    if ($isSender) {
                        echo <<<HTML
                        <div class="message {$messageClass}">
                            <p class="message-text">{$message}</p>
                            <span class="message-time">{$time}</span>
                        </div>
            HTML;
                    } else {
                        echo <<<HTML
                        <div class="conte">
                            <div>
                            <img src="{$pic}" class="reProf">
                            </div>
                        
                        <div class="message {$messageClass}">
                            <p class="message-text">{$message}</p>
                            <span class="message-time">{$time}</span>
                        </div>
                        </div>
                        
            HTML;
                    }
                }
            }
            ?>
        </div>
        <form action="submitMessageAdmin.php" method="POST" id="messageForm">
            <div class="form-group">
                <textarea id="autoResizeTextarea" placeholder="Type your message..." name="sender_message" required></textarea>
            </div>
            <?php
            $usID = $_POST['user_id'];
            echo <<< HTML
            <input type="hidden" name="user_id" value="{$usID}">
            <input type="submit" value="Send">
            HTML;
            ?>

        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textarea = document.getElementById("autoResizeTextarea");
            const messagesContainer = document.getElementById("messages");

            function autoResize() {
                textarea.style.height = 'auto';
                textarea.style.height = textarea.scrollHeight + 'px';
            }



            textarea.addEventListener('input', autoResize);

            textarea.addEventListener('keypress', function(event) {
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault();
                    const message = textarea.value.trim();
                    if (message) {
                        addMessage(message);
                        textarea.value = '';
                        autoResize();
                    }
                }
            });

            // Initial call to adjust the height in case there is pre-filled content
            autoResize();
        });
    </script>

    <script>
        $(document).ready(function() {
            // Automatically scroll to the bottom of the page
            $('html, body').animate({
                scrollTop: $(document).height() - $(window).height()
            }, 100); // 2000 milliseconds for the animation duration
        });
        $(document).ready(function() {
            // Function to scroll the messages container to the bottom
            function scrollToBottom() {
                $('#messages').scrollTop($('#messages')[0].scrollHeight);
            }

            // Scroll to the bottom on page load
            scrollToBottom();

            $('#autoResizeTextarea').on('keydown', function(event) {
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault(); // Prevent newline
                    $('#messageForm').submit();
                }
            });

            $('#messageForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Append the new message to the messages div
                        $('#messages').append(response);

                        // Clear the textarea
                        $('#autoResizeTextarea').val('');

                        // Scroll to the bottom of the messages div
                        scrollToBottom();
                        $(document).ready(function() {
                            // Automatically scroll to the bottom of the page
                            $('html, body').animate({
                                scrollTop: $(document).height() - $(window).height()
                            }, 100); // 2000 milliseconds for the animation duration
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Message submission failed: ' + error);
                    }
                });
            });


        });
        $(document).ready(function() {
            $('#autoResizeTextarea').keypress(function(event) {
                if (event.which === 13 && !event.shiftKey) {
                    event.preventDefault();
                    $('#messageForm').submit();
                }
            });
        });
    </script>
</body>

</html>