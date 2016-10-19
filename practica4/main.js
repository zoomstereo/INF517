
function addMenuLevel_1(menu_1) {
    var createdElement = document.createElement('div');
    createdElement.className = "menu-1";
    createdElement.innerHTML = menu_1.nombre;

    //This one is for the red ones
    for(var i=0; i < menu_1.sub2.length; i++) {
        addMenuLevel_2(createdElement, menu_1.sub2[i]);
    }

    //Here I add the black boxes
    var menu = document.getElementById('menu');

    menu.appendChild(createdElement);
}

function addMenuLevel_2(parent, sub2) {
    var createdElement = document.createElement('div');
    createdElement.className = "menu-2";
    createdElement.innerHTML = sub2.nombre;

    for(var i=0; i < sub2.sub3.length; ++i) {
        addMenuLevel_3(createdElement, sub2.sub3[i]);
    }

    parent.appendChild(createdElement);
}

function addMenuLevel_3(parent, sub3) {
    var createdElement = document.createElement('div');
    createdElement.className = "menu-3";
    createdElement.innerHTML = sub3;

    parent.appendChild(createdElement);
}


for(var i=0; i< menu_json.length; ++i) {
    addMenuLevel_1(menu_json[i]);
}
