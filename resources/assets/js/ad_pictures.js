const Dropzone = require('dropzone');
const Axios = require('axios');
const Sortable = require('sortablejs');
require('./bootstrap');

Dropzone.options.dropzone = {
    success: function(file, response) {
        if (response.error) {
            alert(response.error);
            return;
        }

        Axios.post('/adpicture', {
            url: response.filename,
        }).then(response => {
            location.href = '/adpicture';
        });
    }
};

Sortable.create(document.getElementById('ad-pictures'));

$('.ad-pictures-container').click(function() {
    $(this).remove();
});
