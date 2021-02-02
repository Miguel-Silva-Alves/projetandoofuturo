let NomesProjetos=[]
let tipouser;
let isclicked=false;
//Eqto a pagina carrega, faço uma requisição para pegar todos os alimentos e salvo na variavel global

$.ajax({
    url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",// Destino. Pode ser externo (site) ou local (arquivo)
    type: 'GET', // O método de envio. GET ou POST
    data: {
        "JustNomes": true
    },
    success: function(msg) {
        for(var x=0;x<msg["nomes"].length;x++){
            NomesProjetos.push(msg["nomes"][x]["nome"])
        }
        //processa(msg);    
    },
    error: function(request, status, erro) {
        console.log(erro);
    }

});


//EXIBIÇÃO DO FEED E CARREGAMENTO DE CONTEUDO
//chama minha funcao ao carregar a pagina
var ListaComIds = []
var entrada = null;
$(document).ready(function(){
    $("#bodyModalAvaliadorInformacoes").hide()
    $("#modificadorsenha").hide()
    $("#alterandoimagem").hide()
    $("#buscar").hide()
    var url_atual = window.location.href;
    var urlList = url_atual.split("nick_namelogado=")
    if(urlList.length>1){
        entrada = urlList[1];
        var nick_namelogado = entrada.substring(0,entrada.length-2);
        var tipo = entrada.substring(entrada.length-2)
        tipouser = tipo
        definindocomoTipo(tipo)
    }else{
        var nick_namelogado = null
        console.log("nao logado")
    }

    if(nick_namelogado==null){

    }else{
        $("#minhaarea").click(function(){
            $(location).attr('href', "boot - pag5 - Eu.html?nick_namelogado="+entrada);
        })
    }

    $("#iconepesquisa").click(function(){
        $("#retangulo3").css("width","500px");
        $("#buscar").show()
    })

    $("#retangulo3").focusout(function(){
        $("#retangulo3").css("width","170px");
        $("#buscar").hide()
    })


    $("#info").click(function(){
        if(isclicked){
            $("#bodyModalAvaliadorInformacoes").hide()
        }else{
            $("#bodyModalAvaliadorInformacoes").show()
        }
        
        isclicked = !isclicked;
    })

    $("#enviando_avaliacao").click(function(){
        var avaliacao = $("#observacao").val()
        if(avaliacao!=""){
            var nota = Number($("#notaavalaiacao").val())
            var codigo = Number($(this).attr("name"))
            var data = new Date();
            var str_data = data.getDate()+'/'+ (data.getMonth()+1)+'/'+data.getFullYear();
            var str_hora = data.getHours() + ':' + data.getMinutes();
            if($("#modalNick_name").text()!="null"){
                if(tipouser=="ap" && $("#modalNick_name").attr("name")=="pro"){
                    $.ajax({
                        url: "http://souzamanutencoes.com/projetandoofuturo/PostProjeto.php",// Destino. Pode ser externo (site) ou local (arquivo)
                        type: 'POST', // O método de envio. GET ou POST
                        data: {
                            "codigo": codigo,
                            "nick_name_pro": $("#modalNick_name").text(),
                            "observacao": avaliacao,
                            "nota": nota,
                            "dataHora": str_data+" - "+str_hora,
                            "nick_pro_avaliador": nick_namelogado
                        },
                        success: function(msg) {
                            if(msg["status"]){
                                $("#modalAvaliador").modal("hide")
                            }
                            //processa(msg);    
                        },
                        error: function(request, status, erro) {
                            console.log(erro);
                        }
                    
                    });
                }else{
                    $.ajax({
                        url: "http://souzamanutencoes.com/projetandoofuturo/PostProjeto.php",// Destino. Pode ser externo (site) ou local (arquivo)
                        type: 'POST', // O método de envio. GET ou POST
                        data: {
                            "codigo": codigo,
                            "nick_avaliador": nick_namelogado,
                            "observacao": avaliacao,
                            "nota": nota
                        },
                        success: function(msg) {
                            if(msg["status"]){
                                $("#modalAvaliador").modal("hide")
                            }
                            //processa(msg);    
                        },
                        error: function(request, status, erro) {
                            console.log(erro);
                        }
                    
                    });
                    console.log("else",nota, avaliacao, codigo)
                }
            }
           
        }
    })

    $( "#buscar" ).autocomplete({
        minLength: 3,//só começa a procurar depois que digitou 2 caracteres
        source: NomesProjetos,
        select: function (event, selecionado) {
            
            console.log(selecionado.item.value)
            printarnoinput(selecionado.item.value)
            //$('#buscar').val(selecionado.item.value)
            return false;
        }
    });

    function printarnoinput(valor){
        //funcao que eu trago ele para a frente
        $('#buscar').val(valor)
    }

    //seleciono os ids e mando para a função carrega
    $.ajax({
        url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",// Destino. Pode ser externo (site) ou local (arquivo)
        type: 'GET', // O método de envio. GET ou POST
        data:{
            "JustIds" : true
        },
        success: function(aa) {
            console.log(aa);
            ListaComIds = aa;
            controle(4);
            //processaResposta(msg);    
        },
        error: function(request, status, erro) {
            console.log(erro);
        }
    });

    


    

});


