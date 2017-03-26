window.onload = function onLoad() {



    var first = new ProgressBar.Line('#progress-bar-first', {
        strokeWidth: 4,
        easing: 'easeInOut',
        duration: 6000,
        color: '#d24ba8',
        trailColor: '#eee',
        trailWidth: 1,
        svgStyle: {width: '100%', height: '100%'},
            from: {color: '#FFEA82'},
        to: {color: '#ED6A5A'},
        step: (state, bar) => {
            // bar.setText("Kraków - Paryż " + Math.round(bar.value() * 100) + ' %');
            bar.setText("Kraków - Paryż");
        }
    });

    $(window).scroll(function () {
        var hT = $('#other').offset().top,
            hH = $('#other').outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();


        if (wS > ((hT + hH - wH))) {
            first.animate(1.0);  // Number from 0.0 to 1.0


        }

    });

}















