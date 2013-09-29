R.ready(function() {
    var el = document.getElementById('result'),
        song = el.getAttribute('data-song');
    console.log(song);
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

          console.log(response);

        } else {
          console.log(response);
        }
    },

    error: function(response) {
        console.log("error: " + response.message);
        }
    });
});