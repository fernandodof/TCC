<link href="../css/subscribe.css" rel="stylesheet" type="text/css">
<div class="container">
    <form role="form" class="form-horizontal col-sm-6 col-sm-offset-3" id="subscribeForm" action="../src/app/processes/ProcessCliente.php" method="post">
        <h2>Cadastro</h2>
        <div class="form-group">
            <input type="text" name="nome" class="form-control" placeholder="Nome Completo" required/>
        </div>
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" required/>
        </div>

        <div class="form-group">
            <div class="col-sm-3" id="dddDiv">
                <input type="text" name="ddd" id="ddd" class="form-control" placeholder="DDD" required/>
            </div>

            <div class="col-sm-8 col-xs-12 pull-right" id="telefoneDiv">
                <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Número do Telefone" required/>
            </div>
        </div>
        <div class="form-group col-sm-6" id="senha1Div">
            <input type="password" name="senha1" id="senha1" class="form-control" placeholder="Senha" required/>
        </div>

        <div class="form-group col-sm-6" id="senha2Div">
            <input type="password" name="senha2" id="senha2" class="form-control" placeholder="Confirme a Senha" required/>
        </div>

        <h3 class="pull-left" id="enrececoLabel">Endereço</h3>
        <div class="form-group">
            <input type="text" name="descricaoEndereco" class="form-control" placeholder="Descrição para o endereço (ex: casa, escritório, etc)" required/>
        </div>
        <div class="form-group">
            <input type="text" name="logradouro" class="form-control" placeholder="Logradouro (ex: Rua, Avenida, etc.)" required/>
        </div>
        <div class="form-group">
            <input type="text" name="bairro" class="form-control" placeholder="Bairro" required/>
        </div>
        <div class="form-group">
            <input type="text" name="numero" class="form-control" placeholder="Número" required/>
        </div>
        <div class="form-group">
            <input type="text" name="cep" class="form-control" placeholder="CEP" required/>
        </div>
        <div class="form-group">
            <input type="text" name="cidade" class="form-control" placeholder="Cidade" required/>
        </div>
        <div class="form-group">
            <select name="estado" class="form-control" required>
                <option value="">Estado</option>
                <option value="Ácre">Ácre</option>
                <option value="Alagoas">Alagoas</option>
                <option value="Amapá">Amapá</option>              
                <option value="Amazonas">Amazonas</option>
                <option value="Bahia">Bahia</option>
                <option value="Ceará">Ceará</option>
                <option value="Distrito Federal">Distrito Federal</option>
                <option value="Espírito Santo">Espírito Santo</option>
                <option value="Goiás">Goiás</option>
                <option value="Maranhão">Maranhão</option>
                <option value="Mato Gorsso">Mato Gorsso</option>
                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                <option value="Minas Gerais">Minas Gerais</option>
                <option value="Pará">Pará</option>              
                <option value="Paraíba">Paraíba</option>
                <option value="Paraná">Paraná</option>
                <option value="Pernambuco">Pernambuco</option>
                <option value="Piauí">Piauí</option>
                <option value="Rio de Janeiro">Rio de Janeiro</option>
                <option value="Rio Grande Do Norte">Rio Grande Do Norte</option>
                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                <option value="Rondônia">Rondônia</option>
                <option value="Roraima">Roraima</option>
                <option value="Santa Catarina">Santa Catarina</option>
                <option value="São Paulo">São Paulo</option>
                <option value="Sergipe">Sergipe</option>
                <option value="Tocantins">Tocantins</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" name="complemento" class="form-control" placeholder="Complemento"/>
        </div>
        <button type="submit" name="formSubmit" value="CadastrarCliente" class="btn btn-lg btn-success pull-right">Cadastrar</button>
    </form>

</div>
