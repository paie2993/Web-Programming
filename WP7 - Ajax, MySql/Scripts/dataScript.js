$("#fetchButton").click(function() {
    $.ajax({
        type: "GET",
        url: "../PhpScripts/getAllRecipes.php",
        success: function(result, status) {
            $("#displayDiv").html(result);
        }
    });
});