$(document).ready(function(){
    var url_atual = window.location.href;
    var urlList = url_atual.split("nick_namelogado=")
    if(urlList.length>1){
        var entrada = urlList[1];
        var nick_namelogado = entrada.substring(0,entrada.length-2);
        var tipo = entrada.substring(entrada.length-2)
    }else{
        var nick_namelogado = null
        $(location).attr('href', "inicial.html");
    }


    $("#navegarparaofeed").click(function(){
        $(location).attr('href', "index.html?nick_namelogado="+entrada);
    })

    $("#navegarparaomeu").click(function(){
        $(location).attr('href', "boot - pag5 - Eu.html?nick_namelogado="+entrada);
    })

})