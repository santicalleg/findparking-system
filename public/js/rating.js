var parking_id = 0;

$(function(){
	$("#parking-rating").rating({ displayOnly: true });
    $(".users-rating").rating({ displayOnly: true });
    parking_id = $("#parking_id").val();

    getUserRating();

    $("#send").click(function(e) {
        var id = $("#id").val();
        var rating = $("#user-rating").val();
        var comment = $("#comment").val();
        
        var data = { 
            "value" : parseInt(rating), 
            "comment" : comment,
            "parking_id" : parking_id,
            "id" : id
        };

        if (!id || id == 0) {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/rating/store',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: onSuccess,
                error: onError
	        });
        }
        else {
            $.ajax({
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/rating/update',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: onSuccess,
                error: onError
	        });
        }        
    });

    $("#favorite").click(function(e){
        var isFavorite = this.value == "1";
        var id = $("#id").val();

        var data = { 
            "id" : id,
            "isFavorite" : !isFavorite,
            "parking_id" : parking_id
        };

        if (!id || id == 0) {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/favorite/store',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: onFavoriteSuccess,
                error: onError
            });
        }
        else {
            $.ajax({
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/favorite/update/' + id,
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: onFavoriteSuccess,
                error: onError
            });
        }
    });
});

function getUserRating() {
    var uri = '/rating/getByUserAndParking/' + parking_id;

    $.ajax({
		type: 'GET',
  		url: '/rating/getByUserAndParking/' + parking_id,
  		contentType: 'application/json',
        success: onGetUserRatingSuccess,
  		error: onError
	});
}

function onSuccess(data, status, jqXHR) {
    console.log("success");
    var result = jQuery.parseJSON(data);
    var avg = parseFloat(result.avg).toFixed(1);
    $('#parking-rating').rating('update', avg);
    $('#rating').html(avg);
    $('#id').val(result.id);

    $('#success-message').removeClass('hidden');
    setTimeout(function () { 
        $('#success-message').addClass('hidden');
    }, 5000);
}

function onFavoriteSuccess(data, status, jqXHR) {
    var result = parseInt(data);
    $('#favorite').val(result);
    changeFavoriteButton(result);
}

function onGetUserRatingSuccess(data, status, jqXHR) {
    var data = jQuery.parseJSON(data);

    if (data) {
        $("#user-rating").val(data.value);
        $("#comment").val(data.comment);
        $("#id").val(data.id);
        $("#favorite").val(data.isFavorite);
        changeFavoriteButton(data.isFavorite);
    }

    $("#user-rating").rating({language: 'es'});
}

function changeFavoriteButton(isFavorite) {
    $('#favorite span').first().removeClass();
    if (isFavorite && isFavorite === 1) {
        $('#favorite span').first().addClass('fa fa-minus-circle');
        $('#favorite span').last().text('Eliminar de favoritos');
    }
    else {
        $('#favorite span').first().addClass('fa fa-plus-circle');
        $('#favorite span').last().text('Agregar a favoritos');
    }
}

function onError(textStatus, errorThrown) {
	console.log(errorThrown);
    $('#error-message').removeClass('hidden');

    if (textStatus.status >= 400 || textStatus.status < 500) {
        if (textStatus.status == 422) {
            var validation = textStatus.responseJSON;
            $("#error-message").html(validation.value);
        }
        else {
            $("#error-message").html(textStatus.responseText);
        }
    }

    setTimeout(function () { 
        $('#error-message').addClass('hidden');
    }, 7000);
}