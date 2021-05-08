
    let btn = document.getElementById('moon');
    let darkMode = localStorage.getItem('darkMode');

    function enableMode(){
        document.body.classList.add("dark-theme");
        localStorage.setItem('darkMode','enable');
        btn.src = "./images/sun.png";
    }

    function disableMode(){
        localStorage.setItem('darkMode',null);
        document.body.classList.remove("dark-theme");
        btn.src = "./images/moon.png";
    }

    if(darkMode == 'enable'){
        enableMode();
    }

    btn.addEventListener('click',()=>{
        darkMode = localStorage.getItem("darkMode");
        if(darkMode != "enable"){
            enableMode();
            console.log('hello workdd');
        }
        else{
            disableMode();
        }
    })