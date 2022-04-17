<?php

declare(strict_types=1);

namespace Baraja\Shop\Availability\Entity;


use Baraja\Localization\TranslateObject;
use Baraja\Localization\Translation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @method string getName(?string $locale = null)
 * @method void setName(string $name, ?string $locale = null)
 * @method string getDescription(?string $locale = null)
 * @method void setDescription(?string $description = null, ?string $locale = null)
 */
#[ORM\Entity]
#[ORM\Table(name: 'shop__availability')]
class Availability
{
	use TranslateObject;

	public const
		CodeInStock = 'stock',
		CodeSoldOut = 'sold-out',
		CodeOrdered = 'ordered',
		CodeOnRequest = 'on-request',
		CodeCurrentlyUnavailable = 'currently-unavailable';

	public const SystemCodes = [
		self::CodeInStock,
		self::CodeSoldOut,
		self::CodeOrdered,
		self::CodeOnRequest,
		self::CodeCurrentlyUnavailable,
	];

	public const SystemColors = [
		self::CodeInStock => '#00ff00',
		self::CodeSoldOut => '#ff0000',
		self::CodeOrdered => '#000000',
		self::CodeOnRequest => '#0000ff',
		self::CodeCurrentlyUnavailable => '#ff0000',
	];

	#[ORM\Id]
	#[ORM\Column(type: 'integer', unique: true, options: ['unsigned' => true])]
	#[ORM\GeneratedValue]
	protected int $id;

	#[ORM\Column(type: 'translate')]
	protected Translation $name;

	#[ORM\Column(type: 'translate', nullable: true)]
	protected ?Translation $description = null;

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


	public function getId(): int
	{
		return $this->id;
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
