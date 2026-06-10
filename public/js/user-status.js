$(document).ready(function () {

    // Change user status
    $('.activeUser').on('change', function () {

        var userId = $(this).closest('tr').find('td:first').text();
        var isActive = $(this).is(':checked') ? 'active' : 'inactive';

        $.ajax({
            type: 'POST',
            url: routeChangeUserStatus(userId, isActive),
            data: {
                userId: userId,
                isActive: isActive,
                _token: csrfToken()
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

});



function showPopup(id) {
    let el = document.getElementById("delete-msg-" + id);
    if (el) el.style.display = "block";
}

function closePopup(id) {
    let el = document.getElementById("delete-msg-" + id);
    if (el) el.style.display = "none";
}