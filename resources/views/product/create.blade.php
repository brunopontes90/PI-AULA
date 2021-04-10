<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <title>Cadastrar Produto</title>
</head>
<body>
    @include('layouts.menu')
    <main class="container mt-5">
        <h1>Cadastrar produtos</h1>
        <form method="POST" action="{{Route('product.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <span class="form-label">Nome</span>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="row">
                <span class="form-label">Descrição</span>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <div class="row">
                <span class="form-label">Preço</span>
                <input type="number" name="price" min="0.00" max="10000.00" step="0.01" class="form-control">
            </div>

             {{-- OPÇOES DE CATEGORIA
                1) O NAME DO SELECT PRECISA SER IGUAL AO NOME QUE ESTA NA TABELA
                2) NECESSARIO CRIAR $CATEGORIES É NOME PASSADO NA CREATE DA PRODUCTCONTROLLER
                3) FOREACH TRAS TODAS AS CATEOGRIAS CRIADAS
            --}}
            <div class="row">
                <span class="form-label">Categoria</span>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <span class="form-label">Tags</span>
                <select class="form-select" name="tags[]" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <span class="form-label">Imagem</span>
                <input type="file" class="form-control" name="image">
            </div>

            <div class="row mt-4">
                <button type="submit" class="btn btn-success btn-lg">Salvar</button>
            </div>
        </form>
    </main>
</body>
</html>
