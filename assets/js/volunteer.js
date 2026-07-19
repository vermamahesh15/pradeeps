$(document).ready(function() {
    if ($('#volunteerListContainer').length) {
        loadVolunteers();
    }

    $('#volunteerFilterForm').on('submit', function(e) {
        e.preventDefault();
        loadVolunteers($(this).serialize());
    });

    $(document).on('change', '.status-selector', function() {
        const id = $(this).data('id');
        const status = $(this).val();
        const $select = $(this);

        $select.prop('disabled', true);
        $.post('volunteer-status.php', { id: id, status: status }, function(res) {
            $select.prop('disabled', false);
            if (res.status === 'success') {
                Swal.fire({ icon: 'success', title: 'Updated', text: 'Status changed to ' + status, toast: true, position: 'top-end', timer: 3000, showConfirmButton: false });
            }
        });
    });
});

function loadVolunteers(formData = '') {
    $.post('volunteer-list.php', formData, function(html) {
        $('#volunteerListContainer').html(html);
    }).fail(function() {
        $('#volunteerListContainer').html('<div class="alert alert-danger m-3">Failed to load volunteers. Please ensure the database table exists and you are logged in.</div>');
        console.error("AJAX Error: Could not load volunteer-list.php");
    });
}

function deleteVolunteer(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This record and photo will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('volunteer-delete.php', { id: id }, function(res) {
                loadVolunteers();
                Swal.fire('Deleted!', 'Volunteer has been removed.', 'success');
            });
        }
    });
}

function generateID(id) {
    $.post('volunteer-idcard.php', { id: id }, function(html) {
        $('#idCardContainer').html(html);
        $('#idCardModal').modal('show');
    });
}

function viewVolunteer(id) {
    $.post('volunteer-view.php', { id: id }, function(html) {
        $('#modalContent').html(html);
        $('#volunteerModal').modal('show');
    });
}