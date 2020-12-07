function showEditBox() {

    var container = document.getElementById("EditBoxContainer");

    if (container) {
        var area = document.createElement("textarea");
        area.id = "MyEditBox";
        area.setAttribute("class", "form-control mb-5");
        container.appendChild(area);
    } else {
        alert("You have no EditBoxContainer!");
    }
}