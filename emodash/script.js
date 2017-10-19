// Event listener for the submit button.
$('#submit').click(function() {
var emotions = '';
var checkedValues = $('input:checkbox:checked').map(function() {
	emotions = emotions + ',' + this.value;
}).get();
    $.ajax({
        url: 'write.php',
        type: 'POST',
        data: {
			emotion: emotions,
            filename: $('#filename').val()
        },
        success: function(msg) {
			location.reload();
        }               
    });
});

// Window Load event. Initialize the audioplayer and start playing automatically. 
$(window).load(function() {
var audioPlayer = document.getElementById('player');
audioPlayer.play();
});