const cities = [
  { name: "Par", population: 2113705 },
  { name: "Marseille", population: 877215 },
  { name: "Lyon", population: 520774 },
  { name: "Toulouse", population: 511684 },
  { name: "Nice", population: 353701 },
  { name: "Nantes", population: 325070 },
  { name: "Montpellier", population: 307101 },
  { name: "Strasbourg", population: 291709 },
  { name: "Bordeaux", population: 265328 },
  { name: "Lille", population: 238695 },
  { name: "Rennes", population: 227830 },
  { name: "Toulon", population: 180834 },
  { name: "Reims", population: 178478 },
  { name: "Saint-Étienne", population: 172569 },
  { name: "Le Havre", population: 166462 },
  { name: "Dijon", population: 155090 },
  { name: "Angers", population: 154508 },
  { name: "Villeurbanne", population: 150148 },
  { name: "Le Mans", population: 143431 },
  { name: "Aix-en-Provence", population: 142149 },
  { name: "Clermont-Ferrand", population: 141569 },
  { name: "Brest", population: 139163 },
  { name: "Tours", population: 136565 },
  { name: "Amiens", population: 134057 },
  { name: "Perpignan", population: 121875 },
  { name: "Metz", population: 119738 },
  { name: "Besançon", population: 116775 },
  { name: "Orléans", population: 114286 },
  { name: "Saint-Denis", population: 112000 },
  { name: "Argenteuil", population: 110000 }
];

const tableBody = document.getElementById("cityTable").getElementsByTagName("tbody")[0];
let timeLeft = 90; // Durée du chronomètre en secondes
let timerInterval;
let foundCitiesCount = 0;

// Fonction pour démarrer le chronomètre
function startTimer() {
timerInterval = setInterval(() => {
  timeLeft--;
  document.getElementById("timer").textContent = "Temps restant : " + timeLeft;

  if (timeLeft <= 0) {
    clearInterval(timerInterval); // Arrêter le timer quand il atteint 0
    endGame(); // Terminer la partie et afficher le score
  }
}, 1000);
}

// Démarrer le chronomètre au lancement du jeu
startTimer();

// Fonction pour ajouter une ville au tableau avec animation
function addCityToTable(cityName) {
const city = cities.find(c => c.name.toLowerCase() === cityName.toLowerCase());

if (city) {
  const existingRow = Array.from(tableBody.rows).find(
    row => row.cells[0].textContent === city.name
  );

  if (!existingRow) {
    // Créer une nouvelle ligne dans le tableau
    const row = tableBody.insertRow();
    row.classList.add("table-row"); // Ajouter la classe pour l'animation

    // Insérer les données des cellules
    const nameCell = row.insertCell(0);
    const populationCell = row.insertCell(1);

    nameCell.textContent = city.name;
    populationCell.textContent = city.population;

    // Ajouter la classe 'visible' pour activer l'animation
    setTimeout(() => row.classList.add("visible"), 100);

    foundCitiesCount++;
    sortTable();
  }
}
}

// Fonction de tri du tableau par population (du plus grand au plus petit)
function sortTable() {
const rows = Array.from(tableBody.rows);
rows.sort((rowA, rowB) => {
  const popA = parseInt(rowA.cells[1].textContent);
  const popB = parseInt(rowB.cells[1].textContent);
  return popB - popA;
});

rows.forEach(row => tableBody.appendChild(row));
}

// Fonction pour soumettre une ville
function submitCity() {
const cityName = document.getElementById("cityInput").value.trim();
if (cityName) {
  addCityToTable(cityName);
  document.getElementById("cityInput").value = ""; // Réinitialiser le champ de saisie
}
}

// Ajouter un écouteur pour soumettre la ville avec la touche "Entrée"
document.getElementById("cityInput").addEventListener("keyup", function (event) {
if (event.key === "Enter") {
  submitCity();
}
});

// Fonction pour terminer la partie et afficher le score avec commentaires
function endGame() {
let message = `Temps écoulé ! Vous avez trouvé ${foundCitiesCount} ville(s). `;

if (foundCitiesCount <= 5) {
  message += "Oups ! Il va falloir revoir les villes françaises !";
} else if (foundCitiesCount <= 10) {
  message += "Pas mal, mais tu peux faire mieux !";
} else if (foundCitiesCount <= 15) {
  message += "Très bien ! Tu connais bien les villes françaises !";
} else if (foundCitiesCount <= 20) {
  message += "Excellent ! Tu es un vrai expert des villes françaises !";
} else {
  message += "Incroyable ! Personne ne te battra sur ce jeu !";
}

document.getElementById("result").textContent = message;
}
