document.addEventListener("DOMContentLoaded", function() {
    /**Nav Toggle */
    
        const menuToggle = document.querySelector('.toggle_nav');
        const homeTransition = document.querySelector('.intro');
        const logoAnim = document.querySelector('.logo');
        const textTransition = document.querySelector('.text_container');
        const socialMediaTransitionForPhone = document.querySelector('.social');
        const countdownTransition = document.querySelector('.countdown_container');
    
    
    
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            homeTransition.classList.toggle('active');
            logoAnim.classList.toggle('active');
            textTransition.classList.toggle('active');
            socialMediaTransitionForPhone.classList.toggle('active');
            countdownTransition.classList.toggle('active');
        });
    
        /**================================================================================== */
        /**Countdown */
    
        const daysEl = document.getElementById('days');
        const hoursEl = document.getElementById('hours');
        const minutesEl = document.getElementById('minutes');
        const secondesEl = document.getElementById('secondes');
    
        const festival = '16 Jul 2021';
    
        function countdown() {
            const newFestivalDate = new Date(festival);
            const currentDate = new Date();
            const totalSecondes = (newFestivalDate - currentDate) / 1000;
    
            const days = Math.floor(totalSecondes / 3600 / 24);
            const hours = Math.floor(totalSecondes / 3600) % 24;
            const minutes = Math.floor(totalSecondes / 60) % 60;
            const secondes = Math.floor(totalSecondes) % 60;
    
            daysEl.innerHTML = days;
            hoursEl.innerHTML = hours;
            minutesEl.innerHTML = minutes;
            secondesEl.innerHTML = secondes;
        }
    
        function formatTime(time) {
            return time < 10 ? (`0${time}`) : time;
        }
    
        countdown();
    
        setInterval(countdown, 1000);
    
        /**================================================================================== */

        /**Push */

    const infosPush = "Le festival Nation Sounds ELECTRO BASS / DUB MUSIC / RAP";
    const secondInfosPush = "10% des recettes sont reversées à une association.";
    const Push = document.getElementById('push');
    const secondPush = document.getElementById('secondPush');

    let index = 0;

    function writePushText() {
        Push.innerHTML = infosPush.slice(0, index);
        secondPush.innerHTML = secondInfosPush.slice(0, index)
        index++;
        if(index > infosPush.length && secondInfosPush.length) {
            index = 0;
        }
    }

    setInterval(writePushText, 100);
});