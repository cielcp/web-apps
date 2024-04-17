console.log("uh did this connect");

$(document).ready(function () {
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


/** -------------------------- ajax stuff idk -------------------------- */

/**
 * This function will query the CS4640 server for a new set of categories.
 *
 * It makes use of AJAX and Promises to await the result.  We won't discuss
 * promises in detail, so you're welcome to review this code for more
 * details.  However, essentially we need the browser to send an AJAX query
 * to our API and then wait for a reply.  If it just waits, then the browser
 * tab will appear to be frozen briefly while the HTTP request is taking place.
 * Therefore, we send the request with a Promise that awaits the results.  When
 * the response comes back from the server, the promise will return the result
 * to our getRandomCategories() function and that will call your function.  This happens
 * asynchronously, so you should treat your function like you would an event
 * handler.
 */
function queryCategories() {}

/**
 * This is the function you should call to request a new word.
 * It takes one parameter: a callback function.  The function
 * passed in (i.e., a function you write) should take one
 * parameter (the new categories provided by the server) and handle the
 * setup of your new game.  For example, if you write a function
 * named "setUpNewGame(newCategories)", then in your event handler for a new
 * game, you should call this function as:
 *     getRandomCategories(setUpNewGame);
 * Our getRandomCategories function will wait for the server to provide
 * a new set of categories, and then it will call **your** function, passing in
 * the categories as an object, so that your function can continue setting up
 * the new game.
 */
async function getRandomCategories(callback) {}
