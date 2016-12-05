window.onload = function() {
    var menuBtn = document.getElementById('menu-btn');
    var sideNav = document.getElementById('side-nav');
    var isSideNavTogled = false;

    menuBtn.onclick = function() {
        if(isSideNavTogled) {
            sideNav.style.display = "none";
            isSideNavTogled = false;
        } else {
            sideNav.style.display = "block";
            sideNav.style.width = "70%";
            isSideNavTogled = true;
        }
    }
}
