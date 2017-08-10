
let rainbow = {
    showLoading: function (show, affectedElements) {
        if (show) {
            $('#rainbow-loader-container').show();
        } else {
            $('#rainbow-loader-container').hide();
        }

        $(affectedElements).each(function () {
            $(this).prop('disabled', show);
        });
    }
};
