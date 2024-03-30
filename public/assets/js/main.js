function hide() {
    let done = document.querySelector('.done')
    done.classList.add('hide')
}
setTimeout(() => {
    hide()
}, 8000);
// classroom page checkbok
// 25:13 video 10
function CheckAll(className, elem) {
    var elements = document.getElementsByClassName(className);
    var l = elements.length;
    if (elem.checked) {
        for (var i = 0; i < l; i++) {
            elements[i].checked = true
        }
    }
     else {
        for (var i = 0; i < l; i++) {
            elements[i].checked = false
        }
    }
}
