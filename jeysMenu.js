$(document).ready(function(){
    console.log('porque nao entras?')
    var url_atual = window.location.href;

    retorno = login(url_atual,2)
    var nick_namelogado = retorno[0]
    var tipo = retorno[1]
    if(nick_namelogado==null){
        $("#manu").hide()
    }

     //informações do usuario
     $.ajax({
        type: "POST",
        url: "http://souzamanutencoes.com/projetandoofuturo/GetUsuario.php",
        data: {
            "nick_name": nick_namelogado,
            "imagem":true
        },
        
        success: function(m){
            $("#nomeUsuario").text(m["nome"])
            $.ajax({
                url: "http://souzamanutencoes.com/projetandoofuturo/GetArquivo.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'GET', // O método de envio. GET ou POST
                data:{
                    "id":m["id"]
                }, 
                success: function(msg) {
                    console.log(msg)
                    displayBase64ImageToMenu($("#imagemUsuario"),msg["image"])    
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            });
        },
        error:function(request, status,erro){
            console.log(erro)
            //$('#loading').html("erro...").fadeIn('fast');
        }
    });

    $("#redefinirsenha").click(function(){
        $('#exampleModal3').modal('show')
        $("#modificadorsenha").show()
        $("#exampleModalLabel").text("Alterar Senha")
    })

    $("#alterarimagem").click(function(){
        $('#exampleModal3').modal('show')
        $("#alterandoimagem").show()
        $("#exampleModalLabel").text("Alterar Imagem")
    })

    $("#sairDoTrem").click(function(){
        $(location).attr('href', "inicial.html");
    })

    //confirmar alterações no modal
    $("#enviando_anothers").click(function(){
        if($("#exampleModalLabel").text()=="Alterar Senha"){
            var senhantiga = $("#senha").val()
            var senhanova = $("#senha2").val()
            $.ajax({
                url: "http://souzamanutencoes.com/projetandoofuturo/PostUsuario.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'POST', // O método de envio. GET ou POST
                data:{
                    "nick_name" : nick_namelogado,
                    "nova_senha" : senhanova,
                    "antiga_senha" : senhantiga
                },
                success: function(aa) {
                    if(aa["status"]){
                        $('#exampleModal3').modal('hide')
                    }else{
                        $("#senha").val("")
                        $("#senha2").val("")
                    }
                    
                    //processaResposta(msg);    
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            });
        }else if($("#exampleModalLabel").text()=="Alterar Imagem"){
            var formData = new FormData(document.getElementById("formDaImagem"));
            formData.append('tipoarquivo', "foto");
            $.ajax({
                            
                url: 'http://souzamanutencoes.com/projetandoofuturo/PostArquivo.php',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(dataa) {
                        console.log(dataa["id"]);
                        console.log(nick_namelogado)

                        $.ajax({
                            url: "http://souzamanutencoes.com/projetandoofuturo/PostUsuario.php",// Destino. Pode ser externo (site) ou local (arquivo)
                            type: 'POST', // O método de envio. GET ou POST
                            data: {
                                "nick_name": nick_namelogado,
                                "idArquivoRedefinir": dataa["id"]
                            },
                            success: function(msg) {
                                $('#exampleModal3').modal('hide')
                                
                                alterarImagemCirculo(dataa["id"]);    
                            },
                            error: function(request, status, erro) {
                                console.log(erro);
                            }
                        });

                },
                error: function(request, status, erro){
                    console.log(erro);
                }
            })
        }
    })

    function alterarImagemCirculo(idArquivo){
        $.ajax({
            url: "http://souzamanutencoes.com/projetandoofuturo/GetArquivo.php",// Destino. Pode ser externo (site) ou local (arquivo)
            type: 'GET', // O método de envio. GET ou POST
            data:{
                "id":idArquivo
            }, 
            success: function(msg) {
                $("#imagemUsuario").html("")
                displayBase64ImageToMenu($("#imagemUsuario"),msg["image"])
                //console.log(msg)
                //processaResposta(msg);    
            },
            error: function(request, status, erro) {
                alert(erro);
            }
        });
    }

})

function displayBase64ImageToMenu(placeholder, base64Image) {
    // class="mr-3" style="border-radius: 30px;" width="150px" height="120px"
    // class=" mx-auto d-block" alt="..."> 
    $('<img>', {
        src: base64Image
    }).prependTo(placeholder).attr("class","mx-auto d-block").css("border-radius", "50%").attr("width","150px").attr("height","150px");
}

function login(url_atual,qnt){
    var urlList = url_atual.split("nick_namelogado=")
    if(urlList.length>1){
        entrada = urlList[1];
        segundaquebra = entrada.split("&")
        console.log(segundaquebra)
        if(segundaquebra.length>1){
            var terceira = segundaquebra[1].split("=")
            var codigo = terceira[1]
        }
        
        
       
        var stringjunta = segundaquebra[0]
        var nick_namelogado = stringjunta.substring(0,stringjunta.length-2)
        var tipouser = stringjunta.substring(stringjunta.length-2)
        
        //definindocomoTipo(tipo)
    }else{
        var nick_namelogado = null
        console.log("nao logado")
    }
    if(qnt==2){
        return [nick_namelogado,tipouser]
    } 
    return [nick_namelogado,tipouser,codigo]

}
