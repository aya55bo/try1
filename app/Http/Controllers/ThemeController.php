<?php

// app/Http/Controllers/ThemeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function toggle(Request $request)
    {
        $current = session('theme', 'default');

        $newTheme = match ($current) {
            'fille' => 'garcon',
            'garcon' => 'default',
            default => 'fille',
        };

        session(['theme' => $newTheme]);

        return redirect()->back();
    }
}

