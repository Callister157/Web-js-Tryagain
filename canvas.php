<script>
    const ctx = document.getElementById('canvasChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: '# of Votes',
                data: [],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    async function loadChartData() {
        try {
            const res = await fetch('chart_data.php', { cache: 'no-store' });
            const json = await res.json();
            chart.data.labels = json.labels;
            chart.data.datasets[0].data = json.values;
            chart.update();
        } catch (err) {
            console.error('Failed to load chart data:', err);
        }
    }

    loadChartData();

	document.getElementById('voteForm').addEventListener('submit', async function (e) 
	{
		e.preventDefault();

		const msg = document.getElementById('voteMsg');
		const formData = new FormData(this);

		try {
			const res = await fetch('chart_submit.php', {
				method: 'POST',
				body: formData
			});
			const json = await res.json();

			if (json.success) {
				msg.textContent = 'Thanks for voting!';
				this.reset();
				loadChartData();   // refresh the graph
			} else {
				msg.textContent = json.error || 'Something went wrong.';
			}
		} catch (err) {
			msg.textContent = 'Network error.';
		}
	});

</script>