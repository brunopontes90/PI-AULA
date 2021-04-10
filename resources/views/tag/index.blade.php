<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <title>Lista de tags</title>

        <script>
            function remover(){
                return confirm('Você deseja remover a tag?');
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

            <h1>Lista de Tags</h1>
            <a href="{{route('tag.create')}}" class="btn btn-lg btn-primary">Criar Categoria</a>

            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-success">Visualizar</a>
                                <a href="{{route('tag.edit', $tag->id)}}" class="btn btn-sm btn-warning">Editar</a>
                                <form class="d-inline" method="POST" action="{{ route('tag.destroy', $tag->id) }}" onsubmit="return remover();" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Apagar</button>
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
