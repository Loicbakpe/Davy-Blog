import EasyMDE from 'easymde';
import 'easymde/dist/easymde.min.css';

// Initialize editor only if the element exists (admin post forms)
document.addEventListener('DOMContentLoaded', function () {
    const bodyEl = document.getElementById('markdown-editor');
    if (bodyEl) {
        const editor = new EasyMDE({
            element: bodyEl,
            spellChecker: false,
            autosave: { enabled: false },
            toolbar: [
                'bold', 'italic', '|',
                'heading-1', 'heading-2', '|',
                'quote', 'unordered-list', 'ordered-list', '|',
                'link', 'image', 'table', '|',
                'preview', 'side-by-side', 'fullscreen', '|',
                'guide'
            ],
            placeholder: 'Rédigez votre article en Markdown ici...',
            renderingConfig: {
                singleLineBreaks: false,
            },
        });

        // Sync editor content back to textarea on form submit
        bodyEl.closest('form')?.addEventListener('submit', () => {
            bodyEl.value = editor.value();
        });
    }
});
