<!-- canvasjs script -->
		<script>
			const ctx = document.getElementById('canvasChart').getContext('2d');

			new Chart(ctx, {
				type: 'bar',
				data: {
				labels: ['Program', 'ELDA', 'CNC', 'Instalasi', 'AI', 'Instrumen'],
				datasets: [{
					label: '# of Votes',
					data: [3, 6, 8, 5, 6, 10],
					borderWidth: 1
				}]
				},
				options: {
				scales: {
					y: {
					beginAtZero: true
					}
				}
				}
			});
		</script>