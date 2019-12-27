$(function(){
	
	//Костыль из-за нехватки времени
	var sort = $("#sortSelect");
	var current = sort.data('current')
	$('#sortSelect option').each(function() {
    	if ($(this).val() == current) {
    		sort.val(current);
    		return false;
    	}
	});
	
	sort.change(function(event){
		if ($(this).val() === '') {
			window.location.search = '';
		} else {
			window.location.search = '?sort='+$(this).val();
		}
	});
	
	$('#modalTaskEdit').on('show.bs.modal', function (event) {
		
	  var button = $(event.relatedTarget);
	  var id = button.parent().data('id');
	  var text = button.parents('.card').find(".card-text").text();
	  var modal = $(this);
	  
	  modal.find('#taskId').text(id);
	  modal.find('.modal-body input[name = "id"]').val(id);
	  modal.find('.modal-body textarea').val(text);
	  
	});
	
	$('.doneBtn').click(function(event){
		
		var id = $(this).parent().data('id');
		
		$.ajax({
			type: 'POST',
			url: '/task/done/',
			data: {'id' : id},
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
	
	$('.delBtn').click(function(event){
		
		var id = $(this).parent().data('id');
		
		$.ajax({
			type: 'POST',
			url: '/task/del',
			data: {'id' : id},
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