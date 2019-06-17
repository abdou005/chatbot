/**
 *Display message
 * @param string message
 * @param string id
 * @param number time
 * @returns void
 */
function displayMessage(message, id, time) {
    window.scrollTo(0,0);
    $('#'+id).find('div.alert').empty();
    $('#'+id).find('div.alert').append(message);
    $("#"+id).fadeIn(time);
    setTimeout(function(){
        $("#"+id).fadeOut();
    }, 2000);
}

/**
 * display image in modal
 * @param image
 */
function showImage(image) {
    $('#modalImage .modal-body').html('<img src="'+image+'" class="img-responsive" style="margin: 0 auto; height: 400px">');
}

/**
 *
 * @param date
 * @param minusDay
 * @returns {Date}
 */
function convertDate(date, minusDay) {
    var dateArray = date.split("-");
    console.log(dateArray);
    if (minusDay) {
        return new Date((dateArray.map(Number)[2]), (dateArray.map(Number)[1] - 1), (dateArray.map(Number)[0]) - 1);
    }
    return new Date((dateArray.map(Number)[2]), (dateArray.map(Number)[1] - 1), (dateArray.map(Number)[0]));
}