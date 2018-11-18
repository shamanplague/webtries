function filling() {

    if (deck_number == 0) {
        document.write('Игра начинается!');
        setTimeout(function () {document.location.href = '/battleship/battleship.php';}, 2000);
        return;
    }

    document.write("<input type='checkbox' name='vertical'><label for='vertical'>Вертикальное размещение</label><br>");

    for (i = 0; i < 10; i++) {
        document.write('<br>');
        for(j = 0; j < 10; j++) {
            var index = String(i) + String(j);
            document.write("<a name='" + index +
                "' href='/battleship/positioning.php?x="+ i + "&y=" + j +
                "'><img id = '" +index + "' width='30' onmouseout='outOfField(this, deck_number)' onmouseover='shipPlacing(this, deck_number)'></a> ");

            switch (json_array[i][j]) {
                case 0: makeBlue(document.getElementById(index));break;
                case 1: makeYellow(document.getElementById(index));break;
            }
        }
    }
}

function playView() {

}

function shipPlacing(obj) {

    if (document.getElementsByName('vertical')[0].checked) {

        var row = Number(obj.id.substring(0, 1));
        var col = obj.id.substring(1, 2);

        var available = isAvailable(obj, true);
        if (!available) document.getElementsByName(obj.id)[0].href='/battleship/positioning.php?';

        for (i = 0; i < deck_number; i++) {
            var str = '';
            if (row + i > 9) return;
            else str += String(row + i);
            str += String(col);
            if (available) {
                document.getElementsByName(str)[0].href += '&v=true';
                makeGreen(document.getElementById(str));
            }
            else {
                makeRed(document.getElementById(str));
            }

        }

    }

    else {

        var row = obj.id.substring(0, 1);
        var col = Number(obj.id.substring(1, 2));

        var available = isAvailable(obj, false);
        if (!available) document.getElementsByName(obj.id)[0].href='/battleship/positioning.php?';


        for (i = 0; i < deck_number; i++) {
            var str = String(row);
            if (col + i > 9) return;
            else str += String(col + i);
            if (available){
                makeGreen(document.getElementById(str));
            }
            else
            {
                makeRed(document.getElementById(str));
            }

        }

    }
}

function outOfField(obj) {

    if(document.getElementsByName('vertical')[0].checked) {

        var row = Number(obj.id.substring(0, 1));
        var col = obj.id.substring(1, 2);
        var i = 0;

        while (i < deck_number && row + i < 10){

            var str = '';
            str += String(row + i);
            str += String(col);
            var current_cell = document.getElementsByName(str)[0];
            current_cell.href = current_cell.href.replace('&v=true', '');
            if(current_cell.href.substring(current_cell.href.indexOf('?'))  == '?')
                current_cell.href += 'x=' + row + '&y=' + col;
            restoreColor(document.getElementById(str));

            i++;
        }

    }

    else

    {

        var row = obj.id.substring(0,1);
        var col = Number(obj.id.substring(1,2));
        var i = 0;

        while (i < deck_number && col + i < 10){

            var str = String(row);
            str += String(col + i);
            var current_cell = document.getElementsByName(str)[0];
            if(current_cell.href.substring(current_cell.href.indexOf('?'))  == '?')
                current_cell.href += 'x=' + row + '&y=' + col;
            restoreColor(document.getElementById(str));

            i++;
        }

    }
}

function isAvailable(object, verticlal) {

    var row = Number(object.id.substring(0, 1));
    var col = Number(object.id.substring(1, 2));

    var start_point_x = row - 1;
    var start_point_y = col - 1;

    console.log('row col ' + row + ' ' + col);

    if (verticlal){

        for (y = start_point_y; y < start_point_y + 3; y++){
            for (x = start_point_x; x < start_point_x + deck_number + 2; x++){
                if (x < 0 || y < 0 || x == 10 || y == 10) continue;
                if (x > 10|| y > 10) return false;
                if (json_array[x][y] == 1) return false;
                //console.log('x=' + x + 'y=' + y + ' vertical');
                //console.log(json_array[x][y]);
            }
        }


    }

    else

    {

        for (x = start_point_x; x < start_point_x + 3; x++){
            for (y = start_point_y; y < start_point_y + deck_number + 2; y++) {
                if (x < 0 || y < 0 || x == 10 || y == 10) continue;
                if (x > 10 ||y > 10) return false;
                //console.log(json_array[x][y]);
                if (json_array[x][y] == 1) return false;
                //console.log('x=' + x + 'y=' + y + ' horizontal');
                //console.log(json_array[x][y]);

            }
        }

    }

    return true;

}

function makeRed(object) {
    object.src = 'img/red.png';
}

function makeBlue(object) {
    object.src = 'img/blue.png';
}

function makeGreen(object) {
    object.src = 'img/green.png';
}

function makeYellow(object) {
    object.src = 'img/yellow.png';
}

function restoreColor(object) {
    var row = Number(object.id.substring(0, 1));
    var col = Number(object.id.substring(1, 2));

    switch (json_array[row][col]) {
        case 0: makeBlue(object);break;
        case 1: makeYellow(object);break;
    }
}