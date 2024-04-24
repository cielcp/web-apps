

$(document).ready(function() {
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
});
