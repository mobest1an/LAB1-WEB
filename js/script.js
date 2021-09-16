window.onload = function () {
    window.setInterval(function () {
        const now = new Date();
        let clock = document.getElementById("clock");
        clock.innerHTML = now.toLocaleTimeString();
    }, 1);
};

let element = null;

function validate() {
    const elements = document.getElementsByName("x-change");
    for (let i = 0, len = elements.length; i < len; ++i) {
        if (elements[i].checked)
            element = elements[i].value;
    }

    let xInfo = document.getElementById("x-title");
    if (element == null) {
        xInfo.style.color = "red";
    } else {
        xInfo.style.color = "#536e7b";
    }

    if (validateY() && element != null) {
        addHiddenInput();
        return true;
    } else
        return false;
}

function onInputYCheck() {
    let y = document.getElementById("y-change");
    y.value = y.value.replace(",", ".");

    let yChange = document.getElementById("y-change").value;
    let yInfo = document.getElementById("y-title");

    let Y = Number(yChange);
    if (!isNaN(Y)) {
        if (yChange.length < 18) {
            if (Y > -3 && Y < 5) {
                yInfo.innerHTML = "Введите координату Y:";
                yInfo.style.color = "#536e7b";
            } else {
                yInfo.innerHTML = "Число не соответствует диапазону!";
                yInfo.style.color = "red";
            }
        } else {
            yInfo.innerHTML = "Слишком длинное число!";
            yInfo.style.color = "red";
        }
    } else {
        yInfo.innerHTML = "Это не число!";
        yInfo.style.color = "red";
    }
}

function validateY() {
    let yChange = document.getElementById("y-change").value;
    let yInfo = document.getElementById("y-title");

    if (yChange !== "") {
        let Y = Number(yChange);
        if (!isNaN(Y)) {
            if (yChange.length < 18) {
                if (Y > -3 && Y < 5) {
                    yInfo.innerHTML = "Введите координату Y:";
                    yInfo.style.color = "#536e7b";
                    return true;
                } else {
                    yInfo.innerHTML = "Число не соответствует диапазону!";
                    yInfo.style.color = "red";
                }
            } else {
                yInfo.innerHTML = "Слишком длинное число!";
                yInfo.style.color = "red";
            }
        } else {
            yInfo.innerHTML = "Это не число!";
            yInfo.style.color = "red";
        }
    } else {
        yInfo.innerHTML = "Введите число в диапазоне (-3 ... 5)!";
        yInfo.style.color = "red";
    }
    return false;
}

let lastRequests = save();

function addHiddenInput() {
    let input = document.createElement("input");
    let form = document.getElementById("main-form");

    if (!(lastRequests === "")) {
        input.setAttribute("name", "savedRequests");
        input.setAttribute("value", lastRequests);
        input.setAttribute("type", "hidden");
        form.appendChild(input);
    }
}

document.getElementById("btn-clear").addEventListener("click", clear);

function clear() {
    let title = document.getElementsByClassName("last-results-title").item(0);
    title.innerText = "Таблица очищена";

    let cancel = document.createElement("div");
    cancel.setAttribute("class", "cancel");
    cancel.innerHTML = '<input type="button" id="btn-cancel" class="btn btn-cancel" value="Отмена" onclick="window.location.reload()">';

    title.appendChild(cancel);

    document.getElementById("last-results-table").style.display = "none";

    // let table = document.getElementById("last-results-table");
    // for (let i = table.tBodies[0].rows.length - 1; i >= 0; i--) {
    //     table.tBodies[0].deleteRow(i);
    // }

    let input = document.createElement("input");
    let form = document.getElementById("main-form");

    input.setAttribute("name", "clear");
    input.setAttribute("value", true);
    input.setAttribute("type", "hidden");
    form.appendChild(input);

}

function save() {
    let inputValue = "";

    if (!(document.getElementById("result-table") === null)) {
        let resultTable = document.getElementById("result-table");
        let resultTableElements = resultTable.getElementsByClassName("result-value");
        for (let resultElement of resultTableElements) {
            inputValue += resultElement.innerText + ",";
        }
        inputValue = inputValue.replace(/.$/, ";");
    }

    if (!(document.getElementById("last-results-table") === null)) {
        let savedRequests = document.getElementById("last-results-table").getElementsByClassName("request");
        for (let request of savedRequests) {
            let requestElements = request.getElementsByClassName("parameter");
            for (let element of requestElements) {
                inputValue += element.innerText + ",";
            }
            inputValue = inputValue.replace(/.$/, ";");
        }
        inputValue = inputValue.replace(/.$/, "");
    }

    if (inputValue.charAt(inputValue.length - 1) === ";") {
        inputValue = inputValue.replace(/.$/, "");
    }

    return inputValue;
}
