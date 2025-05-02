const button = document.querySelector('.trigger'),
    addclas = document.querySelector('nav');
button.addEventListener('click', function(){
    addclas.classList.toggle('show');
});

const submenu = document.querySelectorAll('.has-child')
    submenu.forEach((menu) => menu.addEventListener('click', toggle));

    function toggle(){
        submenu.forEach((item) => item != this ? item.classList.remove('expand') : null);
        if(this.classList != 'expand'){
            this.classList.toggle('expand');
        }
    }