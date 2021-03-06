<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(GradoSeeder::class);
        $this->call(TipoCapacitacionSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(DistritoSeeder::class);
        $this->call(TipoInstitucionSeeder::class);
        $this->call(InstitucionSeeder::class);
        $this->call(SedeRegistralSeeder::class);
        $this->call(TipoNivelesSeeder::class);
        $this->call(EstadoCivilSeeder::class);
        $this->call(EstadoExpedienteAdhocSeeder::class);
        $this->call(EstadoRevisionSeeder::class);

        //fake data
        $this->call(ConfiguracionSeeder::class);
        $this->call(ConvocatoriaSeeder::class);
        $this->call(ArchivoSeeder::class);
        
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ItemSeeder::class);
    }
}
