
$(document).ready(function () {

	if ($("#review_title").length > 0) {
		var winery_name = $("#winery_name").val();
		$("#review_title")[0].innerHTML = "Review for " + winery_name;
	}
	
	$("#add_winery_review").click(function(){
		var winery_name = $("#winery_name").val();

		window.location = "../add_winery_review.php?winery_name=" + winery_name;

	});

	$("#add_wine_review").click(function(){
		var winery_name = $("#winery_name").val();
		window.location = "../add_wine_review.php?winery_name=" + winery_name;
	})
	$("#submit").click(function(event) {
		var wineryname = $("#winery_name").val();
		var email = $("#email").val();
		var description = $("#description").val();
		var rating = $("#rating").val();
				
		$.ajax({
			type: "POST",
			url: 'submit_winery_review.php',
			data: {'winery_name': winery_name, 'email': email, 'description': description, 'rating': rating},
			success: function (data) {
				window.location = "../winery.php?winery_name=" + wineryname;

			}
		});
		return false;
	});

	$("#submitWineReview").click(function(event) {
		var wine_id = $("#wine_id").val();
		var email = $("#email").val();
		var comment = $("#comment").val();
		var stars = $("#stars").val();
		var winery_name = $("#winery_name").val();
				
		$.ajax({
			type: "POST",
			url: 'submit_wine_review.php',
			data: {'wine_id': wine_id, 'email': email, 'comment': comment, 'stars': stars},
			success: function (data) {
				$('#submit_wine_review')[0].reset();
				window.location = "../winery.php?winery_name=" + winery_name;

			}
		});
		return false;
	});

	$("#cancel").click(function(event) {
		var wineryname = $("#winery_name").val();
		window.location = "../winery.php?winery_name=" + wineryname;
	})
});
