<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Auth;

class QRController extends Controller
{
    public function generate(Request $request)
    {
        // Obtener el texto para el QR desde la solicitud
        $text = $request->input('text', '');

        // Configurar las opciones del QR
        $options = new QROptions([
            'outputType'          => QRCode::OUTPUT_IMAGE_PNG,
            'quality'             => 100,
            'scale'               => 23,
            'outputBase64'        => true,
            'bgColor'             => [200, 150, 200],
            'imageTransparent'    => true,
            'drawCircularModules' => false,
            'drawLightModules'    => false,
        ]);

        // Generar el código QR
        $qrcode = new QRCode($options);
        $image = $qrcode->render($text);

        // Devolver el QR como una imagen en base64
        return response()->json([
            'status' => 'success',
            'url' =>  $image,
        ]);
    }

    public function readQR(Request $request)
{
    // Validar que el archivo sea una imagen PNG
    $request->validate([
        'qrImage' => 'required|file|mimes:png',
    ]);

    $fileTmpPath = $request->file('qrImage')->getPathname();

    try {
        // Leer el contenido del QR
        $result = (new QRCode)->readFromFile($fileTmpPath); // -> DecoderResult
        $content = trim($result->data); // Elimina espacios en blanco al inicio y al final
   

        // Expresión regular para validar que el contenido comience con la URL fija
        $pattern = '/^http:\/\/(?:www\.)?f1-blog\.test\/Login&username=([^&]+)/';
        if (preg_match($pattern, $content, $matches)) {
            // Extraer el nombre de usuario del contenido
            $username = $matches[1];

            // Verificar si el usuario tiene la sesión iniciada
            if (Auth::check()) {
                $redirectUrl = "http://f1-blog.test/userProfile?username=" . urlencode($username);
                return redirect()->away($redirectUrl);
            } else {
                return redirect()->away($content);
            }
        } else {
            return back()->withErrors(['qrImage' => 'El contenido del QR no es válido.']);
        }
    } catch (\Throwable $exception) {
        return back()->withErrors(['qrImage' => 'Algo ha ido mal al leer el QR.']);
    }
}

    public function showQRForm()
    {
        return view('readQR');
    }
}
