document.addEventListener("DOMContentLoaded", function() {
    const optionsList = document.getElementById('options-list');
    const graphCanvas = document.getElementById('graph-canvas');
    const ctx = graphCanvas.getContext('2d');
  
    const response = fetch('api/get_vote.php?' + new URLSearchParams({
      vote_id: 1,
    }))

    if (!response.ok) {
      throw new Error('Erreur de connexion');
    }
    console.log(response);
    


    // Initialize vote counts
    let voteCounts = [0, 0, 0, 0, 0];
  
    // Add event listeners to list items
    Array.prototype.forEach.call(optionsList.children, (li, index) => {
      li.addEventListener('click', () => {
        voteCounts[index]++;
        updateGraph();
      });
    });
  
    // Update graph function
    function updateGraph() {
      ctx.clearRect(0, 0, graphCanvas.width, graphCanvas.height);
  
      const totalVotes = voteCounts.reduce((a, b) => a + b, 0);
      const centerX = graphCanvas.width / 2;
      const centerY = graphCanvas.height / 2;
      const radius = Math.min(centerX, centerY);
  
      let currentAngle = 0;
  
      voteCounts.forEach((count, index) => {
        const angle = (count / totalVotes) * 2 * Math.PI;
        ctx.fillStyle = `hsl(${index * 30}, 50%, 50%)`;
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, currentAngle, currentAngle + angle);
        ctx.lineTo(centerX, centerY);
        ctx.fill();
        currentAngle += angle;
      });
    }
  
    // Initialize graph
    updateGraph();
  });