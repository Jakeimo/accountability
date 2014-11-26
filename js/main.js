//Load menu
var menuIn = true;
var path = window.location.pathname.split("/");
var menuLink;
if(path[2] === "view"){
	menuLink = "<div id='menuLink'> <a href='index.html' id='view'>Submit Data</a> </div>";
} else {
	menuLink = "<div id='menuLink'> <a href='view.html' id='view'>View Data</a> </div>";
}
$("#menu").click(function() {
    if (menuIn) {
        $("#menu").animate({
            "right": "80px"
        }, "slow");

        $("#menu").css("border-right", "0");
        $("#menu").css("border-left", "15px solid black");

        $("#menu").append(menuLink);
    } else {
        $("#menu").animate({
            "right": "15px"
        }, "slow");

        $("#menu").css("border-left", "0");
        $("#menu").css("border-right", "15px solid black");

        $("#view").remove();
    }
    menuIn = !menuIn;
});
