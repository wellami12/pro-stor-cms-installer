(function () {
    'use strict'
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style')
        msViewportStyle.appendChild(
            document.createTextNode(
                '@-ms-viewport{width:auto!important}'
            )
        );
        document.head.appendChild(msViewportStyle)
    }
}());

function showError(errorMessage, error) {
    console.error(errorMessage, error.status);
}

$(document).ready(function () {
    $(".start-install").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/installation.php",
            data: {
                "step1": "check-requirements"
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                var errorMessage;
                switch (error.status) {
                    case 404:
                        errorMessage = "Произошла ошибка при подключение к скрипту установки (Файл не найден). )";
                        break;
                }
                showError(errorMessage, error);
            }
        });
    });
});