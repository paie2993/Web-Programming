let previousFilterType = "";
let previousFilterValue = "";
function updateDisplayedFilter(filterType, filterValue) {
    if (previousFilterType !== "" && previousFilterValue != "") {
        $("#previousFilter").html("<p>Previous filter: " + previousFilterType + " = " + previousFilterValue);
        $("#previousFilter").css("visibility", "visible");
    }
    previousFilterType = filterType;
    previousFilterValue = filterValue;
}

$("#allButton").click(function() {
    $.ajax({
        type: "GET",
        url: "../PhpScripts/getAllRecipes.php",
        success: function(result, status) {
            $("#browseResults").html(result);
        }
    });
});

$("#idSubmit").click(function() {
    $columnValue = $("#idSearch").val();
    console.log($columnValue);
    $.ajax({
        type: "GET",
        url: "../PhpScripts/getRecipesById.php",
        data: {column: $columnValue},
        success: function(result, status) {
            $("#browseResults").html(result);
            $filterType = "id";
            updateDisplayedFilter($filterType, $columnValue);
        }
    });
});

$("#authorSubmit").click(function() {
    $columnValue = $("#authorSearch").val();
    console.log($columnValue);
    $.ajax({
        type: "GET",
        url: "../PhpScripts/getRecipesByAuthor.php",
        data: {column: $columnValue},
        success: function(result, status) {
            $("#browseResults").html(result);
            $filterType = "author";
            updateDisplayedFilter($filterType, $columnValue);
        }
    });
});

$("#nameSubmit").click(function() {
    $columnValue = $("#nameSearch").val();
    console.log($columnValue);
    $.ajax({
        type: "GET",
        url: "../PhpScripts/getRecipesByName.php",
        data: {column: $columnValue},
        success: function(result, status) {
            $("#browseResults").html(result);
            $filterType = "name";
            updateDisplayedFilter($filterType, $columnValue);
        }
    });
});

$("#typeSubmit").click(function() {
    $columnValue = $("#typeSearch").val();
    console.log($columnValue);
    $.ajax({
        type: "GET",
        url: "../PhpScripts/getRecipesByType.php",
        data: {column: $columnValue},
        success: function(result, status) {
            $("#browseResults").html(result);
            $filterType = "type";
            updateDisplayedFilter($filterType, $columnValue);
        }
    });
});

// $("#descSubmit").click(function() {
//     $columnValue = $("#descSearch").val();
//     console.log($columnValue);
//     $.ajax({
//         type: "POST",
//         url: "../PhpScripts/getRecipesByDesc.php",
//         data: {column: $columnValue},
//         success: function(result, status) {
//             $("#browseResults").html(result);
//             updateDisplayedFilter($columnValue);
//         }
//     });
// });