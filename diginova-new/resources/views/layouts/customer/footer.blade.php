<div id="footer-data-ux"></div>

<div class="c-new-footer__container">
    <footer class="c-new-footer container c-new-footer--home-page">
        <div class="u-flex u-justify-between u-items-center items-center">
            <div class="c-new-footer__logo">
                <img width="150" src="{{ full_media_path($header_logo) }}">
            </div>
            <div id="js-jump-to-top" class="c-new-footer__jump-to-top-container">
                <span class="c-new-footer__jump-to-top-label">بازگشت به بالا</span>
                <span class="c-new-footer__jump-to-top-icon"></span>
            </div>
        </div>
        @if ($store_phone = $settings->where('name', 'store_phone')->first()->value)
            <div class="c-new-footer__contact-info-container">
                <span>تلفن پشتیبانی:</span>
                <a class="c-new-footer__phone-number">
                    {{ persianNum($store_phone) }}
                </a>
                <span class="c-new-footer__phone-number-separator">|</span>
                <span>
                    {{ $settings->where('name', 'footer_slogan')->first()->value }}
                </span>
            </div>
        @endif
        <div class="c-new-footer__feature-inner-box-container"></div>
        <div class="c-new-footer__column-container">
            @if (\Modules\Staff\Nav\Models\NavLocation::where('id', 2)->count() &&
                \Modules\Staff\Nav\Models\NavLocation::find(2)->navs->where('parent_id', null)->count())
                @foreach (\Modules\Staff\Nav\Models\NavLocation::find(2)->navs->where('parent_id', null) as $nav)
                    <nav class="c-new-footer__column-link">
                        <a class="c-new-footer__column-label" href="{{ $nav->link }}">
                            {{ persianNum($nav->name) }}
                        </a>
                        <ul>
                            @foreach ($nav->children as $item)
                                <li>
                                    <a href="{{ $item->link }}">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                @endforeach
            @endif
            <nav class="c-new-footer__column-social-media">
                <div class="c-new-footer__column-label">
                    با ما همراه باشید
                </div>
                <div class="c-new-footer__social-links">
                    @if (!is_null($linkedin_link = $settings->where('name', 'linkedin_link')->first()->value))
                        <a href="{{ $linkedin_link }}"
                            class="c-footer__social-link c-footer__social-link--linkedin" target="_blank"></a>
                    @endif
                    @if (! is_null($aparat_link = $settings->where('name', 'aparat_link')->first()->value))
                        <a href="{{ $aparat_link }}" class="c-footer__social-link c-footer__social-link--aparat"
                            target="_blank"></a>
                    @endif
                    @if (!is_null($twitter_link = $settings->where('name', 'twitter_link')->first()->value))
                        <a href="{{ $twitter_link }}"
                            class="c-footer__social-link c-footer__social-link--twitter" target="_blank"></a>
                    @endif
                    @if (!is_null($instagram_link = $settings->where('name', 'instagram_link')->first()->value))
                        <a href="{{ $instagram_link }}"
                            class="c-footer__social-link c-footer__social-link--instagram" target="_blank"></a>
                    @endif
                </div>
            </nav>
        </div>
        <?php
            $googleplay_link = $settings->where('name', 'googleplay_link')->first()->value;
            $cafebazaar_link = $settings->where('name', 'cafebazaar_link')->first()->value;
            $myket_link = $settings->where('name', 'myket_link')->first()->value;
            $sibapp_link = $settings->where('name', 'sibapp_link')->first()->value;
        ?>
        @if ($googleplay_link || $cafebazaar_link || $myket_link || $sibapp_link)
            <div class="c-new-footer__app-links-container">
                <a class="u-flex u-items-center">
                    @if($symbol_image)
                    <div class="c-new-footer__app-links-logo">
                        <img width="44" height="44" src="{{ $site_url . '/' . $symbol_image->path . '/' . $symbol_image->name }}" alt="نماد سایت">
                    </div>
                    @endif
                    <div class="c-new-footer__app-links-label">
                        دانلود اپلیکیشن
                        <label>{{ $fa_store_name }}</label>
                    </div>
                </a>
                <div class="c-new-footer__app-images-container">
                    @if ($googleplay_link)
                        <a class="store-link" href="{{ $googleplay_link }}" target="_blank">
                            <img alt="دریافت از گوگل پلی" width="150px" height="44px" loading="lazy"
                                src="{{ asset('assets/images/svg/googleplay.svg') }}">
                        </a>
                    @endif
                    @if ($cafebazaar_link)
                        <a class="store-link" href="{{ $cafebazaar_link }}" target="_blank">
                            <img data-src="{{ asset('assets/images/svg/cafebazaar.svg') }}"
                                width="150px" height="44px" loading="lazy" alt="دریافت از بازار"
                                src="{{ asset('assets/images/svg/cafebazaar.svg') }}">
                        </a>
                    @endif
                    @if ($myket_link)
                        <a class="store-link" href="{{ $myket_link }}" target="_blank">
                            <img data-src="{{ asset('assets/images/png/myket.png') }}"
                                width="150px" height="44px" loading="lazy" alt="دریافت از مایکت"
                                src="{{ asset('assets/images/png/myket.png') }}">
                        </a>
                    @endif
                    @if ($sibapp_link)
                        <a class="store-link" href="{{ $sibapp_link }}" target="_blank">
                            <img data-src="{{ asset('assets/images/svg/sibapp.svg') }}"
                                width="150px" height="44px" loading="lazy" alt="دریافت از سیبچه"
                                src="{{ asset('assets/images/svg/sibapp.svg') }}">
                        </a>
                    @endif
                </div>
            </div>
        @endif
        <div class="u-flex u-justify-between">
            <div>
                <article class="c-new-footer__seo-container">
                    <h1 class="c-new-footer__seo-title">
                        {{ persianNum($settings->where('name', 'footer_desc_title')->first()->value ?? '') }}
                    </h1>
                    <p style="text-align: justify">
                        <span class="c-new-footer__seo-content" id="seo-main-content">
                            {{ persianNum($settings->where('name', 'footer_description')->first()->value) }}
                        </span>
                    </p>
                </article>
            </div>
            <div class="u-flex">
                @if ($samandehi = $settings->where('name', 'samandehi_link')->first()->value)
                    <div class="c-new-footer__trust-symbol">
                        {{ $samandehi }}
                    </div>
                @endif
                @if ($ecunion = $settings->where('name', 'ecunion_link')->first()->value)
                    <div class="c-new-footer__trust-symbol">
                        {{ $ecunion }}
                    </div>
                @endif
                @if ($enamad = $settings->where('name', 'enamad_link')->first()->value)
                    <div class="c-new-footer__trust-symbol">
                        {{ $enamad }}
                    </div>
                @endif
            </div>
        </div>
        <div class="c-new-footer__copyright u-text-center">
            {{ persianNum($settings->where('name', 'copyright_text')->first()->value) }}
        </div>
    </footer>
</div>

{!! $settings->where('name', 'custom_footer_code')->first()->value ?? '' !!}
