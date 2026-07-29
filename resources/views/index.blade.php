<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste : Plage de Martinique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4">Plage de Martinique</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Les plages</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
        </ul>
    </header>

    <section>
        <a href="{{ route('beaches.create') }}" class="btn btn-primary mb-3">Ajouter une plage</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Commune</th>
                <th scope="col">Description</th>
                <th scope="col" style="width: 250px">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($beaches as $beach)
                <tr>
                    <th scope="row">{{ $beaches->firstItem() + $loop->index }}</th>
                    <td>{{ $beach->nom }}</td>
                    <td>{{ $beach->commune?->nom ?? 'Commune inconnue' }}</td>
                    <td>
                        @if ($beach->description)
                            {!! $beach->description !!}
                        @else
                            <span class="text-muted">Aucune description</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('beaches.edit', $beach) }}" class="btn btn-warning text-white">Modifier</a>

                            <form action="{{ route('beaches.destroy', $beach) }}" method="post"
                                  onsubmit="return confirm('Supprimer cette plage ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Aucune plage enregistree pour le moment.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $beaches->links() }}
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>
</html>
