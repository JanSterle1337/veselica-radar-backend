<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Http\Controllers\AuthController;

class ReviewEvents extends Command
{
    protected $signature = 'events:review';
    protected $description = 'Preglej in potrdi ali zavrni dogodke s is_confirmed = 0';

    public function handle()
    {
        $authController = new AuthController();

        $email = $this->ask('Vnesite administratorski email:');
        $password = $this->secret('Vnesite administratorsko geslo:');

        $user = $authController->consoleLogin($email, $password);

        if (!$user) {
            $this->error('Napačen email ali geslo.');
            return;
        }

        if ($user->role !== 'admin') {
            $this->error('Dostop zavrnjen. Ta uporabnik nima administratorskih pravic.');
            return;
        }

        $events = Event::where('is_confirmed', 0)->get();

        if ($events->isEmpty()) {
            $this->info('Ni dogodkov za potrditev.');
            return;
        }

        foreach ($events as $event) {
            $this->info("Dogodek: {$event->name}");
            $this->info("Lokacija: {$event->location}");
            $this->info("Vstopnina: " . ($event->is_entrance_fee ? 'Da' : 'Ne'));
            $this->info("Cena vstopnine: {$event->entrance_fee}");
            $this->info("Datum dogodka: {$event->event_date}");
            $this->info("Začetni čas: {$event->starting_hour}");
            $this->info("Končni čas: {$event->ending_hour}");

            $confirm = $this->choice('Ali želite potrditi ta dogodek?', ['y' => 'Da', 'n' => 'Ne'], 'n');

            if ($confirm === 'y') {
                $event->is_confirmed = 1;
                $event->save();
                $this->info('Dogodek je bil potrjen.');
            } else {
                $this->info('Dogodek je bil zavrnjen.');
            }

            $this->line('-----------------------------');
        }

        $this->info('Vsi dogodki so bili pregledani.');
    }
}
