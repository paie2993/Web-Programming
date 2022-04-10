let inputTextarea = document.querySelector("#input-textarea");
let sortButton = document.querySelector("#trigger-button");
let outputContainer = document.querySelector("#output-div");

function bubbleSort(numberArray) {
    if (numberArray.length <= 1) {
        return numberArray;
    }

    for (let i = 0; i < numberArray.length - 1; i++) {
        for (let j = 0; j < numberArray.length - i - 1; j++) {
            if (numberArray[j] > numberArray[j + 1]) {
                let aux= numberArray[j];
                numberArray[j] = numberArray[j + 1];
                numberArray[j + 1] = aux;
            }
        }
    }

}

function arrayToTable(arrayOfNumbers) {
    let noColumns = 5;
    let noRows = Math.ceil(arrayOfNumbers.length / 5);

    let outputTable = document.createElement("table");
    
    for (let i = 0; i < noRows; i++) {
        
        outputTable.appendChild(document.createElement("tr"));
        currentRow = outputTable.lastChild;
        
        for (let j = 0; j < noColumns; j++) {
            let currentData = document.createElement("td");
            if (i * noColumns + j < arrayOfNumbers.length) {
                currentData.innerText = arrayOfNumbers[i * noColumns + j];
            }
            currentData.style.border = "1px solid #B08C8C"  
            currentRow.appendChild(currentData);
        }
    
    }

    outputTable.style.color = "inherit";
    outputTable.style.fontSize = "inherit"; 
    outputTable.style.width = "100%";
    outputTable.style.height = "auto";
    outputTable.style.border = "2px solid #B08C8C";
    outputTable.style.textAlign = "center";

    return outputTable;

}

/**
 *
 */
sortButton.addEventListener("click", function() {

    let textareaContent = inputTextarea.value;
    // guard agains empty input
    if (textareaContent.length === 0) {
        alert("Empty text area");
        return;
    }

    let arrayOfStrings = textareaContent.split(",");
    let arrayOfNumbers = new Array(arrayOfStrings.length);

    for (let i = 0; i < arrayOfNumbers.length; i++) {
        numberValue = Number.parseInt(arrayOfStrings[i]);
        // guard agains non-numeric values in the textarea
        if (Number.isNaN(numberValue)) {
            let errorMsg = "Non-numeric value in the input: " + arrayOfStrings[i]; 
            alert(errorMsg);
            return;
        }
        arrayOfNumbers[i] = numberValue;
    }

    // sorting the array
    bubbleSort(arrayOfNumbers);

    // creating the output table
    while (outputContainer.hasChildNodes()) {
        outputContainer.removeChild(outputContainer.firstChild);
    }

    let outputTable = arrayToTable(arrayOfNumbers);
    outputContainer.appendChild(outputTable);

});

