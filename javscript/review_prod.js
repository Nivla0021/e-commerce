const numberInput = document.getElementById('myNumberInput');

numberInput.addEventListener('keydown', (e) => {
   
    e.preventDefault();
});

numberInput.addEventListener('wheel', (e) => {
    
    e.preventDefault();
    const delta = Math.sign(e.deltaY);
    numberInput.stepUp(delta);
});