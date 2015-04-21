$(document).ready(function(){
	var sfield = $("#s");
	var container = $("#photos");
	var timer;
	
	function instaSearch() {
		$(sfield).addClass("loading");
		$(container).empty();
		
		$.ajax({
			type: 'POST',
			url: 'php/ig_query.php',
			data: "query=hifromwork",
			success: function(data){
				$(sfield).removeClass("loading");
				
				$.each(data, function(i, item) {
					var ncode = '<div class="pic"><a href="'+data[i].url+'" target="_blank"><img src="'+data[i].src+'"></a></div>';
					$(container).append(ncode);
					console.log('data[i].userID: ' + data[i].userID);
				});
			},
			error: function(xhr, type, exception) { 
				$(sfield).removeClass("loading");
				$(container).html("Error: " + type); 
			}
		});
	}
	
	instaSearch();

});