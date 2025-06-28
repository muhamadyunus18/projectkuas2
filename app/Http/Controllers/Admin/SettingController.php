<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => config('app.name', 'Tokomonel'),
            'site_description' => config('app.description', 'Toko Kawat Monel Online'),
            'site_logo' => config('app.logo', ''),
            'site_favicon' => config('app.favicon', ''),
            'contact_email' => config('app.contact_email', ''),
            'contact_phone' => config('app.contact_phone', ''),
            'contact_address' => config('app.contact_address', ''),
            'social_media' => [
                'facebook' => config('app.social_media.facebook', ''),
                'instagram' => config('app.social_media.instagram', ''),
                'twitter' => config('app.social_media.twitter', ''),
            ],
            'payment_methods' => [
                'bank_transfer' => config('app.payment_methods.bank_transfer', true),
                'credit_card' => config('app.payment_methods.credit_card', true),
                'e_wallet' => config('app.payment_methods.e_wallet', true),
            ],
            'shipping_methods' => [
                'jne' => config('app.shipping_methods.jne', true),
                'tiki' => config('app.shipping_methods.tiki', true),
                'pos' => config('app.shipping_methods.pos', true),
            ]
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'contact_address' => 'required|string',
            'social_media.facebook' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
            'payment_methods.bank_transfer' => 'boolean',
            'payment_methods.credit_card' => 'boolean',
            'payment_methods.e_wallet' => 'boolean',
            'shipping_methods.jne' => 'boolean',
            'shipping_methods.tiki' => 'boolean',
            'shipping_methods.pos' => 'boolean',
        ]);

        // Handle file uploads
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            $validated['site_logo'] = $logoPath;
        }

        if ($request->hasFile('site_favicon')) {
            $faviconPath = $request->file('site_favicon')->store('settings', 'public');
            $validated['site_favicon'] = $faviconPath;
        }

        // Update config values
        foreach ($validated as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $subKey => $subValue) {
                    config(["app.{$key}.{$subKey}" => $subValue]);
                }
            } else {
                config(["app.{$key}" => $value]);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui');
    }
} 