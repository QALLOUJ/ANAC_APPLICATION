// Liste des villes et leurs populations
const cities = [
    { name: "Paris", population: 2148000h },
    { name: "Marseille", population: 861635 },
    { name: "Lyon", population: 515695 },
    { name: "Toulouse", population: 453317 },
    { name: "Nice", population: 340017 },
    { name: "Nantes", population: 314138 },
    { name: "Strasbourg", population: 277270 },
    { name: "Montpellier", population: 277639 },
    { name: "Bordeaux", population: 257068 },
    { name: "Lille", population: 232440 },
    { name: "Rennes", population: 216815 },
    { name: "Reims", population: 185000 },
    { name: "Le Havre", population: 170147 },
    { name: "Saint-Étienne", population: 171000 },
    { name: "Toulon", population: 170000 },
    // Ajoute d'autres villes si nécessaire
  ];
  
  const tableBody = document.getElementById("cityTable").getElementsByTagName("tbody")[0];
  let timeLeft = 60;  // Durée du chronomètre en secondes
  let timerInterval;
  
  // Fonction pour démarrer le chronomètre
  function startTimer() {
    timerInterval = setInterval(() => {
      timeLeft--;
      document.getElementById("timer").textContent = "Temps restant : " + timeLeft;
  
      if (timeLeft <= 0) {
        clearInterval(timerInterval);  // Arrêter le timer quand il atteint 0
        alert("Le temps est écoulé !");
      }
    }, 1000);  // Chaque seconde
  }
  
  // Démarrer le chronomètre au lancement du jeu
  startTimer();
  
  // Fonction pour ajouter une ville au tableau avec animation
  function addCityToTable(cityName) {
    const city = cities.find(c => c.name.toLowerCase() === cityName.toLowerCase());
  
    if (city) {
      // Créer une nouvelle ligne dans le tableau
      const row = tableBody.insertRow();
      row.classList.add("table-row");  // Ajouter la classe pour l'animation
      
      // Insérer les données des cellules
      const nameCell = row.insertCell(0);
      const populationCell = row.insertCell(1);
  
      nameCell.textContent = city.name;
      populationCell.textContent = city.population;
  
      // Ajouter la classe 'visible' pour activer l'animation
      setTimeout(() => row.classList.add("visible"), 100);
  
      // Trier le tableau après ajout de la ville
      sortTable();
    } else {
      alert("Ville non trouvée !");
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
      document.getElementById("cityInput").value = "";  // Réinitialiser le champ de saisie
    } else {
      alert("Veuillez entrer une ville !");
    }
  }
  