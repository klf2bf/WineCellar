$(document).ready(function () {
	$.ajax({
        url: 'php/winery.php', 
        data: {},
        success: function(data) {
            $("#wineText")[0].innerHTML = data;
        }
      });
});