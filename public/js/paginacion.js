$(document).ready(function() {
    $(document).on('click', '#pagination-container a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            success: function(data) {
                //console.log(data);
                $('#paginacion-container').html(data);
            }
        });
    });
});
