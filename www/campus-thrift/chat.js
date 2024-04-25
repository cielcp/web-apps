document.addEventListener("DOMContentLoaded", function () {
    // event listener for sending a message (visual only)
    document.getElementById("messageForm").addEventListener("submit", function (event) {
        event.preventDefault(); 
        var message = document.getElementById("chatInput").value.trim();
        if (!message) return; // Exit if message is empty
        // Clear the input field
        document.getElementById("chatInput").value = "";
        // Append the message to the message area
        var messageBubble = '<div class="message mine"><p class="message-bubble me">' + message + '</p><img src="icons/person circle.svg"></div>';
        document.getElementById("messageArea").innerHTML += messageBubble;
        // Scroll to the bottom of the message area
        var messageArea = document.getElementById("messageArea");
        messageArea.scrollTop = messageArea.scrollHeight;
        // Send message to server
        sendMessage(message);
    });

    // Add event listener to chat profiles
    var chatProfiles = document.querySelectorAll(".chat-profile");
    chatProfiles.forEach(function (profile) {
        profile.addEventListener("click", function () {
            // Remove 'selected' class from all chat profiles
            chatProfiles.forEach(function (profile) {
                profile.classList.remove("selected");
            });

            // Add 'selected' class to the clicked chat profile
            this.classList.add("selected");

            // Fetch and display messages for the selected user
            var selectedUser = this.textContent.trim(); // Get the text content of the profile
            fetchMessages(selectedUser);
        });
    });
});

function sendMessage(message) {
    // Send AJAX request to server to save message
    $.ajax({
        url: "index.php",
        type: "POST",
        data: { command: "sendMessage" , message: message},
        success: function (response) {
            // Handle success
            console.log("Message sent:", response);
        },
        error: function (xhr, status, error) {
            // Handle error
            console.error("Error sending message:", error);
        }
    });
}

function fetchMessages(user) {
    // Send AJAX request to server to fetch messages for a user
    $.ajax({
        url: 'fetch_messages.php',
        method: 'POST',
        data: { user: user },
        dataType: 'json',
        success: function (messages) {
            // Handle success
            console.log("Messages for " + user + ":", messages);
            // Update the message area with the fetched messages
            // Example: updateMessageArea(messages);
        },
        error: function (xhr, status, error) {
            // Handle error
            console.error("Error fetching messages:", error);
        }
    });
}




/* $(document).ready(function() {
    // Bind click event to the send button
    $('#sendButton').on('click', function() {
        const message = $('#chatInput').val();
        const username = $('#username').val();
        if (!validateInput(message)) {
            alert('Message cannot be empty');
            return;
        }
        $.post('sendMessage.php', { username, message }, (response) => {
            $('#chatInput').val('');
            console.log(response); // Or use DOM to display message
        });
    });

    // Set an interval to fetch messages every 1000 milliseconds (1 second)
    setInterval(function() {
        $.getJSON('getMessages.php', (messages) => {
            $('#messages').empty();
            messages.forEach((msg) => {
                $('#messages').append(`<div><b>${msg.username}</b>: ${msg.message}</div>`);
            });
        });
    }, 1000);

    // Bind input event to dynamically change the input style
    $('#chatInput').on('input', function() {
        if (this.value.length > 0) {
            $(this).css('background-color', '#aff');
        } else {
            $(this).css('background-color', '#ffa');
        }
    });

    // Function to validate message input
    function validateInput(input) {
        return input.trim().length > 0;
    }
}); */
