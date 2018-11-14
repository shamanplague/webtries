function filling() {

    var count = 0;

    for (i = 0; i < 10; i++) {
        document.write('<br>');
        for(j = 0; j < 10; j++) {
            var index = String(i) + String(j);
            document.write("<input type=\"image\" name=\"" + index + "\" width=\"30\" onmouseout=\"outOfField(this)\" onmouseover='shipPlacing(this)'> ");

            switch (json_array[i+j]) {
                default: makeBlue(document.getElementsByName(index)[0]);break;
            }
        }
    }
}

function outOfField(obj) {

    var deck_number = 4;

    //makeAble(obj);

    if(document.getElementsByName('vertical')[0].checked) {

        var row = Number(obj.name.substring(0, 1));
        var col = obj.name.substring(1, 2);

        // for (i = 0; i < deck_number; i++) {
        //     if (row + i > 9) return;
        //     else {
        //         var str = '';// = String(row);
        //         str += String(row + i);
        //         str += String(col);
        //         makeAble(document.getElementsByName(str)[0]);
        //         makeBlue(document.getElementsByName(str)[0]);
        //     }
        // }
        // через for

        var i = 0;

        while (i < deck_number && row + i < 10){

            var str = '';// = String(row);
            str += String(row + i);
            str += String(col);
            //makeAble(document.getElementsByName(str)[0]);
            makeBlue(document.getElementsByName(str)[0]);

            i++;
        }


    }

    else

    {

        var row = obj.name.substring(0,1);
        var col = Number(obj.name.substring(1,2));

        // for (i = 0; i < deck_number ; i++) {
        //     if (col + i > 9) return;
        //     else {
        //         var str = String(row);
        //         str += String(col + i);
        //         //makeAble(document.getElementsByName(str)[0]);
        //         //console.log('ololo');
        //         makeBlue(document.getElementsByName(str)[0]);
        //     }
        // }

        var i = 0;

        while (i < deck_number && col + i < 10){

            var str = String(row);
            str += String(col + i);
            //makeAble(document.getElementsByName(str)[0]);
            makeBlue(document.getElementsByName(str)[0]);

            i++;
        }

    }
}

function shipPlacing(obj) {

    var deck_number = 4;

    if (document.getElementsByName('vertical')[0].checked) {

        var row = Number(obj.name.substring(0, 1));
        var col = obj.name.substring(1, 2);

        for (i = 0; i < deck_number; i++) {
            var str = '';
            if (row + i > 9) return;
            else str += String(row + i);
            str += String(col);
            if (row + deck_number > 10) {
                makeRed(document.getElementsByName(str)[0]);
                //makeDisable(document.getElementsByName(str)[0]);
            }
            else
                makeGreen(document.getElementsByName(str)[0]);
        }

    }

    else {

        var row = obj.name.substring(0, 1);
        var col = Number(obj.name.substring(1, 2));

        for (i = 0; i < deck_number; i++) {
            var str = String(row);
            if (col + i > 9) return;
            else str += String(col + i);
            if (col + deck_number > 10){
                makeRed(document.getElementsByName(str)[0]);
                //makeDisable(document.getElementsByName(str)[0]);
            }
            else
                makeGreen(document.getElementsByName(str)[0]);
        }

    }
}

function makeRed(object) {
    object.src = 'battleship/img/red.png';
}

function makeBlue(object) {
    object.src = 'battleship/img/blue.png';
}

function makeGreen(object) {
    object.src = 'battleship/img/green.png';
}

function makeDisable(object) {
    object.disabled = true;
}

function makeAble(object) {
    object.disabled = false;
}