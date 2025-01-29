function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("text");
    var droppedElement = document.getElementById(data);

    // Vérifie la correspondance région-specialité
    if ((event.target.id === 'bordeaux' && data === 'canele') ||
        (event.target.id === 'normandie' && data === 'camembert') ||
        (event.target.id === 'provence' && data === 'ratatouille') ||
        (event.target.id === 'alsace' && data === 'choucroute')) {

        // Déplace la spécialité à la bonne région
        event.target.appendChild(droppedElement);
        droppedElement.setAttribute("draggable", "false"); // Désactive le drag
        droppedElement.style.backgroundColor = "#d4edda"; // Change la couleur si correct
    } else {
        droppedElement.style.backgroundColor = "#f8d7da"; // Indique erreur
        setTimeout(() => {
            droppedElement.style.backgroundColor = "#e8e8e8"; // Restaure la couleur
        }, 500);
    }
}
