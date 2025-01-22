<?php

namespace App\Http\Controllers;

use App\Models\ImageDetectionLog;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    const CONFIDENCE_THRESHOLD = 80.0;

    public function processImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'image.required' => 'Silakan pilih gambar terlebih dahulu.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'image.max' => 'Ukuran gambar maksimal 2MB.'
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
                    ],
                    'timeout' => 30,
                ]);

                $result = json_decode($response->getBody(), true);
                
                $confidence = (float) $result['confidence'] ?? 0;
                $status = $confidence >= self::CONFIDENCE_THRESHOLD ? 'success' : 'failed';
                
                $imagePath = $image->store('temp', 'public');

                $this->cleanupOldImages();

                ImageDetectionLog::create([
                    'image_path' => $imagePath,
                    'prediction_result' => $result['prediksi'],
                    'confidence' => $confidence,
                    'status' => $status,
                    'ip_address' => $request->ip(),
                ]);

                if ($status === 'success') {
                    $message = "Prediksi berhasil! Huruf yang terdeteksi adalah {$result['prediksi']} dengan tingkat keyakinan " . number_format($confidence, 1) . "%";
                } else {
                    $message = "Prediksi kurang yakin! Hasil prediksi {$result['prediksi']} dengan tingkat keyakinan " . number_format($confidence, 1) . "% (dibawah threshold " . self::CONFIDENCE_THRESHOLD . "%)";
                }

                return back()->with([
                    'prediction' => $result['prediksi'],
                    'confidence' => $confidence,
                    'uploadedImage' => $imagePath,
                    $status === 'success' ? 'success' : 'warning' => $message
                ]);    

            } catch (GuzzleException $e) {
                ImageDetectionLog::create([
                    'status' => 'failed',
                    'error_message' => 'API Error: ' . $e->getMessage(),
                    'ip_address' => $request->ip(),
                ]);
                
                return back()->with('error', 'Gagal menghubungi server prediksi. Silakan coba lagi.');
            }

        } catch (\Exception $e) {
            ImageDetectionLog::create([
                'status' => 'failed',
                'error_message' => 'System Error: ' . $e->getMessage(),
                'ip_address' => $request->ip(),
            ]);
            
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    private function cleanupOldImages()
    {
            $files = Storage::disk('public')->files('temp');
            foreach ($files as $file) {
                $time = Storage::disk('public')->lastModified($file);
                if (time() - $time > 3600) { 
                    Storage::disk('public')->delete($file);
                }
            }
    }
}