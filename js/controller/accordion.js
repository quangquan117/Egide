export function accordion() {
    document.querySelectorAll('details').forEach(detail => {
        detail.addEventListener('toggle', function () {
            const summaryContent = this.querySelector('.summary-content');
            const detailsContent = this.querySelector('.details-content');

            if (this.open) {
                summaryContent.style.display = 'none';
                detailsContent.style.display = 'block';
            } else {
                summaryContent.style.display = 'block';
                detailsContent.style.display = 'none';
            }
        });

        // Initialiser l'état pour chaque élément <details>
        if (detail.hasAttribute('open')) {
            detail.querySelector('.summary-content').style.display = 'none';
            detail.querySelector('.details-content').style.display = 'block';
        } else {
            detail.querySelector('.summary-content').style.display = 'block';
            detail.querySelector('.details-content').style.display = 'none';
        }
    });
}