<?php

    include_once "Usuario.php";
    include_once "Projeto.php";
    include_once "Consumidor.php";
    include_once "Desenvolvedor.php";
    include_once "PreferenciasConsumidor.php";
    include_once "DesenvolvedorComum.php";
    include_once "DesenvolvedorPro.php";
    include_once "Grupo.php";
    include_once "DesenvolvedorGrupo.php";
    include_once "Compra.php";
    include_once "Avaliador.php";
    include_once "AvaliadorPro.php";
    include_once "AvaliadorComum.php";
    include_once "Emailsuser.php";
    include_once "Avalia.php";
    include_once "Avaliaçao.php";

    include_once "LocalDesenvolvedor.php";
    include_once "LinkReuniao.php";
    include_once "AreasAplicaçao.php";


    echo "<h1>Projeto</h1><br>";
    //Projeto::cadastrarProjeto(1, "Bonde de Rua",500, "Anda na rua",'2020-12-31',"Visualiza ae","cheganobonde", null);
    $projeto = Projeto::retornaProjetoUnico(1);
    for ($i = 0; $i < count($projeto); $i++) {
        echo "<p>" . $projeto[$i]["Codigo"] ."-".$projeto[$i]["nome"]. "</p>";
    }

    echo Projeto::inserirImagem("C:\\Users\\CRISTIANE\\Pictures\\ff.png",1);

    /*
    
    echo "<h1>USUARIO</h1><br>";
    //Usuario::cadastrarUsuario("Miguelzin123", "Miguel", "Medio", "123", "alpha1", "132135", "2020-12-20", "Eduardo Fenix", 200, "Douradinho", "1236545", "São Carlos", "São Paulo", "Brasil");
    //Usuario::editarUsuario("Miguelzin123", "Miguel Alves", "Faculdade", "123", "alpha1", "132135", "2020-12-20", "Eduardo Fenix", 200, "Douradinho", "1236545", "São Carlos", "São Paulo", "Brasil");
    $usuario = Usuario::retornaUsuario("Miguelzin123","alpha1");
    //Usuario::deletarUsuario("Miguelzin123");
    for($i=0;$i<count($usuario);$i++){
        echo "<p>".$usuario[$i]["Nick_name"]."-".$usuario[$i]["Senha"]."</p><br>";
    }
    
    echo "<h5>Redefinir Senha</h5><br>";
    Usuario::redefinirSenha("Miguelzin123","alpha1","omega300");
    
    $usuario = Usuario::retornaUsuario("Miguelzin123","omega300");
    for($i=0;$i<count($usuario);$i++){
        echo "<p>".$usuario[$i]["Nick_name"]."-".$usuario[$i]["Senha"]."</p><br>";
    }
    
    $lista =  Usuario::retornarUsuarios();
    for($i=0;$i<count($lista);$i++){
        echo "<p>".$lista[$i]["nick_name"]."-".$lista[$i]["nome"]."</p><br>";
    }


    //----------------------------------------------------------------------------------------------
    
    
    
    echo "<h1>Projeto</h1><br>";
    //Projeto::cadastrarProjeto(1, "Bonde de Rua",500, "Anda na rua",'2020-12-31',"Visualiza ae","cheganobonde", null);
    $projeto = Projeto::retornaProjetoUnico(1);
    for ($i = 0; $i < count($projeto); $i++) {
        echo "<p>" . $projeto[$i]["Codigo"] ."-".$projeto[$i]["nome"]. "</p>";
    }
    
    $projetoPdf = Projeto::retornaPDF(1);
    for ($i = 0; $i < count($projetoPdf); $i++) {
        echo "<p>LINK-> " . $projetoPdf[$i]["PDF_LINK"] . "</p>";
    }
    
    //Projeto::editarProjeto(1, "Bonde de Áereo",500, "Anda na rua",'2020-12-31',"Visualiza ae","cheganobonde", null);
    //Projeto::deletarProjeto(1);
    $projetos = Projeto::retornarProjetos();
    for ($i = 0; $i < count($projetos); $i++) {
    
        echo "<p>" . $projetos[$i]["Codigo"] . "</p>";
        echo "<p>" . $projetos[$i]["nome"] . "</p>";
        echo "<p>" . $projetos[$i]["Valor"] . "</p>";
        echo "<p>" . $projetos[$i]["Resumo"] . "</p>";
        echo "<p>" . $projetos[$i]["Data_Publicacao"] . "</p>";
        echo "<p>" . $projetos[$i]["Visualizacao_3D"] . "</p>";
        echo "<p>" . $projetos[$i]["PDF_LINK"] . "</p>";
        echo "<p>" . $projetos[$i]["id_grupo"] . "</p><br>";
    }
    
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>Links Reuniões</h1><br>";
    //LinkReuniao::cadastrarLinkReuniao("https//pp.com",1);
    //LinkReuniao::deletarLinkReuniao("https//pp.com",1);
    $links = LinkReuniao::retornarLinksReunioes();
    for ($i = 0; $i < count($links); $i++) {
    
        echo "<p>" . $links[$i]["CodigoProjeto"] . "</p>";
        echo "<p>" . $links[$i]["Link_reuniao"] . "</p>";
    }
   
   
   
    //----------------------------------------------------------------------------------------------
   
    echo "<h1>Consumidor</h1><br>";
    //Consumidor::cadastrarConsumidor("Miguelzin123", "Masculino");
    //Consumidor::deletarConsumidor("Miguelzin123"); //OK
    $consumidores = Consumidor::retornarConsumidores();
    for ($i = 0; $i < count($consumidores); $i++) {
        
        echo "<p>" . $consumidores[$i]["Nick_name"] . "</p>";
        echo "<p>" . $consumidores[$i]["sexo"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>Preferencias</h1><br>";
    //PreferenciasConsumidor::cadastrarPreferencia("Miguelzin123", "Carros");
    $preferencias = PreferenciasConsumidor::retornarPreferencias();
    //PreferenciasConsumidor::deletarPreferencias("Miguelzin123");
    for ($i = 0; $i < count($preferencias); $i++) {
        
        echo "<p>" . $preferencias[$i]["Nick_name"] . "</p>";
        echo "<p>" . $preferencias[$i]["preferencias"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>Desenvolvedor</h1><br>";
    //desenvolvedor::cadastrarDesenvolvedor("Miguelzin123","link");
    //desenvolvedor::deletarDesenvolvedor("Miguelzin123");
    //desenvolvedor::cadastrarDesenvolvedor("Fiel123","hhhppps.com");
    $desenvolvedores = desenvolvedor::retornarDesenvolvedores();
    for ($i = 0; $i < count($desenvolvedores); $i++) {
        echo "<p>";
        echo "<p>" . $desenvolvedores[$i]["nick_name"] . "</p>";
        echo "<p>" . $desenvolvedores[$i]["link_lattes"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>LocalDesenvolvedor</h1><br>";
    //LocalDesenvolvedor::cadastrarLocalDesenvolvedor("Miguelzin123","IFSP");
    //LocalDesenvolvedor::deletarLocalDesenvolvedor("Miguelzin123","IFSP");
    $locais = LocalDesenvolvedor::retornarLocaisDesenvolvedor();
    for ($i = 0; $i < count($locais); $i++) {
        echo "<p>";
        echo "<p>" . $locais[$i]["Nick_name"] . "</p>";
        echo "<p>" . $locais[$i]["lugar"] . "</p>";
        echo "<br>";
    }
    
    
    //----------------------------------------------------------------------------------------------
    
    
    echo "<h1>DesenvolvedorComum</h1><br>";
    //usuario::cadastrarUsuario("Fiel123", "Luiz", "Medio", "123", "fenix", "132135", "2020-12-20", "lUIZ Fenix", 200, "Douradinho", "1258522", "São Carlos", "São Paulo", "Brasil");
    //DesenvolvedorComum::cadastrarDesenvolvedorComum("Miguelzin123","Instito Federal");
    $desenvolvedoresComuns = DesenvolvedorComum::retornarDesenvolvedoresComum();
    for ($i = 0; $i < count($desenvolvedoresComuns); $i++) {
        echo "<p>";
        echo "<p>" . $desenvolvedoresComuns[$i]["Nick_name"] . "</p>";
        echo "<p>" . $desenvolvedoresComuns[$i]["instituicaoEnsino"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>Desenvolve Comum - Projeto</h1><br>";
    //DesenvolveCP::cadastrarDesenvolveCP(1,"Miguelzin123");
    //DesenvolveCP::deletarDesenvolveCP(1,"Miguelzin123"); //ok
    $codigo = DesenvolveCP::retornarCodigo("Miguelzin123");
    for ($i = 0; $i < count($codigo); $i++) {
        echo "<p>Just Codigo->" . $codigo[$i]["codigo"] . "</p>";
    }
    
    $desenvolve = DesenvolveCP::retornarDesenvolvesCP();
    for ($i = 0; $i < count($desenvolve); $i++) {
        echo "<p>";
        echo "<p>" . $desenvolve[$i]["Codigo"] . "</p>";
        echo "<p>" . $desenvolve[$i]["Nick_name"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>DesenvolvedorPro</h1><br>";
    
    //DesenvolvedorPro::cadastrarDesenvolvedorPro("Fiel123","ITAU","asd1","10","Poupanca");
    //DesenvolvedorPro::deletarDesenvolvedorPro("Fiel123");
    //DesenvolvedorPro::editarDesenvolvedorPro("Fiel123","Sicob","asd1","10","Poupanca");
    $desenvolvedoresPros = DesenvolvedorPro::retornarDesenvolvedoresPro();
    for ($i = 0; $i < count($desenvolvedoresPros); $i++) {
        echo "<p>";
        echo "<p>" . $desenvolvedoresPros[$i]["Nick_name"] . "</p>";
        echo "<p>" . $desenvolvedoresPros[$i]["Nome_banco"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>Avaliador</h1><br>";
    //Avaliador::cadastrarAvaliador("Fiel123", "IFSP", "clicaaqui.com");
    //Avaliador::deletarAvaliador("Fiel123");
    $avaliadores= Avaliador::retornarAvaliador();
    for ($i = 0; $i < count($avaliadores); $i++) {
        echo "<p>";
        echo "<p>" . $avaliadores[$i]["Nick_name"] . "</p>";
        echo "<p>" . $avaliadores[$i]["Local_Formação"] . "</p>";
        echo "<p>" . $avaliadores[$i]["Link_Curriculo"] . "</p>";
        echo "<br>";
    }
    
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>AvaliadorComum</h1><br>";
    //AvaliadorComum::cadastrarAvaliadorComum ("Fiel123", "Masculino");
    //Avaliadorcomum::deletarAvaliadorComum("Fiel123");
    $comuns= AvaliadorComum::retornarAvaliadorComum();
    for ($i = 0; $i < count($comuns); $i++) {
        echo "<p>";
        echo "<p>" . $comuns[$i]["Nick_name"] . "</p>";
        echo "<p>" . $comuns[$i]["sexo"] . "</p>";
        echo "<br>";
    }
    
    
    
    //----------------------------------------------------------------------------------------------
    
    
    echo "<h1>AvaliadorPro</h1><br>";
    //AvaliadorPro::cadastrarAvaliadorPro("Fiel123", "Itaú", 2000, 013, 1236545);
    //AvaliadorPro::deletarAvaliadorPro("Fiel123");
    $Pros= AvaliadorPro::retornarAvaliadorPro();
    for ($i = 0; $i < count($Pros); $i++) {
        echo "<p>";
        echo "<p>" . $Pros[$i]["Nick_name"] . "</p>";
        echo "<p>" . $Pros[$i]["Nome_Banco"] . "</p>";
        echo "<p>" . $Pros[$i]["Agencia"] . "</p>";
        echo "<p>" . $Pros[$i]["Tipo_conta"] . "</p>";
        echo "<p>" . $Pros[$i]["Numero_Conta"] . "</p>";
        echo "<br>";
    }
    
    
    //----------------------------------------------------------------------------------------------
    
    
    echo "<h1>Grupo</h1><br>";
    
    //Grupo::cadastrarGrupo(1,"ML");
    //Grupo::cadastrarGrupo(2,"Anonymous");
    //Grupo::deletarGrupo(2);
    //Grupo::editarGrupo(1,"MyL");
    $grupos = Grupo::retornarGrupos();
    for ($i = 0; $i < count($grupos); $i++) {
        echo "<p>";
        echo "<p>" . $grupos[$i]["id"] . "</p>";
        echo "<p>" . $grupos[$i]["nome_grupo"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>DesenvolvedorGrupo</h1><br>";
    //DesenvolvedorGrupo::cadastrarDesenvolvedorGrupo("Miguelzin123",1);
    //DesenvolvedorGrupo::deletarDesenvolvedorGrupo("Miguelzin123",1);
    $grupos = DesenvolvedorGrupo::retornarGruposdeDesenvolvedor("Miguelzin123");
    for ($i = 0; $i < count($grupos); $i++) {
        echo "<p>" . $grupos[$i]["id_grupo"] . "</p>";
    }
    
    $dgrupos = DesenvolvedorGrupo::retornarDesenvolvedorgrupo();
    for ($i = 0; $i < count($dgrupos); $i++) {
        echo "<p>" . $dgrupos[$i]["Nick_name"] . "</p>";
        echo "<p>" . $dgrupos[$i]["id_grupo"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    
    
    echo "<h1>Compra</h1><br>";
    Compra::cadastrarCompra(2, "Miguelzin123",1,null,"12:00:00","20/08/2020","À vista");
    //Compra::deletarCompra(2,"Miguelzin123",1);
    Compra::editarCompra(2, "Miguelzin123",1,4,"16:00:00","20/08/2020","Crédito");
    $compras = Compra::retornarCodigos("Miguelzin123");
    for ($i = 0; $i < count($compras); $i++) {
        echo "<p>Just Codigo->" . $compras[$i]["CodigoProjeto"] . "</p>";
    }
    
    $compra = Compra::retornarCompras();
    for ($i = 0; $i < count($compra); $i++) {
        echo "<p>";
        echo "<p>" . $compra[$i]["Nick_name"] . "</p>";
        echo "<p>" . $compra[$i]["NotaFiscal"] . "</p>";
        echo "<p>" . $compra[$i]["CodigoProjeto"] . "</p>";
        echo "<p>" . $compra[$i]["Quant_Parcelas"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>Emails</h1><br>";
    emails::cadastrarEmail("Fiel123", "Fiel@gmail.com");
    //emails::deletarEmails("Fiel123");
    $emailsU= emails::retornarEmails();
    for ($i = 0; $i < count($emailsU); $i++) {
        echo "<p>";
        echo "<p>" . $emailsU[$i]["Nick_name"] . "</p>";
        echo "<p>" . $emailsU[$i]["email"] . "</p>";
        echo "<br>";
    }
    
    
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>Avalia- Comum - Projeto</h1><br>";
    Avalia::cadastraAvalia("Fiel123", 1, "Está muito bom!", 10);
    //Avalia::deletarAvalia("Fiel123");
    $avalias= Avalia::retornaAvalias();
    for ($i = 0; $i < count($avalias); $i++) {
        echo "<p>";
        echo "<p>" . $avalias[$i]["Nick_name"] . "</p>";
        echo "<p>" . $avalias[$i]["codigo"] . "</p>";
        echo "<p>" . $avalias[$i]["Observaçoes_anotadas"] . "</p>";
        echo "<p>" . $avalias[$i]["Nota"] . "</p>";
        echo "<br>";
    }
    
    
    
    //----------------------------------------------------------------------------------------------
    
    echo "<h1>Avaliação</h1><br>";
    Avaliacao::cadastrarAvaliaçao(1, "Fiel123", "12-12-2020", "15-12-2020", "Fiel123", 9, "Muito bem");
    Avaliacao::editarAvaliacao(1, "Fiel123", "12-12-2020", "18-12-2020", "Fiel123", 2, "Péssimo");
    
    $avaliacao = Avaliacao::retornaCodigo("Fiel123");
    for ($i = 0; $i < count($avaliacao); $i++) {
        echo "<p>" . $avaliacao[$i]["Codigo"] . "</p>";
    }
    //Avaliaçao::deletarAvaliaçao("Fiel123", 1);
    $avaliacoes= Avaliacao::retornarAvaliaçao();
    for ($i = 0; $i < count($avaliacoes); $i++) {
        echo "<p>" . $avaliacoes[$i]["Codigo"] . "</p>";
        echo "<p>" . $avaliacoes[$i]["Nick_pro_desenvolvedor"] . "</p>";
        echo "<p>" . $avaliacoes[$i]["Data_inicio"] . "</p>";
        echo "<p>" . $avaliacoes[$i]["Data_termino"] . "</p>";
        echo "<p>" . $avaliacoes[$i]["Nick_pro_avaliador"] . "</p>";
        echo "<p>" . $avaliacoes[$i]["Nota_atribuida"] . "</p>";
        echo "<p>" . $avaliacoes[$i]["Observacoes"] . "</p>";
        echo "<br>";
    }
    
    //----------------------------------------------------------------------------------------------
    
    
    echo "<h1>Areas Aplicação</h1><br>";
    AreasAplicaçao::cadastrarArea(1, "Engenharia cívil");
    //AreasAplicaçao::deletarAreas(1);
    $areas= AreasAplicaçao::retornarAreas();
    for ($i = 0; $i < count($areas); $i++) {
        echo "<p>";
        echo "<p>" . $areas[$i]["CodigoProjeto"] . "</p>";
        echo "<p>" . $areas[$i]["Areas_Aplicaçao"] . "</p>";
        echo "<br>";
    }
    */
    
    
    
    
?>