<p>Vous avez reçu un nouveau message depuis le formulaire de contact.</p>

<p><strong>Nom :</strong> {{ $nom }}</p>
<p><strong>Email :</strong> {{ $email }}</p>
<p><strong>Telephone :</strong> {{ $telephone ?? 'Non renseigne' }}</p>

<p><strong>Message :</strong></p>
<div>{!! nl2br(e($texte)) !!}</div>
