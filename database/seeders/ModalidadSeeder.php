use App\Models\Modalidad;

public function run(): void
{
    foreach (['Presencial', 'Híbrido', 'Remoto'] as $m) {
        Modalidad::firstOrCreate(['nombre' => $m]);
    }
}
