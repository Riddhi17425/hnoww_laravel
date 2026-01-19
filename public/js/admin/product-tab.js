$(document).ready(function () {
    function initEditor(el) {
        el.summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ]
        });
    }

    // Init existing editors
    $('.details').each(function () {
        initEditor($(this));
    });

    // Add new TAB
    $('#addTab').click(function () {
        let html = `
        <div class="row tab-item mb-3">
            <input type="hidden" name="tab_id[]" value="">

            <div class="col-md-5">
                <input type="text" name="title[]" class="form-control" required>
            </div>

            <div class="col-md-6">
                <textarea name="details[]" class="form-control details" required></textarea>
            </div>

            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeTab">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>`;

        $('#tabWrapper').append(html);
        initEditor($('#tabWrapper .details').last());
    });

    // Remove TAB
    $(document).on('click', '.removeTab', function () {
        $(this).closest('.tab-item').remove();
    });

});