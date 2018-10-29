function filling_select(){
    var tempObj = document.getElementById("field_size");
    for (i = 3; i <= 20; i++) {
        tempObj.options[tempObj.options.length] = new Option(i, i);
    }
}

function change_select(){

    var objSel = document.getElementById("chars_to_win");
    objSel.options.length = 0;

    var e = document.getElementById("field_size");
    var value = e.options[e.selectedIndex].value;

    for (i = 3; i <= value; i++) {
        objSel.options[objSel.options.length] = new Option(i, i);
    }

    var temp = e.offsetTop;

}