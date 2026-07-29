<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edition : Plage de Martinique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">

    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4">Plage de Martinique</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link active" aria-current="page">Les plages</a></li>
            <li class="nav-item"><a href="{{ route('contact.create') }}" class="nav-link">Contact</a></li>
        </ul>
    </header>

    <section class="mx-auto" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Modifier une plage</h1>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Retour</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('beaches.update', $beach) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom*</label>
                <input
                    type="text"
                    class="form-control @error('nom') is-invalid @enderror"
                    id="nom"
                    name="nom"
                    value="{{ old('nom', $beach->nom) }}"
                    required
                >
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="commune_id" class="form-label">Commune*</label>
                <select
                    class="form-select @error('commune_id') is-invalid @enderror"
                    id="commune_id"
                    name="commune_id"
                    required
                >
                    <option value="">Choisir une commune</option>
                    @foreach ($communes as $commune)
                        <option
                            value="{{ $commune->id }}"
                            @selected(old('commune_id', $beach->commune_id) == $commune->id)
                        >
                            {{ $commune->nom }}
                        </option>
                    @endforeach
                </select>
                @error('commune_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                    rows="15"
                >{{ old('description', $beach->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </section>
</div>

<script>
    $(document).ready(function () {
        $('#description').summernote({
            tabsize: 10,
            height: 250
        });
    });
</script>

</body>
</html>
