@extends('admin.layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Informasi Situs -->
                <div class="mb-4">
                    <h5 class="mb-3">Informasi Situs</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_name">Nama Situs</label>
                                <input type="text" class="form-control" id="site_name" name="site_name" 
                                    value="{{ $settings['site_name'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_description">Deskripsi Situs</label>
                                <input type="text" class="form-control" id="site_description" name="site_description" 
                                    value="{{ $settings['site_description'] }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_logo">Logo Situs</label>
                                <input type="file" class="form-control-file" id="site_logo" name="site_logo">
                                @if($settings['site_logo'])
                                    <img src="{{ Storage::url($settings['site_logo']) }}" alt="Logo" class="mt-2" style="max-height: 50px;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_favicon">Favicon</label>
                                <input type="file" class="form-control-file" id="site_favicon" name="site_favicon">
                                @if($settings['site_favicon'])
                                    <img src="{{ Storage::url($settings['site_favicon']) }}" alt="Favicon" class="mt-2" style="max-height: 32px;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <div class="mb-4">
                    <h5 class="mb-3">Informasi Kontak</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_email">Email</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email" 
                                    value="{{ $settings['contact_email'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_phone">Telepon</label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
                                    value="{{ $settings['contact_phone'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_address">Alamat</label>
                                <input type="text" class="form-control" id="contact_address" name="contact_address" 
                                    value="{{ $settings['contact_address'] }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media Sosial -->
                <div class="mb-4">
                    <h5 class="mb-3">Media Sosial</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="social_media_facebook">Facebook</label>
                                <input type="url" class="form-control" id="social_media_facebook" 
                                    name="social_media[facebook]" value="{{ $settings['social_media']['facebook'] }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="social_media_instagram">Instagram</label>
                                <input type="url" class="form-control" id="social_media_instagram" 
                                    name="social_media[instagram]" value="{{ $settings['social_media']['instagram'] }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="social_media_twitter">Twitter</label>
                                <input type="url" class="form-control" id="social_media_twitter" 
                                    name="social_media[twitter]" value="{{ $settings['social_media']['twitter'] }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-4">
                    <h5 class="mb-3">Metode Pembayaran</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="payment_bank_transfer" 
                                    name="payment_methods[bank_transfer]" value="1" 
                                    {{ $settings['payment_methods']['bank_transfer'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment_bank_transfer">Transfer Bank</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="payment_credit_card" 
                                    name="payment_methods[credit_card]" value="1" 
                                    {{ $settings['payment_methods']['credit_card'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment_credit_card">Kartu Kredit</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="payment_e_wallet" 
                                    name="payment_methods[e_wallet]" value="1" 
                                    {{ $settings['payment_methods']['e_wallet'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment_e_wallet">E-Wallet</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pengiriman -->
                <div class="mb-4">
                    <h5 class="mb-3">Metode Pengiriman</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="shipping_jne" 
                                    name="shipping_methods[jne]" value="1" 
                                    {{ $settings['shipping_methods']['jne'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="shipping_jne">JNE</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="shipping_tiki" 
                                    name="shipping_methods[tiki]" value="1" 
                                    {{ $settings['shipping_methods']['tiki'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="shipping_tiki">TIKI</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="shipping_pos" 
                                    name="shipping_methods[pos]" value="1" 
                                    {{ $settings['shipping_methods']['pos'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="shipping_pos">POS</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </form>
        </div>
    </div>
</div>
@endsection 