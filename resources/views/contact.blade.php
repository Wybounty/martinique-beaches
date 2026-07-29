<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact : Plage de Martinique</title>
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
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Les plages</a></li>
            <li class="nav-item"><a href="{{ route('contact.create') }}" class="nav-link active" aria-current="page">Contact</a></li>
        </ul>
    </header>

    <section class="mx-auto" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Contact</h1>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Retour</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="post" autocomplete="off">
            @csrf

            <div class="visually-hidden" aria-hidden="true">
                <label for="fax_number">Fax number</label>
                <input
                    type="text"
                    id="fax_number"
                    name="fax_number"
                    tabindex="-1"
                    autocomplete="new-password"
                >
            </div>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom*</label>
                <input
                    type="text"
                    maxlength="255"
                    autocomplete="name"
                    class="form-control @error('nom') is-invalid @enderror"
                    id="nom"
                    name="nom"
                    value="{{ old('nom') }}"
                    required
                >
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input
                    type="email"
                    autocomplete="email"
                    maxlength="255"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Telephone</label>
                <input
                    type="tel"
                    id="telephone"
                    name="telephone"
                    class="form-control @error('telephone') is-invalid @enderror"
                    value="{{ old('telephone') }}"
                    inputmode="numeric"
                    pattern="[0-9]+"
                    maxlength="10"
                >
                @error('telephone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="texte" class="form-label">Texte*</label>
                <textarea
                    class="form-control @error('texte') is-invalid @enderror"
                    id="texte"
                    name="texte"
                    rows="8"
                    required
                >{{ old('texte') }}</textarea>
                @error('texte')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Envoyer</button>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>
</html>
