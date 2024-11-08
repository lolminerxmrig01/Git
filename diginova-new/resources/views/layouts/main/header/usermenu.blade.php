<div class="container c-profile-page">
    <section class="o-page">
        <div class="o-page__row">
            <section class="o-page__aside">
                <div class="c-profile-aside">
                    <div class="c-profile-box">
                        <div class="c-profile-box__section" style="padding-bottom: 10px;">
                            <div class="c-profile-box__header">
                                <div class="c-profile-box__avatar js-user-avatar js-change-avatar"
                                     style="background-image: url({{ asset('assets/images/svg/user.svg') }})">
                                </div>
                                <div class="c-profile-box__header-content">
                                    <div class="c-profile-box__username">
                                        {{ !is_null($customer->first_name)? $customer->first_name . ' ' . $customer->last_name : '' }}
                                    </div>
                                    <div class="c-profile-box__phone">{{ $customer->mobile }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="c-profile-box__section">
                            <ul class="c-profile-menu">
                                <li>
                                    <a href="{{ route('customer.panel.myOrders') }}"
                                    class="c-profile-menu__item c-profile-menu__item--orders
                                        {{ (request()->routeIs('customer.panel.myOrders'))? 'is-active' : '' }}">
                                        سفارش‌های من
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.panel.favorites') }}"
                                       class="c-profile-menu__item c-profile-menu__item--wishlist
                                        {{ (request()->routeIs('customer.panel.favorites'))? 'is-active' : '' }}">
                                        لیست‌ها
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.panel.comments') }}"
                                       class="c-profile-menu__item c-profile-menu__item--comments
                                        {{ (request()->routeIs('customer.panel.comments'))? 'is-active' : '' }}">
                                        نظرات
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.panel.addresses') }}"
                                       class="c-profile-menu__item c-profile-menu__item--address
                                        {{ (request()->routeIs('customer.panel.addresses'))? 'is-active' : '' }}">
                                        نشانی‌ها
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.panel.giftcards') }}"
                                       class="c-profile-menu__item c-profile-menu__item--gifts
                                        {{ (request()->routeIs('customer.panel.giftcards'))? 'is-active' : '' }}">
                                        کارت‌های هدیه
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.panel.notification') }}"
                                       class="c-profile-menu__item c-profile-menu__item--message
                                        {{ (request()->routeIs('customer.panel.notification'))? 'is-active' : '' }}">
                                        پیغام‌ها
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.panel.userHistory') }}"
                                       class="c-profile-menu__item c-profile-menu__item--user-history
                                        {{ (request()->routeIs('customer.panel.userHistory'))? 'is-active' : '' }}">
                                        بازدیدهای اخیر
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.panel.personalInfo') }}"
                                       class="c-profile-menu__item c-profile-menu__item--user-info
                                        {{ (request()->routeIs('customer.panel.personalInfo'))? 'is-active' : '' }}">
                                        اطلاعات حساب
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="c-profile-box__section">
                            <a href="{{ route('customer.logout') }}"
                               class="js-logout-button c-profile-menu__item c-profile-menu__item--sign-out">
                                خروج
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            @yield('o-page__content')
        </div>
    </section>
</div>
