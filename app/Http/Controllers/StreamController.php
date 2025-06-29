<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Models\Music;

class StreamController extends Controller
{
    public function stream($filename)
    {
        $path = storage_path('app/public/music/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }

        $music = Music::where('media_path', 'music/' . $filename)->first();
        if ($music) {
            $music->increment('plays');
        }

        $response = new BinaryFileResponse($path);
        
        $response->headers->set('Content-Type', 'audio/mpeg');
        $response->headers->set('Content-Disposition', 'inline; filename="' . $filename . '"');
        $response->headers->set('Accept-Ranges', 'bytes');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        $response->headers->set('X-Accel-Buffering', 'no');
        
        $response->setChunkSize(8192);
        
        return $response;
    }
} 