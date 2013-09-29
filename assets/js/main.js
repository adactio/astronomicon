document.addEventListener('DOMContentLoaded', function() {
    E.init();
});


var E = {
    init: function(){
        //globals
        el = document.getElementById('result');
        song = el.getAttribute('data-song');
        player = document.getElementById('player');

        //hide player
        player.style.display="none"

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

                        player.style.display="block"
        
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

        el.onclick = function(e) {
            R.player.play({source: src});
            el.style.display='none';
            indicator.style.display='block';
            indicator.className += ' is-playing';
            e.preventDefault();
        };
    }
}

