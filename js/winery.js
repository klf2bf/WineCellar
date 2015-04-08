function filterWines(classification) {
	$.ajax({
		type: "POST",
		url: 'filter_wine.php',
		data: {'class': classification},
		success: function (data) {
			$("#wine-data")[0].innerHTML = data;
		}
	});
}
$(document).ready(function () {

	if ($("#review_title").length > 0) {
		var winery_name = $("#winery_name").val();
		$("#review_title")[0].innerHTML = "Review for " + winery_name;
	}
	
	$("#add_winery_review").click(function(){
		var winery_name = $("#winery_name").val();

		window.location = "../add_winery_review.php?winery_name=" + winery_name;

	});

	$("#export_reviews").click(function(){
		$.ajax({
			type: "POST",
			url: 'export_reviews.php',
			data: {},
		});
	});

	$(".dropdown-menu>li>a").click(function(data) {
		var type = data.toElement.text;
		$.ajax({
			type: "POST",
			url: 'filter_wine.php',
			data: {'type': type},
			success: function(data) {
				filterWines(type);
			}
		});
	});

	$("#add_wine_review").click(function(){
		var winery_name = $("#winery_name").val();
		window.location = "../add_wine_review.php?winery_name=" + winery_name;
	});

	$("#submit").click(function(event) {
		var wineryname = $("#winery_name").val();
		var email = $("#email").val();
		var description = $("#description").val();
		var rating = $("#stars").val();
				
		$.ajax({
			type: "POST",
			url: 'submit_winery_review.php',
			data: {'winery_name': winery_name, 'email': email, 'description': description, 'rating': rating},
			success: function (data) {
				if (data) {
					alert(data)
				} else {
					window.location = "../winery.php?winery_name=" + wineryname + "#reviewTab";
				} 
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
				if (data) {
					alert(data);
				} else {
					$('#submit_wine_review')[0].reset();
					window.location = "../winery.php?winery_name=" + winery_name;
				}
			}
		});
		return false;
	});

	$("#cancel").click(function(event) {
		var wineryname = $("#winery_name").val();
		window.location = "../winery.php?winery_name=" + wineryname;
	})

	$('.nav-pills').stickyTabs();

});

(function ( $ ) {
    $.fn.stickyTabs = function() {
        context = this

        // Show the tab corresponding with the hash in the URL, or the first tab.
        var showTabFromHash = function() {
          var hash = window.location.hash;
          var selector = hash ? 'a[href="' + hash + '"]' : 'li:first-child a';
          $(selector, context).tab('show');
        }

        // Set the correct tab when the page loads
        showTabFromHash(context)

        // Set the correct tab when a user uses their back/forward button
        window.addEventListener('hashchange', showTabFromHash, false);

        // Change the URL when tabs are clicked
        $('a', context).on('click', function(e) {
          history.pushState(null, null, this.href);
        });

        return this;
    };
}( jQuery ));