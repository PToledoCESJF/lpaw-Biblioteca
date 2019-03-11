function mask(v, mask) {
    var val = v.value;
    var maskared = "";
    var k = 0;
    for (i = 0; i < mask.length; i++) {
        if (mask[i] === "#") {
            if (typeof (val.value[k]) !== "undefined" && val.value[k] !== null) {
                maskared += val.value[k];
                k++;
            }
        } else {
            if (typeof (mask[i])) {
                maskared += mask[i];
            }
        }
    }
    val.value = maskared;
}

function maskCpf(i) {
    var v = i.value;

    if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length - 1);
        return;
    }

    i.setAttribute("maxlength", "14");
    if (v.length === 3 || v.length === 7)
        i.value += ".";
    if (v.length === 11)
        i.value += "-";

}

function maskTelefone(tel) {
    var valor = tel.value;

    if (isNaN(valor[valor.length - 1])) { // impede entrar outro caractere que não seja número
        tel.value = valor.substring(0, valor.length - 1);
        return;
    }

    tel.setAttribute("maxlength", "14");
    if (valor.length === 1)
        tel.value = "(" + tel.value;
    if (valor.length === 3)
        tel.value += ")";
    if (valor.length === 8)
        tel.value += "-";
    if (valor.length === 14) {
        var cel = "";
        for (i = 0; i < valor.length; i++) {
            if (i === 8) {
                cel += tel.value[i + 1];
            } else if (i === 9) {
                cel += "-";
            } else {
                cel += tel.value[i];
            }
        }
        tel.value = cel;
    }
}

function maskMoney(val) {
    var valor = val.value;
    /*
     if (isNaN(valor[valor.length - 1])) { // impede entrar outro caractere que não seja número
     val.value = valor.substring(0, valor.length - 1);
     return;
     }
     */
    if (valor.length >= 3) {
        var valSemVir = "";
        var j = 0;
        for (var i = 0; i < valor.length - 1; i++) {
            if (val.value[i] === ",") {
                j++;
                valSemVir += val.value[j++];
            } else {
                valSemVir += val.value[j++];
            }
        }
        var nVal = "";
        var k = 0;
        var t = valor.length;
        
        for (var x = 0; x < t; x++) {
            if (x === t - 3) {
//            COLOCAR UM SUBSTRING AQUI.
                nVal += ",";
//            nVal = valSemVir.substring(0, t-2) + "," + valSemVir.substring(t-2, t);
            } else {
                nVal += valSemVir[k++];
            }
            
            document.getElementById("semV").innerHTML = "sem virgula " + valSemVir;
            document.getElementById("texto").innerHTML = "x = " + x + " k = " + k + " t = " + t;
        
        }
        val.value = nVal;
    }
}

function mostrarPlace(c, texto) {
    var campo = c;
    campo.setAttribute("placeholder", texto);
}

function esconderPlace(c) {
    var campo = c;
    campo.removeAttribute("placeholder");
}


function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
//Funcao: MascaraMoeda
//Sinopse: Mascara de preenchimento de moeda
//Parametro:
//   objTextBox : Objeto (TextBox)
//   SeparadorMilesimo : Caracter separador de milésimos
//   SeparadorDecimal : Caracter separador de decimais
//   e : Evento
//Retorno: Booleano
//Autor: Gabriel Fróes - www.codigofonte.com.br
//-----------------------------------------------------
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if ((whichCode === 13) || (whichCode === 0) || (whichCode === 8)) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) === -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) !== '0') && (objTextBox.value.charAt(i) !== SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!== -1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len === 0) objTextBox.value = '';
    if (len === 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len === 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j === 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}



