let imageWidth = 350;
let noImages = 10;
let imageSpacing = 10;

/**
 * Sliding functionality
 */

function slide() {
    $("li").animate({"left": "+=0.5px"}, 5, update);
}

function update() {
    let left = $(this).offset().left;
    if (left >= imageWidth * (noImages - 1) + imageSpacing * noImages) {
        $(this).css("left", -imageWidth);
    }
    slide();
}


/**
 * Large image functionality
 */
function createHaze() {
    let haze = $("<div></div>").
                    css({
                        "width": imageWidth * noImages + "px",
                        "height": "100%",
                        "background": "rgba(0, 0, 0, 0.4)",
                        "position": "absolute",
                        "left": "0px",
                        "top": "0px"
                    });

    return haze;
}

function createLargeImage() {;    
    let largeImage = $("<img/>").
                        css({
                            "position": "fixed",
                            "left": "22%",
                            "top": "3%",
                            "width": "1000px",
                            "height": "900px",
                            "border": "5px double black"
                        });     

    return largeImage;
}

$(document).ready(function() {
    let position = -imageWidth;

    $("li").each(function() {
        $(this).css("left", position);
        position += imageWidth + imageSpacing;
    });

    // functionality related to the selected image from the slider
    
    let largeImage = createLargeImage().attr("id", "largeSelectedImage");
    let haze = createHaze().attr("id", "grayHaze").append(largeImage);

    $("body").after(haze); 
    $("#grayHaze").css("display", "none");

    $("ul > li > img").on("click", function() {
        
        $("li").stop(true, false);
        
        let imagePath = $(this).attr("src");
        largeImage.attr("src", imagePath);

        $("#grayHaze").css("display", "block");

        $("#largeSelectedImage").on("click", function() {
            $("#grayHaze").css("display", "none");
            slide();
        });

    });
    
    slide();
    
});


