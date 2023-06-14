<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handelt een inkomend verzoek af.
     *
     * @param Closure(\Illuminate\Http\Request): (Response) $next
     * @param string ...$rollen De rollen die gecontroleerd moeten worden.
     * @return Response
     */
    public function handle(Request $request, Closure $next, ...$rollen)
    {
        $gebruiker = $request->user();

        if (!$gebruiker) {
            abort(403, 'Unauthorized');
        }

        $gebruikerRollen = $gebruiker->roles->pluck('name')->toArray();

        if (count(array_intersect($gebruikerRollen, $rollen)) > 0) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

}
