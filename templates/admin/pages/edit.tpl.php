<h3>Edição de páginas</h3>

<form action="" method="post">
    <div class="form-group">
        <label for="pagesTitle">Título</label>
        <input name="title" id="pagesTitle" type="text" class="form-control"
               placeholder="Aqui vai o titulo da página..." required value="<?php echo $data['page']['title']?>">
    </div>

    <div class="form-group">
        <label for="pagesUrl">URL</label>
        <div class="group">
            <div class="input-group-prepend">
                <span class="input-group-text">/</span>
                <input name="url" id="pagesUrl" type="text" class="form-control"
                       placeholder="URL amigável, deixe em branco para informar a página inicial..." value="<?php echo $data['page']['url']?>">
            </div>
        </div>
    </div>

    <div class="form-group">
        <input id="pagesBody" type="hidden" name="body" value="<?php echo htmlentities($data['page']['body']); ?>">
        <trix-editor input="pagesBody"></trix-editor>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<hr>

<a href="/admin/pages" class="btn btn-secondary">Ir para home</a>