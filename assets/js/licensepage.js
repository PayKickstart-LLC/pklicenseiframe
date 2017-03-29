$(function(){

	$(".listUsages a").click(function(e){
		e.preventDefault();
		alert("yo!");

		var target = $(e.currentTarget);
		var license_key = target.attr('key');
		var guid = target.attr('guid');

		// Strike through the usage line
		target.parent('div').css('text-decoration', 'line-through');

		$.ajax({
			       type: "POST",
			       url: deactivateAjaxUrl,
			       data: {license_key : license_key, guid : guid},
			       dataType: 'json',
			       success: function(data){
				       console.log(data);
			       }
		       });
	});
});