document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('statusChart');
    if (!canvas) return; // prevent errors if canvas missing

    const pending = canvas.dataset.pending ?? 0;
    const repairing = canvas.dataset.repairing ?? 0;
    const ready = canvas.dataset.ready ?? 0;
    const delivered = canvas.dataset.delivered ?? 0;

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'In-Repair', 'Ready', 'Delivered'],
            datasets: [{
                label: 'Complaints Status',
                data: [pending, repairing, ready, delivered],
                backgroundColor: ['#ffc107', '#0d6efd', '#198754', '#6c757d']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
