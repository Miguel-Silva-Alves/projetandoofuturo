var entrada;
let codidoPdf;
$(document).ready(function(){
    var url_atual = window.location.href;
    retorno = login(url_atual,3)
    console.log(retorno)
    var nick_namelogado = retorno[0]
    var tipouser = retorno[1]
    var codigo = retorno[2]
    if(nick_namelogado==null){
        $(location).attr('href', "inicial.html");
    }


    console.log(nick_namelogado, tipouser, codigo)

    $("#paraofeed").click(function(){
        $(location).attr('href', "index.html?nick_namelogado="+nick_namelogado+tipouser);
    })

    $("#efetuando_compra").click(function(){
       
        
        $.ajax({
            type: "GET",
            url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",
            data: {
                "only": codigo
            },
                
            success: function(m){
                console.log(m)
                var par = $("#parcelitas").val()
                if($("#parcelitas").val()=="Choose..."){
                    par = null
                }
                cadastrarNotaFiscal(m[0]["codigo"], nick_namelogado, par, $("#selecionaformapagamento").val())
                pegarOpdf(m[0]["PDF"],m[0]["nome"])
            },
            error:function(request, status,erro){
                console.log(erro)
                //$('#loading').html("erro...").fadeIn('fast');
            }
        });
    })


    $.ajax({
        type: "GET",
        url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",
        data: {
            "only": codigo
        },
            
        success: function(m){
            console.log(m)
            codigoPdf = m[0]["PDF"]
            adicionaNaTela(m[0]);
        },
        error:function(request, status,erro){
            console.log(erro)
            //$('#loading').html("erro...").fadeIn('fast');
        }
    });

    $("#downloadPNG").click(function(){
        $.ajax({
            type: "GET",
            url: "http://souzamanutencoes.com/projetandoofuturo/GetProjetos.php",
            data: {
                "only": codigo
            },
                
            success: function(m){
                console.log(m)
                if(m[0]["Pro"]){
                    $("#valor").text("VALOR DO PROJETO: R$"+m[0]["Valor"]+",00")
                    //abrir modal
                    $("#compraModal").modal("show") 
                    $("#formparcelas").hide()
                    $("#formcartao").hide()
                }else{
                    pegarOpdf(m[0]["PDF"],m[0]["nome"])
                }
                
            },
            error:function(request, status,erro){
                console.log(erro)
                //$('#loading').html("erro...").fadeIn('fast');
            }
        });
        
        
    })

    function cadastrarNotaFiscal(codigo, nick, parcelas, forma){
        var data = new Date();
        var str_data = data.getDate()+'/'+ (data.getMonth()+1)+'/'+data.getFullYear();
        var str_hora = data.getHours() + ':' + data.getMinutes();
        $.ajax({
            url: "http://souzamanutencoes.com/projetandoofuturo/PostProjeto.php",// Destino. Pode ser externo (site) ou local (arquivo)
            type: 'POST', // O método de envio. GET ou POST
            data: {
                "codigoProjeto": codigo,
                "nick_name_consumidor": nick,
                "parcelas": parcelas,
                "hora": str_hora,
                "data": str_data,
                "formapagamento": forma
            },
            success: function(msg) {
                $("#compraModal").modal("hide")   
                //processa(msg);   
            },
            error: function(request, status, erro) {
                console.log(erro);
            }
        });
    }
    
    function pegarOpdf(id, nome){
        $.ajax({
            url: "http://souzamanutencoes.com/projetandoofuturo/GetArquivo.php",// Destino. Pode ser externo (site) ou local (arquivo)
            type: 'GET', // O método de envio. GET ou POST
            data:{
                "id":id
            }, 
            success: function(msg) {
                downloadPDF(msg["image"],nome)
            },
            error: function(request, status, erro) {
                alert(erro);
            }
        });
    }

    function  downloadPDF(pdf,titulo)  {
        
        
        const  downloadLink  =  document.createElement("a");
        const  fileName  =  titulo+".pdf" ;
    
        downloadLink.href  =  pdf ;
        downloadLink.download  =  fileName ;
        downloadLink.click();
    }

    function adicionaNaTela(map){
        $("#descricao").text(map["resumo"])
        $.ajax({
            url: "http://souzamanutencoes.com/projetandoofuturo/GetArquivo.php",// Destino. Pode ser externo (site) ou local (arquivo)
            type: 'GET', // O método de envio. GET ou POST
            data:{
                "id":map["PDF"]
            }, 
            success: function(msg) {
                
                displayBase64Image($("#pdfpdf"),msg["image"],map["Pro"])
            },
            error: function(request, status, erro) {
                alert(erro);
            }
        });
        

        $.ajax({
            url: "http://souzamanutencoes.com/projetandoofuturo/GetArquivo.php",// Destino. Pode ser externo (site) ou local (arquivo)
            type: 'GET', // O método de envio. GET ou POST
            data:{
                "id":map["ImagemP"]
            }, 
            success: function(msg) {
                
                displayBase64toImage($("#imagemprojeto"),msg["image"])   
            },
            error: function(request, status, erro) {
                alert(erro);
            }
        });
        



    }

    function displayBase64toImage(placeholder, base64Image) {
        $('<img>', {
            src: base64Image
        }).prependTo(placeholder).attr("class","card-img-top");
        
        //funciona
        //download("data:application/octet-stream;base64"+base64Image, "dlDataUrlText.jpeg", "application/octet-stream;base64");
    }

    function displayBase64Image(placeholder, base64Image, pago) {
        // class="mr-3" style="border-radius: 30px;" width="150px" height="120px"
        $('<embed>', {
            src: base64Image
        }).prependTo(placeholder).attr("type","application/pdf").attr("width","500px").attr("height","530px");
        if(pago){
            placeholder.append(`<span class="iconify" id="bloqueio" data-inline="false" data-icon="jam:padlock-f" style="color: #3b3b3b; font-size: 305px;"></span>`)
        }
        
    }

    jQuery("#selecionaformapagamento").change(function(){
        $("#formparcelas").hide()
        $("#formcartao").hide()
        if($("#selecionaformapagamento").val()=="Crédito"){
            $("#formparcelas").show()
            $("#formcartao").show() 
        }else if($("#selecionaformapagamento").val()=="Débito"){
            $("#formcartao").show() 
        }
    })

})

function login(url_atual,qnt){
    var urlList = url_atual.split("nick_namelogado=")
    if(urlList.length>1){
        entrada = urlList[1];
        segundaquebra = entrada.split("&")
        
        var terceira = segundaquebra[1].split("=")
        var codigo = terceira[1]
       
        var stringjunta = segundaquebra[0]
        if(stringjunta=="null"){
            var nick_namelogado = null
            var tipouser = null
        }else{
            var nick_namelogado = stringjunta.substring(0,stringjunta.length-2)
            var tipouser = stringjunta.substring(stringjunta.length-2)
        }
        
        
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


