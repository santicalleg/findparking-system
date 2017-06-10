$(function(){
    // $("#user-rating").rating();
	$("#parking-rating").rating({ displayOnly: true });

    getUserRating();

    $("#rate").submit(function(e) {
        var id = $("#id").val();
        var rating = $("#user-rating").val();
        var comment = $("#comment").val();
        var parking_id = $("#parking_id").val();

        var data = { 
            "value" : parseInt(rating), 
            "comment" : comment,
            "parking_id" : parking_id,
            "id" : id
        };

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'rating/store',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(data, status, jqXHR) {
                console.log("success");
                $(".modal-title").html("Felicidades");
                $("#modal-body-message").html("Has estacionado correctamente!");
                $("#windowModal").modal();
            },
            error: function(textStatus, errorThrown) {
                console.log("error: " + textStatus.responseText);
                if (textStatus.status >= 400 || textStatus.status < 500) {
                    $(".modal-title").html("Advertencia");
                }
                else {
                    $(".modal-title").html("Error");
                }
                $("#modal-body-message").html(textStatus.responseText);
                $("#windowModal").modal();
            }
	    });
    });
});

function getUserRating() {
    $.ajax({
		type: 'GET',
  		url: '/rating/getByUser',
  		contentType: 'application/json',
  		success: function(data, status, jqXHR) {
  			onUserRatingSuccess(data, status, jqXHR);
  		},
  		error: onError
	});
}

function onUserRatingSuccess(data, status, jqXHR) {
    var data = jQuery.parseJson(data);

    if (data) {
        $("#user-rating").val(data.value);
        $("#comment").val(data.comment);
        $("#id").val(data.id);
    }

    $("#user-rating").rating();
}

function onError(textStatus, errorThrown) {
	console.log(errorThrown);
}