$(document).ready(function(){
    var url_atual = window.location.href;
    var urlList = url_atual.split("nick_namelogado=")
    if(urlList.length>1){
        var entrada = urlList[1];
        var nick_namelogado = entrada.substring(0,entrada.length-2);
        var tipo = entrada.substring(entrada.length-2)
        
        definindocomoTipo(tipo)
    }else{
        var nick_namelogado = null
        $(location).attr('href', "inicial.html");
    }

    $("#novoProject").click(function(){
        $(location).attr('href', "boot - pag8 - NovoProjeto.html?nick_namelogado="+entrada);
    })

    $("#navegarparaofeed").click(function(){
        $(location).attr('href', "index.html?nick_namelogado="+entrada);
    })
    if(tipo=="dc" || tipo=="dp"){
        exibirMeusProjetos(tipo, nick_namelogado)
    }
    
    //meus projetos -> desenvolvedor comum

    $("#compradospormim").click(function(){
        
        exibirMinhasCompras(nick_namelogado);
    })
    
})

function exibirMinhasCompras(nick){
   
    $.ajax({
        url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",// Destino. Pode ser externo (site) ou local (arquivo)
        type: 'GET', // O método de envio. GET ou POST
        data: {
            "nick_name_compra": nick
        },
        success: function(msg) {
            console.log(msg)
            printarNaTelaOsTrem(msg)                      
                //processa(msg);   
        },
        error: function(request, status, erro) {
            console.log(erro);
        }
    });
}

function exibirMeusProjetos(tipo, nick){
    if(tipo=="dc"){
        var inf = {
            "nick_name": nick
        }
    }else if(tipo=="dp"){
        var inf = {
            "nick_name_pro": nick
        }
    }
    $.ajax({
        url: "http://souzamanutencoes.com/projetandoofuturo/PostDesenvolvedor.php",// Destino. Pode ser externo (site) ou local (arquivo)
        type: 'GET', // O método de envio. GET ou POST
        data: inf,
        success: function(msg) {
            printarNaTela(msg,nick,tipo);    
        },
        error: function(request, status, erro) {
            console.log(erro);
        }
        
    });

    
}

function printarNaTela(msg, nick, tipo){
    console.log(msg)
    $("#meusProjetosaqui").html("")
    for(var x=0;x<msg["codigos"].length;x++){
        console.log(msg["codigos"][x]["Codigo"]) //codigo do projeto desenvolvido pelo desenvolvedor logado
        if(tipo=="dc"){
            var inf = {
                "nick_name":nick,
                "codigo":msg["codigos"][x]["Codigo"]
            }
        }else if(tipo=="dp"){
            var inf = {
                "nick_name_pro":nick,
                "codigo":msg["codigos"][x]["Codigo"]
            }
        }
        $.ajax({
            url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",// Destino. Pode ser externo (site) ou local (arquivo)
            type: 'GET', // O método de envio. GET ou POST
            data: inf,
            success: function(msg) {
                console.log(msg)
                printarNaTelaPart2(msg);    
            },
            error: function(request, status, erro) {
                console.log(erro);
            }
        
        });
    }
    //$("#principal").append()
}

function printarNaTelaOsTrem(msg){
    $("#principal").show()
    console.log("to entreandoasofaopsg")
    $("#meusProjetosaqui").html("")
    for(var x=0;x<msg.length;x++){
        $("#meusProjetosaqui").append(`
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">Compra efeturada em: ${msg[x]["dataHora"]} - ${msg[x]["horaCompra"]}</strong>
                Projeto: ${msg[x]["nome"]}<br>Valor:${msg[x]["valor"]}
            </p>
        </div>`)
    }
    
}

function printarNaTelaPart2(msg){
    
    $("#meusProjetosaqui").append(`
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">Última modificação em: ${msg["data"]}</strong>
                ${msg["nome"]}
            </p>
        </div>`)
    
}

function definindocomoTipo(tipo){
    console.log(tipo)
    if(tipo=="cc"){
        $(".desenvolvedor").hide()
        $(".avaliador").hide()
    }else if(tipo=="dc" || tipo=="dp"){
        $(".consumidor").hide()
        $(".avaliador").hide()
    }
   
}