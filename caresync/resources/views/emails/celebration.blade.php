<div style="font-family: sans-serif; text-align: center;">
    @switch($specialDate->category)
        @case('Aniversário')
            <h1>🎂 Parabéns!</h1>
        @break
        @case('Natal')
            <h1>🎄 Boas Festas!</h1>
        @break
        @case('Páscoa')
            <h1>🐰 Feliz Páscoa!</h1>
        @break
    @endswitch

    <p>{{ $specialDate->custom_message ?? "Hoje é dia de: " . $specialDate->title }}</p>
</div>