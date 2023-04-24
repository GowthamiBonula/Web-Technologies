// board
var bSize = 25; 
var rows = 20;
var cols = 20;
var board;
var context;
var score = 0;
var snakeX = bSize * 5;   //snake head co ordinates initially
var snakeY = bSize * 5;
var dotX ;               // dot co ords
var dotY ;
var speedX = 0;         // speed vars
var speedY = 0;
var snakeBody = [];
var gameover = false;
window.onload = function()      // onload --> executes after page has been loaded
{
    board = document.getElementById("board");
    board.height = rows*bSize;
    board.width = cols*bSize;
    context = board.getContext("2d") // used for drawing on canvas  (getContext --> to obtain the rendering context and its drawing functions)
    dotpos();                        // positioning the dot on canvas
    document.addEventListener("keyup",snakeDir);    
    setInterval(update,200);    
        return;
}

function update()
{
    displayScore();         // displays score on right corner of canvas
    if (gameover)
    {
        context.font = "25px Arial";
        context.fillStyle = "white";
        context.textAlign = "center";
        context.fillText("Game Over", board.width / 2, board.height / 2);
        context.fillText("Score: " + score, board.width / 2, board.height / 2 + 40);
        displayScore() 
        return;
    }
    context.fillStyle = "gray";                                          //canvas prop   
    context.fillRect(0,0,board.width,board.height);                      //fillStyle --> sets color, gradient or pattern to fill any drawing   here canvas
    context.fillStyle = "red";                                          // dot properties
    context.fillRect(dotX,dotY,bSize,bSize);
    if (snakeX == dotX && snakeY==dotY)                                  // when snake eats dot
    {
        snakeBody.push([dotX,dotY]);                                    // snake body increments
        dotpos();                                                       // dot position changes
        score += 10                                                     // score = +10
    }
    for (let i = snakeBody.length-1; i > 0; i--) 
    {
        snakeBody[i] = snakeBody[i-1];
    }
    if (snakeBody.length) 
    {
        snakeBody[0] = [snakeX, snakeY];
    }
    context.fillStyle = "lime";                                        // snake properties
    snakeX += speedX * bSize;
    snakeY += speedY * bSize;
    context.fillRect(snakeX,snakeY,bSize,bSize);
    for (let i = 0; i < snakeBody.length; i++) 
    {
        context.fillRect(snakeBody[i][0], snakeBody[i][1], bSize, bSize);
    }
    //conditions for gameover
    if (snakeX < 0 || snakeX > (cols-1)*bSize || snakeY < 0 || snakeY > (rows-1)*bSize) // if snake touches the border of canvas 
    {  gameover = true; }
 if (snakeX == snakeBody[i][0] && snakeY == snakeBody[i][1])
           { gameOver = true; }
    }
function snakeDir(x)                                                   // to change the direction of snake
 {
    if (x.code == "ArrowUp" && speedY != 1) // if equal to 1 it means going down
    {
        speedX = 0;
        speedY = -1;
    }
    else if (x.code == "ArrowDown" && speedY != -1)
    {
        speedX = 0;
        speedY = 1;
    }
    else if (x.code == "ArrowLeft" && speedX != 1)
    {
        speedX = -1;
        speedY = 0;
    }
    else if (x.code == "ArrowRight" && speedX != -1) 
    {
        speedX = 1;
        speedY = 0;
    }
}
function dotpos() 
// to set the position of dot randomly everytime it gets eaten
 {
    //(0-1) * cols -> (0-19.9999) -> (0-19) * 25
    dotX = Math.floor(Math.random() * cols) * bSize;
    dotY = Math.floor(Math.random() * rows) * bSize;
 }
 function resetGame()                 // to reset game
 {  
    gameover = false;
    score = 0;
    snakeX = bSize * 5;
    snakeY = bSize * 5;
    snakeBody = [];
    speedX = 0;
    speedY = 0;  
 }
function displayScore() 
{               // to display score on the top corner
    context.font = "20px Arial";
    context.fillStyle = "white";
    context.textAlign = "right";
    context.fillText("Score: " + score, board.width - 10, 20);
    requestAnimationFrame(displayScore);
}
