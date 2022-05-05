<?php

namespace App\Command;

use App\Repository\ReservationRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteReservationCommand extends Command
{
    protected static $defaultName = 'DeleteReservation';
    protected static $defaultDescription = "Supprimer les reservations faites il y'a 24 mois et plus";

    private $ReservationRepo;

    public function __construct(ReservationRepository $ReservationRepo)
    {
        $this->ReservationRepository = $ReservationRepo;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $today = date('Y-m-d H:i:s', strtotime(' - 24 months'));

        $this->ReservationRepository->DeleteReservation($today);

        $output->writeln('Reservation de plus de 24 mois supprimé');

        return Command::SUCCESS;
    }
}
