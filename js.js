$(document).ready(function(){
    var url_atual = window.location.href;
    var urlList = url_atual.split("nick_namelogado=")
    if(urlList.length>1){
        var entrada = urlList[1];
        var nick_namelogado = entrada.substring(0,entrada.length-2);
        var tipo = entrada.substring(entrada.length-2)
        definindocomoTipado(tipo)
        console.log(nick_namelogado)
    }else{
        var nick_namelogado = null
        console.log("nao logado")
    }

    

    $("#formControlRange").on('change', function() {
        $("#valor").html(this.value)
    });


    // Quando enviado o formulário -> CADASTRO DE UM PROJETO
    $('#enviarProjeto').click(function () {
        var tit = $("#inputTitulo").val();
        var desc = $("#inputDescricao").val();
        var value = Number($("#valor").html());

        $.ajax({
            
            url: "http://souzamanutencoes.com/projetandoofuturo/PostProjeto.php",
            type: 'POST',
            data:{
                "nome" : tit,
                "valor" : value,
                "resumo" : desc,
                "visualiza" : "vazio",
                "data" : "27/01/2021"
            },
            success: function(msg) {
                console.log(msg);

                if($("#idImagem").val()!=""){
                    console.log("imagem")
                    var formData = new FormData(document.getElementById("formulario"));
                    formData.append('tipoarquivo', "foto");
                    $.ajax ({
                        url: 'http://souzamanutencoes.com/projetandoofuturo/PostArquivo.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(dataa) {
                            console.log(dataa["id"]);
                            //$("#formulario").append($("<input>").attr("type","hidden").attr("name","id_imagem").val(data["id"]))
                            //return data;
                            $.ajax({
                                url: "http://souzamanutencoes.com/projetandoofuturo/PostProjeto.php",
                                type: 'POST',
                                data:{
                                    "idArquivo" : dataa["id"],
                                    "codigo" : msg["id"],
                                    "oque" : "imagem"
                                },
                                success: function(anothermsg) {
                                    console.log(anothermsg)
                                },
                                error: function(arequest, astatus, aerro){
                                    console.log(aerro)
                                }
                            });
                        },
                        error: function(request, status, erro){
                            console.log(erro);
                        }
                    })
                }
        
                if($("#idPdf").val()!=""){
                    console.log("pdf")
                    var formData = new FormData(document.getElementById("formulario"));
                    formData.append('tipoarquivo', "pdf");
                    $.ajax({
                        
                        url: 'http://souzamanutencoes.com/projetandoofuturo/PostArquivo.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(dataa) {
                            console.log(dataa["id"]);
                            $.ajax({
                                url: "http://souzamanutencoes.com/projetandoofuturo/PostProjeto.php",
                                type: 'POST',
                                data:{
                                    "idArquivo" : dataa["id"],
                                    "codigo" : msg["id"],
                                    "oque" : "pdf"
                                },
                                success: function(anothermsg) {
                                    console.log(anothermsg)
                                },
                                error: function(arequest, astatus, aerro){
                                    console.log(aerro)
                                }
                            });
                        },
                        error: function(request, status, erro){
                            console.log(erro);
                        }
                    })
                }

                cadastrandoOdesenvolvimento(msg["id"])

            },
            error: function(request, status, erro){
                console.log(erro)
            }
        });

        function cadastrandoOdesenvolvimento(codigo){
            var data = new Date();
            var str_data = data.getDate()+'/'+ (data.getMonth()+1)+'/'+data.getFullYear();
            var str_hora = data.getHours() + ':' + data.getMinutes();
            if(tipouser=="dc"){
                $.ajax({
                    url: "http://souzamanutencoes.com/projetandoofuturo/PostDesenvolvedor.php",// Destino. Pode ser externo (site) ou local (arquivo)
                    type: 'POST', // O método de envio. GET ou POST
                    data: {
                        "nick_name": nick_namelogado,
                        "codigo": codigo,
                        "datahora": str_data+" - "+str_hora
                    },
                    success: function(msg) {
                        console.log(msg)
                        setarCampos()  
                    },
                    error: function(request, status, erro) {
                        console.log(erro);
                    }
                
                });
        
            }else{
                $.ajax({
                    url: "http://souzamanutencoes.com/projetandoofuturo/PostDesenvolvedor.php",// Destino. Pode ser externo (site) ou local (arquivo)
                    type: 'POST', // O método de envio. GET ou POST
                    data: {
                        "nick_name_pro": nick_namelogado,
                        "codigo": codigo,
                        "datahora": str_data+" - "+str_hora
                    },
                    success: function(msg) {
                        console.log(msg)
                        setarCampos()
                        //processa(msg);    
                    },
                    error: function(request, status, erro) {
                        console.log(erro);
                    }
                
                });
            }
        }
    });
    
})

function setarCampos(){
    $("#inputTitulo").val("");
    $("#inputDescricao").val("");
    $("#valor").html("")
    $("#idPdf").val("")
    $("#idImagem").val("")
}

let tipouser; 
function definindocomoTipado(tipo){
    tipouser=tipo;
    if(tipo=="dc"){
        $(".val").hide()
    }
}