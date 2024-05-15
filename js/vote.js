document.addEventListener("DOMContentLoaded", function() {
  console.log('DOM loaded');
  const optionsList = document.getElementById('options-list');
  const graphCanvas = document.getElementById('graph-canvas');
  const ctx = graphCanvas.getContext('2d');
  
  // Initialize vote counts
  let voteCounts = [10, 0, 0, 0, 0];

  fetch('api/get_votes.php?vote_id=1') // Fetch vote data
    .then(response => response.json())
    .then(data => {
      console.log(data);
      // Update vote counts

      // voteCounts = data['voteCount'];
      voteCounts = [];
      data['voteCount']
      console.log(data['voteCount']);
      var i = 0;
      while (data['voteCount'][i] != null) {
        voteCounts.push(data['voteCount'][i]);
        i++;
      }

      console.log('vote counts:', voteCounts);
      updateGraph();
    });
  



  // Add event listeners to list items
  Array.prototype.forEach.call(optionsList.children, (li, index) => {
    li.addEventListener('click', () => {
      voteCounts[index]++;
      // console.log(voteCounts);
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