$(document).on('click', ".configuration",function(){
    var idProjeto = $(this).attr("id")
    $.ajax({
        type: "GET",
        url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",
        data: {
            "only": idProjeto
        },
            
        success: function(m){
            console.log(m)
            colocarNoModal(m[0]);
            
        },
        error:function(request, status,erro){
            console.log(erro)
            //$('#loading').html("erro...").fadeIn('fast');
        }
    });

    $.ajax({
        url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",// Destino. Pode ser externo (site) ou local (arquivo)
        type: 'GET', // O método de envio. GET ou POST
        data: {
            "codigoProjetoComRetornoDoDesenvolvedor": idProjeto
        },
        success: function(msg) {
            console.log(msg)
            if(msg["pro"]!=null){
                $("#modalNick_name").text(msg["pro"])
                $("#modalNick_name").attr("name","pro")
            }else{
                $("#modalNick_name").text(msg["comum"])
                $("#modalNick_name").attr("name","comum")
            }
            
            //processa(msg);    
        },
        error: function(request, status, erro) {
            console.log(erro);
        }
    
    });
})

function colocarNoModal(m){
    $("#modalAvaliador").modal("show")
    $("#enviando_avaliacao").attr("name",m["codigo"])
    console.log(m)
    $("#modalNome").text(m["nome"])
    $("#modalResumo").text(m["resumo"])
    $("#modalImagem").html("")
    $("#modalPdf").html("")
    pegaArquivo(m["ImagemP"],$("#modalImagem"),false)
    pegaArquivo(m["PDF"],$("#modalPdf"),true)
}


var cont = 0

function controle(qnt){
    if(cont+qnt<=ListaComIds.length){
        for(var x=0;x<qnt;x++){
            carrega(ListaComIds,cont)
            cont+=1
        }
    }
    
}


//function carrega
function carrega(msg, i){
    //busca projeto por projeto
    $.ajax({
        type: "GET",
        url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",
        data: {
            "only": msg[i]["codigo"]
        },
            
        success: function(m){
            console.log(m)
            adicionaNoFeed(m[0]);
        },
        error:function(request, status,erro){
            console.log(erro)
            //$('#loading').html("erro...").fadeIn('fast');
        }
    });
    
}
    //$('#loading').html("<img src='img/loader.gif'/> Carregando Feeds...").fadeIn('fast');

