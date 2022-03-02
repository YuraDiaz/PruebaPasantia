$(document).ready(function () {
    inicio();

});

var inicio = () => {

    $("#inicio").submit(function (e) {
        e.preventDefault();

        let datos = new FormData($("#inicio")[0]);
        $.ajax({
            type: "POST",
            url: "./controller/login.php",
            data: datos,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
            }
        });
    });
}