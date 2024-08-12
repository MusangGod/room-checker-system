<?php

namespace App\Enums;

enum PostStatus: int
{
	case DRAFT = 1;
	case PUBLISHED = 2;

	public function label()
	{
		return match ($this) {
			self::DRAFT => 'Draft',
			self::PUBLISHED => 'Published',
		};
	}

	public static function labels(): array
	{
		return [
			"Draft",
			"Published",
		];
	}
}
