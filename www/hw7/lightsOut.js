// console.log("uh did this connect");

$(document).ready(function() {

  // Event handler for form submission
  $('#setupForm').submit(function(event) {
      event.preventDefault(); // Prevent the default form submission behavior

      // Get the values of rows and columns from the form
      var size = $('#size').val();

      // Make an AJAX request to setup.php
      $.ajax({
          url: 'setup.php',
          method: 'GET',
          data: { size: size }, // Send the size parameter to the server
          success: function(data) {
              // Handle the successful response from the server
              console.log('Starting positions:', data);

              // Process the starting positions and create the game board
              createBoard(size, data);
              // Hide the setup section
              // $('#setup').hide();
              // Hide the "You've won!" message if it's visible
              // $('#message').hide();
              
          },
          error: function(xhr, status, error) {
              // Handle any errors that occur during the AJAX request
              console.error('Error:', error);
          }
      });
  });

  // function to create a board of the input size
  function createBoard(size, startingPositions) {
    var $boardContainer = $("#boardContainer");
    $boardContainer.empty();

    for (var i = 1; i <= size; i++) {
      var $row = $('<div class="row"></div>');
      for (var j = 1; j <= size; j++) {
        var $col = $('<div class="col"></div>');
        var $box = $('<div class="box"></div>');
        if (
            startingPositions.some(
                (position) => position[0] === i && position[1] === j
            )
        ) {
          // turn the random startingpositions on
            $box.addClass("on");
        }
        // set the data attribute of the box div for game logic stuff
        $box.data("row", i);
        $box.data("column", j); 
        $col.append($box);
        $row.append($col);
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

      if ((boxRow === row && boxColumn === column) ||
        (boxRow === row && Math.abs(boxColumn - column) === 1) ||
        (boxColumn === column && Math.abs(boxRow - row) === 1)
      ) {
        $box.toggleClass("on");
      }
    });
  }

  // event handler for box click
  $(document).on("click", ".box", function () {
    if (!checkWin()) {
      var row = $(this).data("row");
      var column = $(this).data("column");
      toggleLights(row, column);
      if (checkWin()) {
        $("#message").show();
      }
    }
  });

  // event handler for new game button click
  $("#newGameBtn").click(function () {
    // Reset the form and show setup
    $('#setup').show();
    $('#setupForm')[0].reset();
    // Empty the board container
    $('#boardContainer').empty();
    // Hide the win message
    $('#message').hide();
  });
});
