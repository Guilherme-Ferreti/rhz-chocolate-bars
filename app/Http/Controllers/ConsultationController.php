<?php

namespace App\Http\Controllers;

use App\Models\ChocolateBar;
use Illuminate\Http\Request;
use App\Http\Resources\Consultation\ChocolateBarResource;

class ConsultationController extends Controller
{
    public function chocolate_bar(ChocolateBar $chocolate_bar)
    {
        return new ChocolateBarResource($chocolate_bar);
    }
}
