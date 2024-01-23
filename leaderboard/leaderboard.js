const database = {
  "201401111": {
    class: "10B",
    cname: "劉珈妤",
    cno: 9,
    committee: true,
    ename: "LAU Ka Yue",
    points: 100
  }, 
  "201401046": {
    class: "10B",
    cname: "劉珈孜",
    cno: 8,
    committee: true,
    ename: "LAU Ka Tsz",
    points: 100
  },
  "201401000": {
    class: "10B",
    cname: "劉珈X",
    cno: 36,
    committee: false,
    ename: "LAU Ka XXX",
    points: 180
  },
  "201401001": {
    class: "10B",
    cname: "劉XX",
    cno: 37,
    committee: false,
    ename: "LAU XX XXX",
    points: 75
  },
  "201401002": {
    class: "10B",
    cname: "劉XX",
    cno: 38,
    committee: false,
    ename: "Sunshine Egg",
    points: 1000
  }
}

function updateLeaderboard() {
  let leaderboard = [];

  for (const studentId in database) {
    if (database.hasOwnProperty(studentId)) {
      leaderboard.push({ studentId: studentId, data: database[studentId] });
    }
  }

  leaderboard.sort((a,b) => b.data.points-a.data.points);

  const leaderboardElement = document.querySelector(".leaderboard");
  
  leaderboardElement.innerHTML = `
    <tr>
      <th class="rank"></th>
      <th class="class">Class</th>
      <th class="number">Number</th>
      <th class="name">Name</th>
      <th class=points>Points</th>
    </tr>
  `
  
  let rank = 0;
  leaderboard.forEach((student) => {
    rank += 1;
    leaderboardElement.innerHTML += `
      <tr class="student">
        <td class="rank-${rank}" style="color: var(--color-gray-blue)">${rank}</td>
        <td class="class">${student.data.class}</td>
        <td class="cno">${student.data.cno}</td>
        <td class="name">${student.data.ename}</td>
        <td class="points">${student.data.points}</td>
      </tr>
    `
  })
}

let permission = Notification.permission;

if (permission === 'granted') {
  showNotification();
}
else if (permission = 'default') {
  requestAnShowPermission();
}
else{
  alert('Use normal alert');
}

// updateLeaderboard();
// setInterval(updateLeaderboard, 10000)