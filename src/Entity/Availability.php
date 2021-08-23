<?php

declare(strict_types=1);

namespace Baraja\Shop\Availability\Entity;


use Baraja\Doctrine\Identifier\IdentifierUnsigned;
use Baraja\Localization\TranslateObject;
use Baraja\Localization\Translation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @method string getName(?string $locale = null)
 * @method void setName(string $name, ?string $locale = null)
 * @method string getDescription(?string $locale = null)
 * @method void setDescription(?string $description = null, ?string $locale = null)
 */
class Availability
{
	use IdentifierUnsigned;
	use TranslateObject;

	public const
		CODE_IN_STOCK = 'stock',
		CODE_SOLD_OUT = 'sold-out',
		CODE_ORDERED = 'ordered',
		CODE_ON_REQUEST = 'on-request',
		CODE_CURRENTLY_UNAVAILABLE = 'currently-unavailable';

	public const SYSTEM_CODES = [
		self::CODE_IN_STOCK,
		self::CODE_SOLD_OUT,
		self::CODE_ORDERED,
		self::CODE_ON_REQUEST,
		self::CODE_CURRENTLY_UNAVAILABLE,
	];

	public const SYSTEM_COLORS = [
		self::CODE_IN_STOCK => '#00ff00',
		self::CODE_SOLD_OUT => '#ff0000',
		self::CODE_ORDERED => '#000000',
		self::CODE_ON_REQUEST => '#0000ff',
		self::CODE_CURRENTLY_UNAVAILABLE => '#ff0000',
	];

	#[ORM\Column(type: 'translate')]
	private Translation $name;

	#[ORM\Column(type: 'translate', nullable: true)]
	private ?Translation $description = null;

	#[ORM\Column(type: 'string', unique: true, length: 32)]
	private string $code;

	#[ORM\Column(type: 'integer', options: ['unsigned' => true])]
	private int $loadingInHours = 0;

	#[ORM\Column(type: 'integer', options: ['unsigned' => true])]
	private int $deliveryInHours = 0;

	#[ORM\Column(type: 'string', length: 6)]
	private string $color;

	#[ORM\Column(type: 'boolean')]
	private bool $canAddToCart = true;

	#[ORM\Column(type: 'boolean')]
	private bool $canCreateOrder = true;

	#[ORM\Column(type: 'boolean')]
	private bool $active = true;


	public function __construct(
		string $name,
		string $code,
		string $color,
		?string $description = null,
	) {
		$this->setName($name);
		$this->setCode($code);
		$this->setColor($color);
		$this->setDescription($description);
	}


	public function getCode(): string
	{
		return $this->code;
	}


	public function setCode(string $code): void
	{
		$this->code = $code;
	}


	public function getLoadingInHours(): int
	{
		return $this->loadingInHours;
	}


	public function setLoadingInHours(int $loadingInHours): void
	{
		$this->loadingInHours = $loadingInHours;
	}


	public function getDeliveryInHours(): int
	{
		return $this->deliveryInHours;
	}


	public function setDeliveryInHours(int $deliveryInHours): void
	{
		$this->deliveryInHours = $deliveryInHours;
	}


	public function getColor(): string
	{
		return $this->color;
	}


	public function setColor(string $color): void
	{
		$this->color = $color;
	}


	public function isCanAddToCart(): bool
	{
		return $this->canAddToCart;
	}


	public function setCanAddToCart(bool $canAddToCart): void
	{
		$this->canAddToCart = $canAddToCart;
	}


	public function isCanCreateOrder(): bool
	{
		return $this->canCreateOrder;
	}


	public function setCanCreateOrder(bool $canCreateOrder): void
	{
		$this->canCreateOrder = $canCreateOrder;
	}


	public function isActive(): bool
	{
		return $this->active;
	}


	public function setActive(bool $active): void
	{
		$this->active = $active;
	}
}
