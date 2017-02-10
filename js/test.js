window.onload = (function () {
    var res = document.getElementsByClassName('resume');

    for (var i = 0; i < res.length; i++) {
        res[i].addEventListener('click', function (e) {
            console.log(e);
            var elem;
            if (e.target.className == 'vignette') {
                elem = e.target.parentElement
            } else {
                elem = e.target
            }
            resetRes()
            elem.className = 'visionne';
        })
    }

    function resetRes() {
        var res = document.getElementsByClassName('visionne');
        for (var i = 0; i < res.length; i++) {
            res[i].className = 'resume';
        }
    }
});
