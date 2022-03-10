var tIn, tOut;

function mainwin(soo) {
    var obj = document.createElement('div');
    obj.className = 'popup__overlay';
    obj.style.zIndex = 10000;
    var dialog_wrapper = obj.dialog_wrapper = document.createElement('div');
    dialog_wrapper.className = 'popup'
    var text_div = obj.text = obj.dialog_wrapper.text = document.createElement('div');
    text_div.className = 'popup__dialog-text'
    text_div.innerHTML = soo;
    dialog_wrapper.appendChild(text_div);
    obj.appendChild(dialog_wrapper);

    var dialog = obj.dialog = document.createElement('div');
    dialog.className = 'popup__close';
    dialog.onclick = function () {
        popupClose(obj)
    };
    dialog.innerHTML = 'X';
    dialog_wrapper.appendChild(dialog);
    obj.style.display = 'block';
    popupIn(1, obj);
}

function popupClose(wrap) {
    popupOut(0, wrap);
}


function popupIn(x, wrap) {
    var op = (wrap.style.opacity) ? parseFloat(wrap.style.opacity) : 0;
    document.body.appendChild(wrap);
    if (op < x) {
        clearInterval(tOut);
        op += 0.05;
        wrap.style.opacity = op;
        tIn = setTimeout(function () {
            popupIn(x, wrap);
        }, 50);
    }
}

function popupOut(x, wrap) {
    var op = (wrap.style.opacity) ? parseFloat(wrap.style.opacity) : 0;
    if (op > x) {
        clearInterval(tIn);
        op -= 0.05;
        wrap.style.opacity = op;
        tOut = setTimeout(function () {
            popupOut(x, wrap);
        }, 100);
    }
    if (wrap.style.opacity == x) {
        wrap.style.display = 'none';
    }
}

function soob(head, body, top, intim, outtim) {
    $("<div  id='info_message' style=' width:400px; z-index: 1000; position: absolute; top:" + top + ";left:507px;'>" +
        "<div class='popup' style='width: 90%;  margin: 5px auto;padding: 12px; '><div " +
        "<p style='padding: 5px; '><strong>" + head + "</strong>&nbsp;&nbsp;&nbsp;" + body + "</p></div></div></div>").appendTo("#soo");
    $('#info_message').hide();
    $('#info_message')
        .fadeIn(intim,
            function () {
            })
        .fadeOut(outtim,
            function () {
                $(this).remove();
            });
}
