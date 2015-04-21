// JavaScript Document

$(document).ready(function(){
	$('a#more').click(function(e) {
		e.preventDefault();
		var tag = $(this).data('tag'),
		maxid = $(this).data('maxid');
		
		$.ajax({
			type: 'GET',
			url: 'php/ajax.php',
			data: {
				tag: tag,
				max_id: maxid
			},
			dataType: 'json',
			cache: false,
			success: function(data) {
				console.log('data: ' + data);
			// Output data
				$.each(data.images, function(i, obj) {
					$('#photos').append('<div class="pic"><a href="'+ obj.link +'" target="_blank"><img src="' + obj.standardResURL + '"></a></div>');
				});
				// Store new maxid
				$('#more').data('maxid', data.next_id);
			}
		});
	});
});