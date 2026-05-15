$(document).ready(function() {
function initSummernote(element) {
    element.summernote({
        placeholder: 'Enter FAQ Answer...',
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol']],
            ['insert', ['link']],
            ['view', ['codeview']]
        ]
    });
}

// Initialize first textarea
initSummernote($('.faq-answer'));

    // ADD MORE FAQ
    $('#addFaq').click(function() {
        let faqHtml = `
        <div class="row faq-item mb-3">
            <div class="col-md-5">
                <input type="text" name="question[]" class="form-control" placeholder="Question" required>
            </div>
            <div class="col-md-6">
                <textarea name="answer[]" class="form-control faq-answer" placeholder="Answer" required></textarea>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeFaq">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>`;
        $('#faqWrapper').append(faqHtml);
    });

    // REMOVE FAQ
    $(document).on('click', '.removeFaq', function() {
        $(this).closest('.faq-item').remove();
    });

});
