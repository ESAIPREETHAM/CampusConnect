document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const queryInput = document.querySelector('#query');
        
        if (queryInput.value.trim() === '') {
            alert('Please enter a MySQL query.');
            return;
        }

        form.submit();
    });
});