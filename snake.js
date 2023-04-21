// Initialisation du jeu
var startButton = document.getElementById("startButton");
var replayButton = document.getElementById("replayButton");
var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
var snake = [{x: 10, y: 10}];
var direction = "right";
var apple = {x: Math.floor(Math.random() * 40), y: Math.floor(Math.random() * 40)};
var score = 0;
var borderSize = 2;
var gameLoop;

startButton.addEventListener("click", function() {
  init();
  startButton.style.display = "none";
  replayButton.style.display = "inline";
});

replayButton.addEventListener("click", function() {
  init();
});

replayButton.style.display = "none";

function init() {
  // Réinitialise les variables
  snake = [{x: 10, y: 10}];
  direction = "right";
  apple = {x: Math.floor(Math.random() * 40), y: Math.floor(Math.random() * 40)};
  score = 0;

  // Lance la boucle de jeu
  clearInterval(gameLoop);
  gameLoop = setInterval(function() {
    update();
    draw();
  }, 100);
}

// Dessine le serpent et la pomme sur le canvas
function draw() {
  context.clearRect(0, 0, canvas.width, canvas.height);

  // Dessine les bordures
  context.fillStyle = "#666";
  context.fillRect(0, 0, canvas.width, borderSize);
  context.fillRect(0, canvas.height - borderSize, canvas.width, borderSize);
  context.fillRect(0, 0, borderSize, canvas.height);
  context.fillRect(canvas.width - borderSize, 0, borderSize, canvas.height);

  // Dessine le serpent
  context.fillStyle = "#000";
  for (var i = 0; i < snake.length; i++) {
    context.fillRect((snake[i].x * 10) + borderSize, (snake[i].y * 10) + borderSize, 10, 10);
  }

  // Dessine la pomme
  context.fillStyle = "#f00";
  context.fillRect((apple.x * 10) + borderSize, (apple.y * 10) + borderSize, 10, 10);

  // Affiche le score
  context.fillStyle = "#000";
  context.font = "bold 16px Arial";
  context.textAlign = "left";
  context.fillText("Score : " + score, 10, canvas.height - 10);
}

// Met à jour la position du serpent et vérifie les collisions avec la pomme et les bords du canvas
function update() {
  // Met à jour la position du serpent
  var head = {x: snake[0].x, y: snake[0].y};
  if (direction == "right") {
    head.x++;
  } else if (direction == "left") {
    head.x--;
  } else if (direction == "up") {
    head.y--;
  } else if (direction == "down") {
    head.y++;
  }
  snake.unshift(head);

  // Vérifie les collisions avec la pomme
  if (snake[0].x == apple.x && snake[0].y == apple.y) {
    score++;
    apple = {x: Math.floor(Math.random() * 40), y: Math.floor(Math.random() * 40)};
  } else {
    snake.pop();
  }

  // Vérifie les collisions avec les bords du canvas
  if (snake[0].x < 0 || snake[0].x >= (canvas.width / 10) - 1 || snake[0].y < 0 || snake[0].y >= (canvas.height / 10) - 1) {
    clearInterval(gameLoop);
    alert("Game over !");
  }
}

// Gère les événements clavier pour changer la direction du serpent
document.addEventListener("keydown", function(event) {
  if (event.code == "ArrowLeft" && direction != "right") {
    direction = "left";
  } else if (event.code == "ArrowUp" && direction != "down") {
    direction = "up";
  } else if (event.code == "ArrowRight" && direction != "left") {
    direction = "right";
  } else if (event.code == "ArrowDown" && direction != "up") {
    direction = "down";
  }
});

// Boucle de jeu
var gameLoop = setInterval(function() {
  update();
  draw();
}, 100);
