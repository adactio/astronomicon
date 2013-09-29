document.addEventListener('DOMContentLoaded', function() {
    E.init();
});


var E = {
    init: function(){
        //globals
        el = document.getElementById('result');
        song = el.getAttribute('data-song');
        player = document.getElementById('player');

        //init rdio
        E.rdio();
    },

    rdio: function(){
        R.ready(function() {
            
            R.request({
                method: 'search',
                content: {
                query: song,
                types: 'Track',
                start: 0,
                never_or: true,
                count: 1,
                extras: 'streamRegions'
            },
                success: function(response) {
                    if (response.result.number_results !== 0){

                        var src = response.result.results[0].key;

                        player.className += ' is-shown'
        
                        E.play(src);

                    } else {
                        
                        return false;
                    }
                },

                error: function(response) {
                    console.log("error: " + response.message);
                }
            });
        });
    },

    play: function(src){
        var el = document.getElementById('control-play'),
            indicator = document.getElementById('indicator');
        
        el.className += ' is-shown';

        el.onclick = function(e) {
            R.player.play({source: src});
            //el.className += ' is-hidden';
            el.style.display = "none";
            indicator.className += ' is-shown-fancy';
            indicator.className += ' is-playing';
            var removeclass = 'is-shown';
            var reg = new RegExp('(\\s|^)' + removeclass + '(\\s|$)');
            el.className = el.className.replace(reg, ' ');
            e.preventDefault();
        };
    }
}

