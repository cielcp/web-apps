console.log("uh did this connect");

$(document).ready(function() {
    // Event handler for form submission
    $('#setupForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Get the values of rows and columns from the form
        var size = $('#size').val();

        // Make an AJAX request to setup.php
        $.ajax({
            url: '/opt/src/hw7/setup.php',
            method: 'GET',
            data: { rows: size, columns: size }, // Send the form data to the server
            success: function(data) {
                // Handle the successful response from the server
                console.log('Starting positions:', data);

                // Process the starting positions and display the game board
                createBoard(size, size, data);

                // Hide the "You've won!" message if it's visible
                $('#message').hide();
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error('Error:', error);
            }
        });
    });

//});




//$(document).ready(function () {
// function lightsOut() {
  var currentGame = null;

  // function to create a board of the input size
  function createBoard(rows, columns, startingPositions) {
    var $boardContainer = $("#boardContainer");
    $boardContainer.empty();

    for (var i = 1; i <= rows; i++) {
      var $row = $('<div class="row"></div>');
      for (var j = 1; j <= columns; j++) {
        var $box = $('<div class="box col"></div>');
        if (
          startingPositions.some(
            (position) => position[0] === i && position[1] === j
          )
        ) {
          $box.addClass("on");
        }
        $box.data("row", i);
        $box.data("column", j);
        $row.append($box);
      }
      $boardContainer.append($row);
    }
  }

  // function to determine if the game has been won
  function checkWin() {
    return $(".box.on").length === 0;
  }

  // function to toggle the lights of the select boxes
  function toggleLights(row, column) {
    $(".box").each(function () {
      var $box = $(this);
      var boxRow = $box.data("row");
      var boxColumn = $box.data("column");

      if (
        (boxRow === row && Math.abs(boxColumn - column) === 1) ||
        (boxColumn === column && Math.abs(boxRow - row) === 1)
      ) {
        $box.toggleClass("on");
      }
    });
  }

  $("#setupForm").submit(function (event) {
    event.preventDefault();
    var boardSize = parseInt($("#boardSize").val());
    $.ajax({
      url: "setup.php",
      method: "GET",
      data: { rows: boardSize, columns: boardSize },
      success: function (data) {
        createBoard(boardSize, boardSize, data);
        $("#message").hide();
        currentGame = {
          rows: boardSize,
          columns: boardSize,
          startingPositions: data,
        };
      },
    });
  });

  $(document).on("click", ".box", function () {
    if (currentGame !== null && !checkWin()) {
      var row = $(this).data("row");
      var column = $(this).data("column");
      toggleLights(row, column);
      if (checkWin()) {
        $("#message").show();
      }
    }
  });

  $("#newGameBtn").click(function () {
    $("#setupForm").submit();
  });
});
