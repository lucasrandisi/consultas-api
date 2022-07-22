<?php

namespace App\Exceptions;

use Throwable;
use function response;

class BusinessException extends \Exception
{
	public function __construct(string $message = "", int $code = 422, ?Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
	}

	public function render() {
		return response()->json([
			'class' => static::class,
			'message' => $this->message,
		], 222);
	}
}