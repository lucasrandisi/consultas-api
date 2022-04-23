<?php

namespace App\Exceptions;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use Throwable;

class UnauthorizedException extends \Exception
{
	public function __construct(string $message = "", int $code = 401, ?Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
	}

	public function render() {
		return response()->json([
			'class' => static::class,
			'message' => $this->message,
		], $this->code);
	}
}