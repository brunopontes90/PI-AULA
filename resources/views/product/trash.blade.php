<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <title>Lista de Produtos - Apagados</title>

    <script>
        function restore(){
            if(confirm('Deseja restaurar o produto?')){
                window.location = route;
            }
        }
    </script>
</head>
<body>
    @include('layouts.menu')
    <main class="container mt-5">
        @if(@session()->has('success'))

        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('success') }}
        </div>

    @endif

        <h1>Lista de Produtos - Apagados</h1>
        <a href="{{Route('product.create')}}" class="btn btn-lg btn-primary">Criar Produto</a>

        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- PEGA TODOS OS ELEMENTOS DO BANCO --}}
                    @foreach ($products as $prod)
                    <tr>
                        <td>{{ $prod->id }}</td>
                        <td>{{ $prod->name }}</td>
                        <td>{{ $prod->price }}</td>
                        <td>{{ $prod->description }}</td>
                        <td>{{ $prod->category->name }}</td>
                        <td>
                            <form class="d-inline" method="POST" action="{{ route('product.restore', $prod->id) }}" onsubmit="return restore()">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-primary">Restaurar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
