<?php

namespace App\Http\Middleware;

use App\Models\UserFile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class getFileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $file = UserFile::query()
            ->where('file_id', $request->id)
            ->where('user_id', Auth::id())
            ->get();

        if( $file->count() == 0 ) {
            return response()->json(
                [
                    "message" => "File not found.",
                    "errors" => ["id" => "File not found."]
                ], Response::HTTP_NOT_FOUND/*, 403)*/
            );
        }

        return $next($request);
    }
}
