    <style>
        #slider {
            width: 100%;
            height: 800px; /* Adjust the height as needed */
            overflow: hidden;
        }

        #slider figure {
            display: flex;
            width: 500%; /* Adjust based on the number of images */
            transition: transform 4s ease-in-out; /* Increase the animation time to 4 seconds */
        }

        #slider figure img {
            width: 20%; /* Keep the photo size the same */
            height: 100%;
            object-fit: cover;
        }
    </style>
<body>
<div id="slider">
    <figure>
        <img src="src/wat-welc.png" alt="Slide 1">
        <img src="src/NB.png" alt="Slide 2">
        <img src="src/Sketchers.png" alt="Slide 3">
        <img src="src/Nikey.png" alt="Slide 4">
        <img src="src/wat-welc.png" alt="Slide 1"> <!-- Duplicate the first image -->
    </figure>
</div>
<script>
    const slider = document.getElementById('slider');
    const figure = document.querySelector('#slider figure');
    
    let counter = 1;
    const size = 20; // 100% / number of images

    function transitionEndHandler() {
        if (counter === 5) {
            figure.style.transition = 'none';
            figure.style.transform = `translateX(0%)`;
            setTimeout(() => {
                figure.style.transition = 'transform 4s ease-in-out'; /* Increase the animation time to 4 seconds */
            }, 50);
            counter = 1;
        }
    }

    figure.addEventListener('transitionend', transitionEndHandler);

    setInterval(() => {
        figure.style.transform = `translateX(${-size * counter}%)`;
        counter++;
    }, 5000);
</script>
</body>

