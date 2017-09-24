$(function () {
   $('#modal-button').click(function () {
       $('#modal').modal('show')
           .find('#modal-content')
           .load($(this).attr('value'));
   });

    $('#no-permission').click(function () {
        var entity = $(this).text().toLowerCase().replace(' ', ' a ');
        alertify.warning("You don't have permission to " + entity + "!");
    });
});