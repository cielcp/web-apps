// uhhhh fix html button names w this
$(document).ready(function() {
    const chatApp = {
        init: function() {
            $('#sendButton').on('click', this.sendMessage);
            setInterval(this.getMessages, 1000);
            $('#chatInput').on('input', this.inputStyleChange);
        },
        sendMessage: () => {
            const message = $('#chatInput').val();
            const username = $('#username').val();
            if (!chatApp.validateInput(message)) {
                alert('Message cannot be empty');
                return;
            }
            $.post('sendMessage.php', { username, message }, (response) => {
                $('#chatInput').val('');
                console.log(response); // Or use DOM to display message
            });
        },
        getMessages: function() {
            $.getJSON('getMessages.php', (messages) => {
                $('#messages').empty();
                messages.forEach((msg) => {
                    $('#messages').append(`<div><b>${msg.username}</b>: ${msg.message}</div>`);
                });
            });
        },
        validateInput: input => input.trim().length > 0,
        inputStyleChange: function() {
            if (this.value.length > 0) {
                $(this).css('background-color', '#aff');
            } else {
                $(this).css('background-color', '#ffa');
            }
        }
    };

    // Initialize chat application
    chatApp.init();
});
