function showEditBox() {

    var container = document.getElementById("EditBoxContainer");

    if (container) {
        var area = document.createElement("textarea");
        area.id = "MyEditBox";
        area.style.width = "1050px";
        area.style.height = "100px";
        container.appendChild(area);
    } else {
        alert("You have no EditBoxContainer!");
    }
}