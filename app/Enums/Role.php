<?php

namespace App\Enums;

enum Role: int
{
	case SUPER_ADMIN = 1;
	case ADMIN = 2;
	case STAFF = 3;

	public function label()
	{
		return match ($this) {
			self::SUPER_ADMIN => 'Super Admin',
			self::ADMIN => 'Admin',
			self::STAFF => 'Staff',
		};
	}

	public static function labels(): array
	{
		return [
			"Super Admin",
			"Admin",
			"Staff"
		];
	}
}
