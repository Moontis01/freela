<?php
include "../sys/conexao.php";
justLog($__EMAIL__, $__TYPE__, 3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/root.css">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/paginas.css">
    <link rel="shortcut icon" href="../img/prefeitura.png" type="image/x-icon">
    <script src="../js/func.js"></script>
</head>
<body >
    <header>
        <h1 class='title-header'>Geral - Categorias</h1>
        <div class='header-in'>
            <h2 class='sub-header'><span id="active">0</span> Ativos</h2>
            <h2 class='sub-header'><span id="inactive">0</span> Inativos</h2>
        </div>
    </header>

    <div id='details'>
        <div class='add-container'>
            <h1 class='title-add'>Detalhes</h1>
            <div class='inps-add'>
                <div class='inp-add-out'>
                    <h3>Nome</h3>
                    <p id='nomeGet' type='text'>-- -- --</p>
                </div>
            </div>
            <div class='out-bt-sv'>
                <button class='btn-close' onclick='closeAdd()'>Fechar</button>
                <button onclick='javascript:void(0)' class='btn-add'>Salvar</button>
            </div>
        </div>
    </div>

    <div class='extra'>
        <h1 class='title-header'>Funções</h1>
        <div class='header-in'>
            <button onclick='openAdd(addCategoria)' class='funcBt'>+ Adicionar Categoria</button>
        </div>
    </div>

    

    <div id='addNew'>
        <div id='addCategoria' class='add-container'>
            <h1 class='title-add'>Nova categoria</h1>

            <div class='inps-add'>
                <div class='inp-add-out'>
                    <h3>Nome</h3>
                    <input id='nomeAdd' type='text' placeholder='Sub n'/>
                </div>
            </div>
            <div class='out-bt-sv'>
                <button class='btn-close' onclick='closeAdd()'>Fechar</button>
                <button onclick='addNewData("usuarios/cadastrar/categoria", {
                    nome: nomeAdd.value
                })' class='btn-add'>Salvar</button>
            </div>
        </div>
    </div>

    <div class="list">
        <div class="header-list-out">
            <h1 class="title-header">Categorias</h1>
            <input id="searchBar" name="searchBar" placeholder="Pesquisar..">
        </div>
        <table class="content-list">
            <thead id='headList'></thead>
            <tbody id='tabList'></tbody>
        </table>
    </div>

    <script>
        startPage('categorias');
    </script>
</body>
</html>