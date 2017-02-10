window.onload = (function () {
    var res = document.getElementsByClassName('resume');

    for (var i = 0; i < res.length; i++) {
        res[i].addEventListener('click', function (e) {
            resetRes()
            e.target.className = 'visionne';
        })
    }

    function resetRes() {
        var res = document.getElementsByClassName('visionne');
        for (var i = 0; i < res.length; i++) {
            res[i].className = 'resume';
        }
    }
});
