<?php

declare(strict_types=1);

namespace Baraja\Shop\Availability;


use Baraja\Doctrine\ORM\DI\OrmAnnotationsExtension;
use Nette\DI\CompilerExtension;

final class ShopAvailabilityExtension extends CompilerExtension
{
	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();
		OrmAnnotationsExtension::addAnnotationPathToManager($builder, 'Baraja\Shop\Availability\Entity', __DIR__ . '/Entity');
	}
}
