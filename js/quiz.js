document.addEventListener("DOMContentLoaded", function () {
    let timerElement = document.getElementById("timer");
    let questionElement = document.getElementById("question");
    let answersElement = document.getElementById("answers");

    let questions = [
        { question: "Quelle ville du Languedoc est célèbre pour sa citadelle médiévale ?", options: ["Toulouse", "Toulon", "Montellmar", "Carcassonne"], correct: "Carcassonne" },
        { question: "Quelle ville est connue pour son festival de cinéma ?", options: ["Nice", "Cannes", "Lyon", "Bordeaux"], correct: "Cannes" },
        { question: "Dans quelle ville se trouve la cathédrale Notre-Dame ?", options: ["Marseille", "Strasbourg", "Paris", "Nantes"], correct: "Paris" },
        { question: "Quelle ville est la capitale de la région Provence-Alpes-Côte d'Azur ?", options: ["Marseille", "Nice", "Toulon", "Aix-en-Provence"], correct: "Marseille" },
        { question: "Quelle ville est célèbre pour son vin de Champagne ?", options: ["Bordeaux", "Reims", "Dijon", "Lyon"], correct: "Reims" },
        { question: "Dans quelle ville se trouve le Mont-Saint-Michel ?", options: ["Rennes", "Caen", "Nantes", "Le Mont-Saint-Michel"], correct: "Le Mont-Saint-Michel" },
        { question: "Quelle ville est connue pour son carnaval annuel ?", options: ["Nice", "Dunkerque", "Limoges", "Toulouse"], correct: "Nice" },
        { question: "Quelle ville est la capitale de la Bretagne ?", options: ["Brest", "Rennes", "Nantes", "Quimper"], correct: "Rennes" },
        { question: "Dans quelle ville se trouve le musée du Louvre ?", options: ["Paris", "Lyon", "Marseille", "Lille"], correct: "Paris" },
        { question: "Quelle ville est célèbre pour son festival de jazz ?", options: ["Nice", "Juan-les-Pins", "Paris", "Bordeaux"], correct: "Juan-les-Pins" }
    ];

    let currentQuestionIndex = 0;
    let score = 0;
    let timeLeft = 60;

    function updateTimer() {
        timerElement.textContent = "Temps restant : " + timeLeft;
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            endGame();
        } else {
            timeLeft--;
        }
    }

    function loadQuestion() {
        if (currentQuestionIndex >= questions.length) {
            endGame();
            return;
        }

        let questionData = questions[currentQuestionIndex];
        questionElement.textContent = questionData.question;
        answersElement.innerHTML = "";

        questionData.options.forEach(option => {
            let button = document.createElement("button");
            button.textContent = option;
            button.onclick = function () {
                if (option === questionData.correct) {
                    score++;
                }
                currentQuestionIndex++;
                loadQuestion();
            };
            answersElement.appendChild(button);
        });
    }

    function endGame() {
        questionElement.textContent = "Quiz terminé ! Score : " + score + " / " + questions.length;
        answersElement.innerHTML = "";
    }

    let timerInterval = setInterval(updateTimer, 1000);
    loadQuestion();
});