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
    <link rel="stylesheet" href="../style/paginas.css">
    <link rel="shortcut icon" href="../img/prefeitura.png" type="image/x-icon">
    <script src="../js/func.js"></script>
    
</head>
<body>
<div class='bodyin'>
        <div class='header'>
            <h1 class='title-header'>Geral - Rifas</h1>
            <div class='header-in'>
                <h2 class='sub-header'><span id="active">0</span> Ativos</h2>
            </div>
        </div>

        <div id='details'>
            <div class='add-container' id='detailContainer'></div>
        </div>

        <div class='extra'>
            <h1 class='title-header'>Funções</h1>
            <div id='headerIn' class='header-in'>
                <button onclick='openAdd(addRifa)' class='funcBt'>+ Adicionar rifa</button>
            </div>
        </div>
        
        <div id='addNew'>
            <div id='addRifa' class='add-container'>
                <h1 class='title-add'>Nova rifa</h1>

                <div class='inps-add'>
                    <div class='inp-add-out'>
                        <h3>Nome</h3>
                        <input id='nomeAdd' type='text' placeholder='Rifa para caridade'/>
                    </div>
                    <div class='inp-add-out'>
                        <h3>Descrição</h3>
                        <input id='descAdd' type='text' placeholder='Estamos fazendo esta rifa para...'/>
                    </div>
                    <div class='inp-add-out'>
                        <h3>Data de término</h3>
                        <input id='dataAdd' type='date'/>
                    </div>
                    <div class='inp-add-out'>
                        <h3>Quantidade de números</h3>
                        <input id='qtAdd' type='number' placeholder='60'/>
                    </div>
                    <div class='inp-add-out2'>
                        <h3>Limite de números?</h3>
                        <input id='limiteNumRifa' type='checkbox'>
                    </div>
                    <div class='inp-add-out' style='width: 100%'>
                        <h3>Prêmios</h3>
                        <div id='inpAddOutPremio'>
                            <div class='inp-add-in-premio'>
                                <input type='text' placeholder='Bicicleta' class='premio-add-input'/>
                                <label for='item0'>Imagem</label>
                                <input type="file" accept='image/jpg, image/png, image/jpeg' id='item0' style='display: none'>
                            </div>
                        </div>
                        <button onclick='createPremio(this)' class='addPremioBt'>Adicionar prêmio</button>
                        <!-- criar um script para gerar mais um input caso tiver algo digitado no anterior -->
                    </div>
                </div>
                <div class='out-bt-sv'>
                    <button class='btn-close' onclick='closeAdd()'>Fechar</button>
                    <button onclick='addNewData("turmas/cadastrar/rifa", {
                        nome: nomeAdd.value,
                        desc: descAdd.value,
                        data: (dataAdd.valueAsNumber / 1000),
                        qt: getRifaQt(), // retornar -> valor normal se tiver quantidade e -1 se limiteNumRifa estiver clickado
                        premios: getRifaPremio() // retornar um objeto com com todos os premios e suas respectivas imagens
                    })' class='btn-add'>Salvar</button>
                </div>
            </div>
        </div>

        <div class="list">
            <div class="header-list-out">
                <h1 class="title-header">Alunos</h1>
                <input id="searchBar" name="searchBar" placeholder="Pesquisar..">
            </div>
            <table class="content-list">
                <thead id='headList'></thead>
                <tbody id='tabList'></tbody>
            </table>
        </div>

        <script>
        limiteNumRifa.onclick = () => {
            console.log('a')
            if(limiteNumRifa.checked){
                qtAdd.disabled = true;
            } else {
                qtAdd.disabled = false;
            }
        }


        function getRifaQt(){
            let val = limiteNumRifa.checked == true ? -1 : qtAdd.value
            return val
        }

        function getRifaPremio(){
            let obj = {}
            let premioAddInput = document.querySelectorAll('.premio-add-input');
            let premioAddImg = document.querySelectorAll('.premio-add-img');

            for(i = 0; i < premioAddInput.length; i++){
                console.log(i);
                if(premioAddInput[i].value != ''){
                    obj[`premio${i}`] = {
                        nome: premioAddInput[i].value,
                        img: getBase64(premioAddImg[i].files[0])
                    }
                }
            }
            return obj
        }

        function deletePremio(me){
            console.log(me);
            me.parentElement.remove()
        }

        let indexFile = 1

        function createPremio(me){
            let div = document.createElement('div');
            div.classList.add('inp-add-in-premio');

            let input = document.createElement('input');
            input.classList.add('premio-add-input');
            input.placeholder = 'Bicicleta';

            let label = document.createElement('label');
            label.setAttribute('for','item' + indexFile);
            label.innerText = 'Imagem';

            let inputImg = document.createElement('input');
            inputImg.classList.add('premio-add-img');
            inputImg.type = 'file';
            inputImg.style = 'display: none';
            inputImg.id = 'item' + indexFile;

            let button = document.createElement('button');
            button.onclick = () => {deletePremio(button)};
            button.classList.add('removePremioBt');
            button.innerText = 'Remover item';

            div.append(input);
            div.append(label);
            div.append(inputImg);
            div.append(button);
            
            inpAddOutPremio.append(div);
            indexFile++;
        }
    </script>
    

    <div id="b2xcodeOut">
        <h1 id='b2xcodeIn'>
            Feito com ♥ por <a href="#">moontis.com</a> - © Copyright <?php echo date('Y')?>
        </h1>
    </div>
    <script src="https://whos.amung.us/pingjs/?k=partiuvolei&t=Partiu Vôlei - Rifas - T: <?php echo $__TYPE__; ?>&c=d&x=https://partiuvolei.com/&y=&a=0&v=27&r=5847"></script>
    <script src="https://whos.amung.us/pingjs/?k=totalmoontis&t=Partiu Vôlei - Rifas - T: <?php echo $__TYPE__; ?>&c=d&x=https://partiuvolei.com/&y=&a=0&v=27&r=5847"></script>
</body>
</html>