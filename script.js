$(document).ready(function () {

    // if (typeof jQuery == "undefined") {
    //     alert("jQuery लोड नहीं हुआ!");
    // } else {
    //     alert("jQuery लोड हो गया!");
    // }

    $('#submit-button').on('click', function (e) {
        e.preventDefault(); // Prevent any default behavior
        alert("SBSR000"); // This will now trigger correctly

        var name = $('#exampleInputEmail1').val().trim();
        var password = $('#exampleInputPassword1').val().trim();

        // Add validation or logic here before sending the AJAX request
        if (name === "" || password === "") {
            alert("Please fill in both fields.");
            return; // Exit if validation fails
        }

        let answer = null;
        $.ajax({
            type: 'POST',
            url: 'checkUser.php',
            data: { name: name, password: password },
            success: function (response) {
                answer = JSON.parse(response);
                alert("response: " + response);
                if (answer.success == true) {
                    //Go To Next Page:
                    use(answer.id);
                } else {
                    alert("लॉगिन असफल! " + answer.success);
                }
            },
            // error: function (xhr, status, error) {
            //     $('#message strong i').html('सर्वर से कनेक्ट नहीं हो सका।');
            //     $('#message').css("color", "rgb(243, 53, 53)");
            //     console.error('AJAX Error:', status, error);
            // }
        });
    });
});
function use(id) {
    let form = document.createElement("form");
    form.method = "GET"; 
    form.action = "./do";  

    let input = document.createElement("input");
    input.type = "hidden";
    input.name = "id";
    input.value = id;
   
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}
