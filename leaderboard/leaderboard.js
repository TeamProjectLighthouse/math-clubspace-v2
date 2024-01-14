const database = {
  "201401111": {
    class: "10B",
    cname: "劉珈妤",
    cno: 09,
    committee: true,
    ename: "LAU Ka Yue",
    points: 100
  }, 
  "201401046": {
    class: "10B",
    cname: "劉珈孜",
    cno: 08,
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
    points: 175
  }
}

let leaderboard = [];

for (const studentId in database) {
  if (database.hasOwnProperty(studentId)) {
    leaderboard.push({ studentId: studentId, data: database[studentId] });
  }
}

leaderboard.sort((a,b) => b.data.points-a.data.points);

const leaderboardElement = document.querySelector(".leaderboard");

let rank = 0;
leaderboard.forEach((student) => {
  rank += 1;
  leaderboardElement.innerHTML += `
    <tr class="student">
      <td class="rank">${rank}</td>
      <td class="class">${student.data.class}</td>
      <td class="cno">${student.data.cno}</td>
      <td class="name">${student.data.ename}</td>
      <td class="points">${student.data.points}</td>
    </tr>
  `
})