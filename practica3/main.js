function validar() {
    var cedula = document.getElementById('cedula');

    hidden();
    if(cedula.value.length != 11) {
        esInvalida();
        return;
    }

    var arrCel = cedula.value;        //Arreglo que contiene todos los catacteres de la cedula
    var check = parseInt(arrCel[10]); //El digito que confirmara si es valida
    var arrImpares = [];
    var arrPares = [];
    var total = 0;

    /* Primero se revisa cada caracter para separar los pares de los impares */
    for(var i = 0; i < 11; ++i) {
        /* Se revisa los pares del arreglo */
        if(i % 2 == 1) {
            var multiplicado = parseInt(arrCel[i]) * 2;

            /* Si es igual o mayor que 10 se separan los caracteres
             * para luego sumarse
            */
            if(multiplicado >= 10) {
                var m = multiplicado.toString();
                multiplicado = (parseInt(m[0]) + parseInt(m[1]));
            }

            arrPares.push(multiplicado);

        } else {
            arrImpares.push(parseInt(arrCel[i]));
        }
    }

    /* Se suman el total de los pares e impares */
    for(var i = 0; i < arrImpares.length -1; ++i) {
        total += arrImpares[i];
    }

    for(var i = 0; i < arrPares.length; ++i) {
        total += arrPares[i];
    }

    /* (10 - X) = check , X es el residuo del total que dio la suma */
    var mod10 = 10 - (total % 10);
    
    if(check == mod10) {
        esValida();
    } else {
        esInvalida();
    }

    function esValida() {
        var div = document.getElementById('valida');
        div.className = "";
        div.className = "validacion valida";
    }

    function esInvalida() {
        var div = document.getElementById('invalida');
        div.className = "";
        div.className = "validacion invalida";
    }

    function hidden() {
        var valida = document.getElementById('valida');
        var invalida = document.getElementById('invalida');
        valida.className = "hidden";
        invalida.className = "hidden";
    }
}
