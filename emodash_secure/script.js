// Event listener for the submit button.
$('#submit').click(function() {
var emotions = '';
var checkedValues = $('input:checkbox:checked').map(function() {
	emotions = emotions + ',' + this.value;
}).get();
if(emotions.length > 1)
{
	//alert(emotions);
	if(!emotions.includes('anger') && !emotions.includes('disgust') && !emotions.includes('sadness') && !emotions.includes('fear') && !emotions.includes('surprise') && !emotions.includes('opluchting') && !emotions.includes('happiness') && !emotions.includes('neutral'))
	{
		alert("Please select an emoticon from the box before submitting.");
	}
	else
	{
		$.ajax({
			url: 'write.php',
			type: 'POST',
			data: {
				emotion: emotions,
				filename: $('#filename').val(),
				data_file: $('#data_file').val()
			},
			success: function(msg) {
				location.reload();
			}               
		});
	}
}
else
{
	alert("Please select an emoticon before submitting.");
}
	
});

// Event listener for the silent button.
$('#silent').click(function() {
var emotions = '';
var checkedValues = $('input:checkbox:checked').map(function() {
	emotions = emotions + ',' + this.value;
}).get();
if(emotions.length < 1)
{
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
}
else
{
	alert("You cannot perform this action when an emoticon is selected.");
}
	
});

// Window Load event. Initialize the audioplayer and start playing automatically. 
$(window).load(function() {
var audioPlayer = document.getElementById('player');
audioPlayer.play();
});