$(function () {
    $('.chip[data-filter]').on('click', function () {
        const filter = $(this).data('filter');
        $('.chip[data-filter]').removeClass('active');
        $(this).addClass('active');

        $('.portfolio-filter-item').each(function () {
            const category = $(this).data('category');
            $(this).toggle(filter === 'all' || filter === category);
        });
    });

    $('.lightbox-link').on('click', function (event) {
        event.preventDefault();
        const image = $(this).attr('href');
        const modal = `
            <div class="modal fade" id="lightboxModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content bg-transparent border-0">
                        <img class="w-100 rounded-4" src="${image}" alt="Preview">
                    </div>
                </div>
            </div>`;
        $('#lightboxModal').remove();
        $('body').append(modal);
        const instance = new bootstrap.Modal(document.getElementById('lightboxModal'));
        instance.show();
    });
});
