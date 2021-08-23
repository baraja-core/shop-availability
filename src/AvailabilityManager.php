<?php

declare(strict_types=1);

namespace Baraja\Shop\Availability;


use Baraja\Doctrine\EntityManager;
use Baraja\Shop\Availability\Entity\Availability;
use Nette\Utils\Strings;

final class AvailabilityManager
{
	public function __construct(
		private EntityManager $entityManager,
	) {
	}


	/**
	 * @return Availability[]
	 */
	public function getAll(): array
	{
		static $cache = null;
		if ($cache === null) {
			/** @var Availability[] $cache */
			$cache = $this->entityManager->getRepository(Availability::class)
				->createQueryBuilder('a')
				->getQuery()
				->getResult();

			if ($cache === []) {
				$this->initDefault();
				$cache = $this->getAll();
			}
		}

		return $cache;
	}


	private function initDefault(): void
	{
		foreach (Availability::SYSTEM_CODES as $code) {
			$this->entityManager->persist(
				new Availability(
					name: Strings::firstUpper(str_replace('-', ' ', $code)),
					code: $code,
					color: Availability::SYSTEM_COLORS[$code] ?? '#000000',
				)
			);
		}
		$this->entityManager->flush();
	}
}
