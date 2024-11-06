<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ImageController extends Controller
{
    public function processImage(Request $request)
    {
        // Validasi file gambar yang diunggah
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = $request->file('image');

        try {
            $client = new Client();
            $response = $client->post('https://web-production-a70a.up.railway.app/predict', [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($image->getPathname(), 'r'),
                        'filename' => $image->getClientOriginalName()
                    ]
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            $imagePath = $image->store('temp', 'public');

            return back()->with([
                'prediction' => $result['prediksi'],
                'uploadedImage' => $imagePath
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses gambar. Silakan coba lagi.');
        }
    }
}
