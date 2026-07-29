<?php

use App\Models\Beach;
use App\Models\Commune;

test('the index page displays paginated beaches from the database', function () {
    $commune = Commune::create([
        'nom' => 'Sainte-Anne',
        'code_postal' => '97227',
        'code_insee' => '97202',
    ]);

    Beach::create([
        'nom' => 'A plage',
        'description' => null,
        'commune_id' => $commune->id,
    ]);

    Beach::create([
        'nom' => 'B plage',
        'description' => '<p>B</p>',
        'commune_id' => $commune->id,
    ]);

    Beach::create([
        'nom' => 'C plage',
        'description' => '<p>C</p>',
        'commune_id' => $commune->id,
    ]);

    Beach::create([
        'nom' => 'D plage',
        'description' => '<p>D</p>',
        'commune_id' => $commune->id,
    ]);

    $this->get('/')
        ->assertSuccessful()
        ->assertSee('A plage')
        ->assertSee('B plage')
        ->assertSee('C plage')
        ->assertDontSee('D plage')
        ->assertSee('?page=2');

    $this->get('/?page=2')
        ->assertSuccessful()
        ->assertSee('D plage')
        ->assertDontSee('A plage')
        ->assertDontSee('B plage')
        ->assertDontSee('C plage');
});

test('the create page shows the form and communes', function () {
    Commune::create([
        'nom' => 'Le Marin',
        'code_postal' => '97290',
        'code_insee' => '97216',
    ]);

    $this->get(route('beaches.create'))
        ->assertSuccessful()
        ->assertSee('Ajouter une plage')
        ->assertSee('Le Marin');
});

test('a beach can be created from the form', function () {
    $commune = Commune::create([
        'nom' => 'Le Francois',
        'code_postal' => '97240',
        'code_insee' => '97210',
    ]);

    $this->post(route('beaches.store'), [
        'nom' => 'Anse a l\'Ane',
        'commune_id' => $commune->id,
        'description' => '<p>Une belle plage.</p>',
    ])->assertRedirect('/');

    $this->assertDatabaseHas((new Beach)->getTable(), [
        'nom' => 'Anse a l\'Ane',
        'commune_id' => $commune->id,
        'description' => '<p>Une belle plage.</p>',
    ]);
});

test('the edit page shows the selected beach and commune list', function () {
    $commune = Commune::create([
        'nom' => 'Sainte-Luce',
        'code_postal' => '97228',
        'code_insee' => '97224',
    ]);

    $otherCommune = Commune::create([
        'nom' => 'Le Diamant',
        'code_postal' => '97223',
        'code_insee' => '97207',
    ]);

    $beach = Beach::create([
        'nom' => 'Anse Mabouya',
        'description' => '<p>Description</p>',
        'commune_id' => $commune->id,
    ]);

    $this->get(route('beaches.edit', $beach))
        ->assertSuccessful()
        ->assertSee('Modifier une plage')
        ->assertSee('Anse Mabouya')
        ->assertSee('Sainte-Luce')
        ->assertSee('Le Diamant');
});

test('a beach can be updated from the edit form', function () {
    $commune = Commune::create([
        'nom' => 'Le Marin',
        'code_postal' => '97290',
        'code_insee' => '97216',
    ]);

    $otherCommune = Commune::create([
        'nom' => 'Les Anses-d\'Arlet',
        'code_postal' => '97217',
        'code_insee' => '97202',
    ]);

    $beach = Beach::create([
        'nom' => 'Anse initiale',
        'description' => '<p>Ancienne description</p>',
        'commune_id' => $commune->id,
    ]);

    $this->put(route('beaches.update', $beach), [
        'nom' => 'Anse mise a jour',
        'commune_id' => $otherCommune->id,
        'description' => '<p>Nouvelle description</p>',
    ])->assertRedirect('/');

    $this->assertDatabaseHas((new Beach)->getTable(), [
        'id' => $beach->id,
        'nom' => 'Anse mise a jour',
        'commune_id' => $otherCommune->id,
        'description' => '<p>Nouvelle description</p>',
    ]);
});

test('a beach can be deleted from the list', function () {
    $commune = Commune::create([
        'nom' => 'Saint-Pierre',
        'code_postal' => '97250',
        'code_insee' => '97225',
    ]);

    $beach = Beach::create([
        'nom' => 'Anse Turin',
        'description' => '<p>Texte</p>',
        'commune_id' => $commune->id,
    ]);

    $this->delete(route('beaches.destroy', $beach))
        ->assertRedirect('/');

    $this->assertDatabaseMissing((new Beach)->getTable(), [
        'id' => $beach->id,
    ]);
});
