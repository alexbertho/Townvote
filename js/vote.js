document.addEventListener("DOMContentLoaded", function() {
  console.log('DOM loaded');
  const optionsList = document.getElementById('options-list');
  const graphCanvas = document.getElementById('graph-canvas');
  const ctx = graphCanvas.getContext('2d');
  
  // Initialize vote counts
  voteCounts = [];

  fetch('api/get_votes.php?vote_id=1') // Fetch vote data
    .then(response => response.json())
    .then(data => {
      // console.log(data);
      // console.log(data['voteCount']);
      
      for (var key in data['choix']) {
        const li = document.createElement('li');
        li.textContent = data['choix'][key]['desc'];
        li.id = data['choix'][key]['id'];
        optionsList.appendChild(li);
      }
      
      Array.prototype.forEach.call(optionsList.children, (li, index) => {
        // console.log(li);
        li.addEventListener('click', () => {
          // console.log(li.id);

          fetch('api/vote.php?vote_id=1&choix_id=' + li.id, {method: 'GET'})
          .then(response => response.json())
          .then(data => {
            //! add a message to the user
            console.log(data)
          }); 
        
        
        
        updateGraph();
        });
      });

      for (var i in data['voteCount']) {
        voteCounts[i] = (data['voteCount'][i]);
      }
      updateGraph();
  });
  
  
  setInterval(updateGraph, 500);

  

  // Update graph function
  function updateGraph() {
    voteCounts = []
    fetch('api/get_votes.php?vote_id=1') // Fetch vote data
    .then(response => response.json())
    .then(data => {
      for (var i in data['voteCount']) {
        voteCounts[i] = (data['voteCount'][i]);
      }
      // console.log('vote counts:', voteCounts);
      
      console.log("update");
      
      
      const totalVotes = voteCounts.reduce((a, b) => a + b, 0);
      const centerX = graphCanvas.width / 2;
      const centerY = graphCanvas.height / 2;
      const radius = Math.min(centerX, centerY);
      
      let currentAngle = 0;
      
      
      ctx.clearRect(0, 0, graphCanvas.width, graphCanvas.height);
      voteCounts.forEach((count, index) => {
        const angle = (count / totalVotes) * 2 * Math.PI;
        ctx.fillStyle = `hsl(${index * 30}, 50%, 50%)`;
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, currentAngle, currentAngle + angle);
        ctx.lineTo(centerX, centerY);
        ctx.fill();
        currentAngle += angle;
      });
    });
  }


  function submit(theForm) {
    console.log("submit");
    const formData = new FormData(theForm);
    console.log(formData);
    fetch('api/send_message.php?message=aaaaa&vote_id=1')
    .then(response => response.json())
    .then(data => {
      console.log(data);
    });
  }

});