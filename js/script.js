// SEARCH UX IMPROVEMENT
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("searchForm");
    const input = document.getElementById("searchInput");

    if (form) {
        form.addEventListener("submit", function () {

            // optional loading effect
            document.body.style.opacity = "0.5";

        });
    }

    // ENTER KEY SUPPORT (extra safety)
    if (input) {
        input.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                form.submit();
            }
        });
    }

});