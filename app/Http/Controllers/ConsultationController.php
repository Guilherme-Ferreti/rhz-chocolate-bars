<?php

namespace App\Http\Controllers;

use App\Models\ChocolateBar;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Resources\Consultation\ChocolateBarResource;

class ConsultationController extends Controller
{
    public function chocolate_bar(string $code)
    {
        $chocolate_bar = ChocolateBar::where('code', $code)->first();

        if (! $chocolate_bar) {
            throw new NotFoundHttpException();
        }

        return new ChocolateBarResource($chocolate_bar);
    }
}
