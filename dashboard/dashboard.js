const database = {
    "201401111": {
        class: "10B",
        cname: "劉珈妤",
        cno: 09,
        committee: true,
        ename: "LAU Ka Yue",
        points: 100,
        participatedEvents: ["a", "b", "c"]
    }, 
    "201401046": {
        class: "10B",
        cname: "劉珈孜",
        cno: 08,
        committee: true,
        ename: "LAU Ka Tsz",
        points: 100,
        participatedEvents: ["a", "b"]
    },
    "201401000": {
        class: "10B",
        cname: "劉珈X",
        cno: 36,
        committee: false,
        ename: "LAU Ka XXX",
        points: 180,
        participatedEvents: ["a", "c"]
    }
}

const allEvents = ["a", "b", "c"]

let databaseArray = [];
function generateArray() {
  for (const studentId in database) {
      if (database.hasOwnProperty(studentId)) {
          databaseArray.push({ studentId: studentId, data: database[studentId] });
      }
  }
}

generateArray();

function appendStreakFor({ data: { participatedEvents } }, index) {
  let participatedBoolArray = [];
  allEvents.forEach((event) => {
      participatedBoolArray.push(participatedEvents.includes(event));
  })
  let streak = 0;
  participatedBoolArray.forEach((event) => {
      streak = event ? streak + 1 : 0
  })
  databaseArray[index].streak = streak;
}

databaseArray.forEach((student, index) => {
  appendStreakFor(student, index);
});

console.log(databaseArray);

const prizes = [
  { name: "Plushie", price: 1000 },
  { name: "Rubik's Clock", price: 600 },
  { name: "Newton's cradle", price: 400 },
  { name: "Klein bottle", price: 400 },
  { name: "Stationary", price: 100 }
]

const prizeListElement = document.querySelector(".prize-list-box");

prizes.forEach(({name, price}) => {
  prizeListElement.innerHTML += `
    <div class="prize-item">
      <div class="prize-name">${name}</div>
      <div class="prize-price">${price}</div>
    </div>
  `
})

const prizeSelection = document.querySelector(".prize-selection");

prizes.forEach(({ name }) => {
  prizeSelection.innerHTML += `
    <option>${name}</option>
  `
})