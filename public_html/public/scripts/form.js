$(function(){
	$('form').submit(function(event){
		
		event.preventDefault();
		var json;
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: $(this).serialize(),
			cache: false,
			success: function (data) {
				if (data === '') {
					location.reload();
				} else {
					json = jQuery.parseJSON(data);
	
					if (json.url) {
						window.location.href = json.url;
					} else {
						alert(json.message);
					}
				}
			}
		});
	});
});