function adicionaNoFeed(dicionario){
    if(tipouser=="ap" || tipouser=="ac"){
        if(dicionario["Pro"]){
            $("#aquiAdiciona").append(
                "<hr>",
                `<div id='${dicionario["codigo"]}'><li class='media retangulos' id='li${dicionario["codigo"]}' style="border-style: groove; border-color: gold;"><div class='media-body'><h5 class='mt-0 mb-1'>${dicionario["nome"]}</h5>${dicionario['resumo']}</div></li><a href='boot - pag6 - 3D.html'><div class='links3d'>3D</div></a><a href='boot - pag3 - Pdf.html?nick_namelogado=${entrada}&codigo=${dicionario["codigo"]}'><div class="linkspdf">PDF</div></a><span class="iconify" id="pago" data-inline="false" data-icon="ri:vip-diamond-fill" style="color: #c4cf3e; font-size: 65px;"></span><div class="configuration" id='${dicionario["codigo"]}' style="margin-left: 750px; float:right; margin-top: -180px;"><span class="iconify" data-inline="false" data-icon="file-icons:config-ruby" style="font-size: 50px; color: red;" class="configuration"></span></div></div>`
            )
        }else{
            $("#aquiAdiciona").append(
                "<hr>",
                `<div id='${dicionario["codigo"]}'><li class='media retangulos' id='li${dicionario["codigo"]}'><div class='media-body'><h5 class='mt-0 mb-1'>${dicionario["nome"]}</h5>${dicionario['resumo']}</div></li><a href='boot - pag6 - 3D.html'><div class='links3d'>3D</div></a><a href='boot - pag3 - Pdf.html?nick_namelogado=${entrada}&codigo=${dicionario["codigo"]}'><div class="linkspdf">PDF</div></a><div class="configuration" id='${dicionario["codigo"]}' style="margin-left: 750px; float:right; margin-top: -180px;"><span class="iconify" id='${dicionario["codigo"]}' data-inline="false" data-icon="file-icons:config-ruby" style="font-size: 50px; color: red;" class="configuration"></span></div></div>`
            )
        
        }
    }else{
        if(dicionario["Pro"]){
            $("#aquiAdiciona").append(
                "<hr>",
                `<div id='${dicionario["codigo"]}'><li class='media retangulos' id='li${dicionario["codigo"]}' style="border-style: groove; border-color: gold;"><div class='media-body'><h5 class='mt-0 mb-1'>${dicionario["nome"]}</h5>${dicionario['resumo']}</div></li><a href='boot - pag6 - 3D.html'><div class='links3d'>3D</div></a><a href='boot - pag3 - Pdf.html?nick_namelogado=${entrada}&codigo=${dicionario["codigo"]}'><div class="linkspdf">PDF</div></a><span class="iconify" id="pago" data-inline="false" data-icon="ri:vip-diamond-fill" style="color: #c4cf3e; font-size: 65px;"></span></div>`
            )
        }else{
            $("#aquiAdiciona").append(
                "<hr>",
                `<div id='${dicionario["codigo"]}'><li class='media retangulos' id='li${dicionario["codigo"]}'><div class='media-body'><h5 class='mt-0 mb-1'>${dicionario["nome"]}</h5>${dicionario['resumo']}</div></li><a href='boot - pag6 - 3D.html'><div class='links3d'>3D</div></a><a href='boot - pag3 - Pdf.html?nick_namelogado=${entrada}&codigo=${dicionario["codigo"]}'><div class="linkspdf">PDF</div></a></div>`
            )
        
        }
    }  
    pegaArquivo(dicionario["ImagemP"], $("#li"+dicionario["codigo"], false))
}

function pegaArquivo(idArquivo, onde, embed){
    $.ajax({
        url: "http://souzamanutencoes.com/projetandoofuturo/GetArquivo.php",// Destino. Pode ser externo (site) ou local (arquivo)
        type: 'GET', // O método de envio. GET ou POST
        data:{
            "id":idArquivo
        }, 
        success: function(msg) {
            
            printa(msg, onde, embed)
            //console.log(msg)
            //processaResposta(msg);    
        },
        error: function(request, status, erro) {
            alert(erro);
        }
    });
}

function printa(msg,onde, imagem){
    console.log(msg)
    displayBase64Image(onde,msg["image"], imagem)
    //displayBase64Image($("#exibirErro"),msg["image"])
}

function displayBase64Image(placeholder, base64Image, embed) {
    // class="mr-3" style="border-radius: 30px;" width="150px" height="120px"
    if(!embed){
        $('<img>', {
            src: base64Image
        }).prependTo(placeholder).attr("class","mr-3").css("border-radius", "30px").attr("width","150px").attr("height","120px");    
    }else{
        $('<embed>', {
            src: base64Image
        }).prependTo(placeholder).attr("type","application/pdf").attr("width","500px").attr("height","530px");
        
    }
}

function definindocomoTipo(tipo){
    console.log(tipo)
    if(tipo=="cc"){
        $(".alterarDadosBancarios").hide()
    }else if(tipouser=="ap" || tipouser=="ac"){
        console.log("mais oxi")
    }
}

//carrego um projeto por vez
$(window).scroll(function(){   
    if($(window).scrollTop() + $(window).height() >= $(document).height()){
        controle(1);
    };
});