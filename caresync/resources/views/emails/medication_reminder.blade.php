<h2>Olá! Este é um lembrete do CareSync.</h2>
<p>Está quase na hora de tomar seu medicamento: <strong>{{ $medication->name }}</strong></p>
<p><strong>Dose:</strong> {{ $medication->dosage }}</p>
<p><strong>Horário:</strong> {{ \Carbon\Carbon::parse($medication->next_dose_at)->format('H:i') }}</p>
<hr>
<p>Cuide bem da sua saúde!</p>