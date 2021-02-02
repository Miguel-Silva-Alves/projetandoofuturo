$(document).ready(function(){
    $(".invisiveis").hide()
    $("#onick").hide()
    $("#BConfirmar").click(function(){
        var nick = $("#nick").val()
        var senha = $("#senha").val()
        //chamar o ajax para validar o login
        //ajax para verificar se pode logar ou não
        $.ajax({
            url: "http://souzamanutencoes.com/projetandoofuturo/GetUsuario.php",// Destino. Pode ser externo (site) ou local (arquivo)
            type: 'POST', // O método de envio. GET ou POST
            data: {
                "nick_name": nick,
                "senha": senha
            },
            success: function(msg) {
                if(msg["status"]){
                    retornar = processa(msg);
                    if(retornar.length==1){
                        $(location).attr('href', 'index.html?nick_namelogado='+nick+retornar[0]);
                    }else{
                        //open modal com escolha entre tipos de usuario disponivel
                    }
                }else{
                    $("#nick").val("")
                    $("#senha").val("")
                }
                //processaResposta(msg);    
            },
            error: function(request, status, erro) {
                console.log(erro);
            }
        
        });
        function processa(msg){
            retorno = []
            for(key in msg){
                if(msg[key] && key!="status"){
                    retorno.push(key)
                }
            }
            return retorno
        }
    })

    $("#BCadastrar").click(function(){
        $(location).attr('href', "CadastrarUsuario.html");
    })

    $("#nick").focusout(function(){
        $.ajax({
            url: "http://souzamanutencoes.com/projetandoofuturo/GetUsuario.php",// Destino. Pode ser externo (site) ou local (arquivo)
            type: 'POST', // O método de envio. GET ou POST
            data: {
                "nick_name_verificar": $("#nick").val()
            },
            success: function(msg) {
                console.log(msg)
                if(msg["status"]){
                    if($("#nick").hasClass("is-valid")){
                        $("#nick").removeClass("is-valid")
                    }
                    $("#nick").addClass("is-invalid")  
                    
                    
                }else{
                    if($("#nick").hasClass("is-invalid")){
                        $("#nick").removeClass("is-invalid")
                    }
                    $("#nick").addClass("is-valid")
                     
                }
                                       
                    //processa(msg);   
            },
            error: function(request, status, erro) {
                console.log(erro);
            }
        });
        
    })

    $("#senha2").focusout(function(){
        if($("#senha2").val()==$("#senha").val()){
           
            if($("#senha2").hasClass("is-invalid")){
                $("#senha2").removeClass("is-invalid")
                $("#senha").removeClass("is-invalid")
            }
            $("#senha2").addClass("is-valid") 
            $("#senha").addClass("is-valid")
        }else{
            if($("#senha2").hasClass("is-valid")){
                $("#senha2").removeClass("is-valid")
                $("#senha").removeClass("is-valid")
            }
            $("#senha2").addClass("is-invalid")  
            $("#senha").addClass("is-invalid")
            
            
        }
    })
    
    //verificando o cep
    $("#cep").keyup(function(){
        if($("#cep").val().length==8){
            $.ajax({
                url: "https://viacep.com.br/ws/"+$("#cep").val()+"/json/unicode/",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'GET', // O método de envio. GET ou POST
                success: function(msg) {
                    console.log(msg)
                    processaRespostaCep(msg);    
                },
                error: function(request, status, erro) {
                    alert(erro);
                }
            });
        }
        
    })

    function processaRespostaCep(msg){
        $(".invisiveis").show()
        $("#logradouro").val(msg["logradouro"])
        $("#cidade").val(msg["localidade"])
        $("#estado").val(msg["uf"])
        //$("#logradouro").val(msg["logradouro"])

    }


    $(".escolha").click(function(){
        $("#bodyEscolha").hide();
        $("#enviando_cadastro").show()
    })

    $("#avaliador").click(function(){
        $("#exampleModalLabel").html("AVALIADOR")
        $("#bodyAvaliador").show()
    })
    $("#desenvolvedor").click(function(){
        $("#exampleModalLabel").html("DESENVOLVEDOR")
        $("#bodyDesenvolvedor").show()
        $("#enviando_cadastro").show()
    })
    $("#consumidor").click(function(){
        $("#exampleModalLabel").html("CONSUMIDOR")
        $("#bodyConsumidor").show()
    })

    $("#dcomum").click(function(){
        $("#bodycomumpro").hide()
        if($("#exampleModalLabel").html()=="AVALIADOR"){
            $("#exampleModalLabel").html("Avaliador Comum")
            $("#bodyConsumidor").show()
            
        }else{
            $("#exampleModalLabel").html("Desenvolvedor Comum")
            $("#bodyDesenvolvedorComum").show()
        }

       
        $("#enviando_cadastro").show()

    })
    $("#dpro").click(function(){
        if($("#exampleModalLabel").html()=="AVALIADOR"){
            $("#exampleModalLabel").html("Avaliador Pro")
        }else{
            $("#exampleModalLabel").html("Desenvolvedor Pro")
        }
        $("#bodycomumpro").hide()
        $("#bodyPRO").show()
        $("#enviando_cadastro").show()
    })
    

    $("#enviando_cadastro").click(function(){
        
        var tipo = $("#exampleModalLabel").html()
        if(tipo=="AVALIADOR"){
            //console.log("avaliador")
            $.ajax({
        
                url: "http://souzamanutencoes.com/projetandoofuturo/PostDadosAvaPro.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'POST', // O método de envio. GET ou POST
                data: {
                    "nick_name": $("#onick").html(),
                    "Local": $("#avaliadorLocal").val(),
                    "LinkCurriculo": $("#avaliadorLattes").val()
                },
                success: function(msg) {
                    console.log(msg)
                    $("#bodyAvaliador").hide()
                    $("#bodycomumpro").show()
                    //processaResposta(msg);    
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            
            });
        }else if(tipo=="CONSUMIDOR"){
            console.log("consumidor")
            $.ajax({
        
                url: "http://souzamanutencoes.com/projetandoofuturo/PostConsumidor.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'POST', // O método de envio. GET ou POST
                data: {
                    "nick_name": $("#onick").html(),
                    "sexo": $("#inputSexoConsumidor").val(),
                },
                success: function(msg) {
                    console.log(msg)
                    $(location).attr('href', 'index.html?nick_namelogado='+$("#onick").html()+"cc");
                    //processaResposta(msg);    
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            
            });
        }else if(tipo=="DESENVOLVEDOR"){
            $.ajax({
        
                url: "http://souzamanutencoes.com/projetandoofuturo/PostDesenvolvedor.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'POST', // O método de envio. GET ou POST
                data: {
                    "nick_name": $("#onick").html(),
                    "link_lattes": $("#urlDesenvolvedor").val(),
                },
                success: function(msg) {
                    $('#bodyDesenvolvedor').hide()  
                    $("#bodycomumpro").show() 
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            
            });
        }else if(tipo=="Desenvolvedor Pro"){

            $.ajax({
        
                url: "http://souzamanutencoes.com/projetandoofuturo/PostDadosDesenPro.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'POST', // O método de envio. GET ou POST
                data: {
                    "nick_name": $("#onick").html(),
                    "nomeBanco": $("#inputNomeBancoPro").val(),
                    "agencia": $("#inputNumeroAgencia").val(),
                    "tipoConta": $("#inputTipoConta").val(),
                    "numeroConta": $("#inputNumeroConta").val()
                },
                success: function(msg) {
                    console.log(msg)
                    $(location).attr('href', 'index.html?nick_namelogado='+$("#onick").html()+"dp");
                    //processaResposta(msg);    
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            
            });
        }else if(tipo=="Avaliador Pro"){
            $.ajax({
        
                url: "http://souzamanutencoes.com/projetandoofuturo/PostDadosAvaPro.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'POST', // O método de envio. GET ou POST
                data: {
                    "nick_name": $("#onick").html(),
                    "NomeBanco": $("#inputNomeBancoPro").val(),
                    "Agencia": $("#inputNumeroAgencia").val(),
                    "TipoConta": $("#inputTipoConta").val(),
                    "NumeroConta": $("#inputNumeroConta").val()
                },
                success: function(msg) {
                    console.log(msg)
                    $(location).attr('href', 'index.html?nick_namelogado='+$("#onick").html()+"ap");   
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            
            });
        }else if(tipo=="Desenvolvedor Comum"){
            $.ajax({
                url: "http://souzamanutencoes.com/projetandoofuturo/PostDesenvolvedor.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'POST', // O método de envio. GET ou POST
                data: {
                    "nick_name": $("#onick").html(),
                    "instituicao": $("#inputInstituicao").val()
                },
                success: function(msg) {
                    console.log(msg)
                    $(location).attr('href', 'index.html?nick_namelogado='+$("#onick").html()+"dc");
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            
            });
        }else{
            //Avaliador Comum
            $.ajax({
                url: "http://souzamanutencoes.com/projetandoofuturo/PostDadosAvaPro.php",// Destino. Pode ser externo (site) ou local (arquivo)
                type: 'POST', // O método de envio. GET ou POST
                data: {
                    "nick_name": $("#onick").html(),
                    "sexo": $("#inputSexoConsumidor").val() //fiz isso apenas para evitar ficar criando mais divs e tendo que ficar escondendo
                },
                success: function(msg) {
                    console.log(msg)
                    $(location).attr('href', 'index.html?nick_namelogado='+$("#onick").html()+"ac"); 
                },
                error: function(request, status, erro) {
                    console.log(erro);
                }
            
            });
        }
    })

    //realiza o cadastro
    //falta a verificacao dos parametros
    $("#EnviarForma").click(function(){
        if(!validarcampos()){
            alert("Campos preenchidos incorretamente!")
        }else{
            var formData = new FormData(document.getElementById("formularioUsuario"));
            formData.append('tipoarquivo', "foto");
            $.ajax({
                            
                url: 'http://souzamanutencoes.com/projetandoofuturo/PostArquivo.php',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(dataa) {
                        console.log(dataa["id"]);
                        var inf = {
                            "nick_name": $("#nick").val(),
                            "nome": $("#nome").val(),
                            "senha": $("#senha").val(),
                            "cidade": $("#cidade").val(),
                            "estado": $("#estado").val(),
                            "logradouro": $("#logradouro").val(),
                            "CEP": $("#cep").val(),
                            "numero": $("#numero").val(),
                            "nivelescolaridade": $("#nivelescolaridade").val(),
                            "idArquivo" : dataa["id"]
                        }


                        $.ajax({
                            url: "http://souzamanutencoes.com/projetandoofuturo/PostUsuario.php",// Destino. Pode ser externo (site) ou local (arquivo)
                            type: 'POST', // O método de envio. GET ou POST
                            data: inf,
                            success: function(msg) {
                                console.log(msg)
                                $("#exampleModal3").modal("show");
                                $("#onick").html($("#nick").val())
                                $("#enviando_cadastro").hide()
                                $("#bodyDesenvolvedor").hide()
                                $("#bodyAvaliador").hide()
                                $("#bodyConsumidor").hide()
                                $("#bodyPRO").hide()
                                $("#bodycomumpro").hide()
                                $("#bodyDesenvolvedorComum").hide()
                                //processaRespostaCep(msg);    
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


})
function validarcampos(){
    if($("#nick").hasClass("is-invalid") || $("#senha").hasClass("is-invalid") || $("#senha2").hasClass("is-invalid")){
        return false;
    }
    return true
}



