<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF HISTORICO CNAE</title>
</head>
<style>
    * {
        font-family: 'Courier New', Courier, monospace;
    }

    table {
        width: auto;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 0.8em;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e0e0e0;
    }

    thead {
        background-color: #f2f2f2;
    }

    th {
        font-weight: bold;
        font-size: 0.8em;
        border: 1px solid #ccc;
    }

    .divTitulo {
        text-align: center;
        margin: 0 auto;
        padding: 4px;
        border: 1px solid #ccc;
        background-color: #f2f2f2;
    }
    .container{
        margin: 0 auto;
    }
</style>
<body>
    <div class="divTitulo">
        <h2>Livros</h2>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Assunto</th>
                    <th>Editora</th>
                    <th>Edição</th>
                    <th>Ano Publicaçao</th>
                    <th>Autor</th>
                </tr>
            </thead>
            <tbody>
            @foreach($generatePDF as $livroAutor)
                <tr>
                    <td>
                        @if(isset($livroAutor['titulo']))
                            {{ $livroAutor['titulo'] }}
                        @else
                            ----
                        @endif
                    </td>
                    <td>
                        @if(isset($livroAutor['livro_assunto'][0]['assunto']['descricao']))
                            {{ $livroAutor['livro_assunto'][0]['assunto']['descricao'] }}
                        @else
                            ----
                        @endif
                    </td>
                    <td>
                        @if(isset($livroAutor['editora']))
                            {{ $livroAutor['editora'] }}
                        @else
                            ----
                        @endif
                    </td>
                    <td>
                        @if(isset($livroAutor['edicao']))
                            {{ $livroAutor['edicao'] }}
                        @else
                            ----
                        @endif
                    </td>
                    <td>
                        @if(isset($livroAutor['anoPublicacao']))
                            {{ $livroAutor['anoPublicacao'] }}
                        @else
                            ----
                        @endif
                    </td>
                    <td>
                        @if(isset($livroAutor['autor']['autor']['nome']))
                            {{ $livroAutor['autor']['autor']['nome'] }}
                        @else
                            ----
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>