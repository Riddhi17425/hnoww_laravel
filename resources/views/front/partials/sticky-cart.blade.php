@unless (request()->routeIs('front.cart.view', 'front.checkout.view', 'front.payment.success', 'front.get.success', 'front.get.failed'))
    @php
        $stickyCartCount = Auth::check()
            ? \App\Models\Cart::where('user_id', Auth::id())->sum('quantity')
            : \App\Models\Cart::where('session_id', session()->getId())->sum('quantity');
    @endphp

    <style>
        .sticky_cart_bar {
            position: fixed;
            left: 24px;
            bottom: 24px;
            z-index: 1040;
            display: none;
            align-items: center;
            gap: 10px;
            padding: 14px 22px;
            border-radius: 50px;
            background: rgb(140 138 114);
            color: #fff;
            font-size: 18px;
            line-height: 1;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .25);
            transition: transform .2s ease;
        }

        .sticky_cart_bar.is-visible {
            display: inline-flex;
        }

        .sticky_cart_bar:hover {
            color: #fff;
            transform: translateY(-2px);
        }

        .sticky_cart_bar .sticky_cart_icon {
            position: relative;
            display: inline-flex;
        }

        .sticky_cart_bar .sticky_cart_icon svg {
            width: 26px;
            height: 26px;
        }

        .sticky_cart_bar .sticky_cart_badge {
            position: absolute;
            top: -8px;
            left: -6px;
            min-width: 18px;
            height: 18px;
            padding: 0 4px;
            border-radius: 9px;
            background: #fff;
            color: rgb(140 138 114);
            font-size: 11px;
            font-weight: 600;
            line-height: 18px;
            text-align: center;
        }

        @media (max-width: 767px) {
            .sticky_cart_bar {
                left: 12px;
                bottom: 12px;
                padding: 12px 18px;
                font-size: 16px;
            }
        }
    </style>

    <a href="{{ route('front.cart.view') }}" id="sticky-cart-bar"
        class="sticky_cart_bar {{ $stickyCartCount > 0 ? 'is-visible' : '' }}">
        <span class="sticky_cart_icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M6 7h12l-1 13H7L6 7z" />
                <path d="M9 7a3 3 0 0 1 6 0" />
            </svg>
            <span class="sticky_cart_badge cart-total" id="sticky-cart-count">{{ $stickyCartCount }}</span>
        </span>
        <span>View cart (<span class="sticky_cart_total">{{ $stickyCartCount }}</span>)</span>
    </a>

    <script>
        (function() {
            var bar = document.getElementById('sticky-cart-bar');
            var badge = document.getElementById('sticky-cart-count');
            if (!bar || !badge) return;

            function sync() {
                var count = parseInt(badge.textContent, 10) || 0;
                bar.querySelector('.sticky_cart_total').textContent = count;
                bar.classList.toggle('is-visible', count > 0);
            }

            // cart.js updates every .cart-total after add-to-cart; mirror it here
            new MutationObserver(sync).observe(badge, {
                childList: true,
                characterData: true,
                subtree: true
            });

            // cart.js calls .show() on cart-total, which would inline-style the badge; harmless
        })();
    </script>
@endunless
