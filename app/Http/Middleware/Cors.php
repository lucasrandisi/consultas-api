<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Request;

class Cors extends HandleCors
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return \Illuminate\Http\Response
	 */
	public function handle($request, Closure $next)
	{
		if (! $this->hasMatchingPath($request)) {
			return $next($request);
		}

		$this->cors->setOptions($this->container['config']->get('cors', []));

		if ($this->cors->isPreflightRequest($request)) {
			$response = $this->cors->handlePreflightRequest($request);

			$this->cors->varyHeader($response, 'Access-Control-Request-Method');

			$response->headers->remove('Access-Control-Allow-Origin');

			return $response;
		}

		$response = $next($request);

		if ($request->getMethod() === 'OPTIONS') {
			$this->cors->varyHeader($response, 'Access-Control-Request-Method');
		}

		$response->headers->remove('Access-Control-Allow-Origin');

		return $this->cors->addActualRequestHeaders($response, $request);
	}
}
