@include('layouts.frontheader')
<style>
    .theme-green .header-scrolled {
        background: #EDEAE4;
    }

    .theme-green .language-select .dropdown-input-lan {
        color: #0e2233;
    }

    /* Status Pills (site standard) */
    .status_pill {
        display: inline-block;
        width: fit-content;
        padding: 5px 14px;
        background-color: #0d5e4c;
        border-radius: 25px;
        color: #ffffff !important;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .status_green {
        background-color: #0d5e4c;
        color: #ffffff !important;
    }
    .status_red {
        background-color: #C3181E;
        color: #ffffff !important;
    }

    /* Shopping Summery Table (site standard) */
    .shopping-summery {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid var(--gold-color);
        background: var(--white-color);
    }
    .shopping-summery thead tr {
        background: var(--gold-color);
        color: var(--white-color);
    }
    .shopping-summery th {
        padding: 14px 10px;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--white-color) !important;
        text-align: center;
        border: none;
        font-size: 13px;
        letter-spacing: 0.5px;
    }
    .shopping-summery td {
        padding: 18px 14px;
        vertical-align: middle;
        text-align: center;
        font-size: 16px;
        color: var(--dark-900);
        border-bottom: 1px solid #eee;
    }
    .shopping-summery tbody tr:last-child td {
        border-bottom: none;
    }

    /* Order Summary Table Responsive Wrapper & Styled Scrollbar */
    .order-summary-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: 1px solid var(--gold-color);
        background: var(--white-color);
        scrollbar-width: thin;
        scrollbar-color: var(--gold-color) #f9f7f4;
    }
    .order-summary-responsive::-webkit-scrollbar {
        height: 6px;
    }
    .order-summary-responsive::-webkit-scrollbar-track {
        background: #f9f7f4;
    }
    .order-summary-responsive::-webkit-scrollbar-thumb {
        background: var(--gold-color);
        border-radius: 3px;
    }
    .order-summary-responsive .shopping-summery {
        width: 100%;
        margin-bottom: 0;
        border: none;
    }

    /* Section Headings - Website Standard Decorative Header */
    .order_detail_head {
        text-align: center;
        margin-top: 5px;
        margin-bottom: 25px;
    }
    .order_detail_head .sub_head {
        color: var(--dark-900) !important;
        font-family: var(--heading-font) !important;
        font-size: 24px !important;
        line-height: 34px !important;
        font-weight: 500 !important;
        letter-spacing: 0.3px;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 16px !important;
        margin-bottom: 0 !important;
    }
    .order_detail_head .sub_head svg {
        vertical-align: middle;
        width: 63px;
        height: 6px;
        display: inline-block;
        flex-shrink: 0;
        transition: width 0.3s ease;
    }
    .order_detail_head .sub_head svg path {
        fill: var(--gold-color);
    }

    /* Card Container System (with website signature gold border) */
    .order_detail_card {
        background: var(--white-color);
        border: 1px solid var(--gold-color);
        border-radius: 0;
        padding: 30px;
        margin-bottom: 30px;
    }

    .order_detail_wrapper {
        margin-bottom: 30px;
    }

    /* Icons */
    .order-icon {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        color: var(--gold-color);
        flex-shrink: 0;
        display: inline-block;
        vertical-align: middle;
    }
    .order-icon-sm {
        width: 16px;
        height: 16px;
    }

    /* Delivery Address Section */
    .address-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 35px;
    }
    .address-column {
        position: relative;
    }
    .address-column:first-child {
        padding-right: 35px;
        border-right: 1px solid #f0eae1;
    }
    .address-subheading {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--gold-color);
        font-weight: 600;
        margin-bottom: 22px;
        padding-bottom: 8px;
        border-bottom: 1px dashed rgba(199, 181, 140, 0.4);
    }
    .address-entry {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 18px;
    }
    .address-entry:last-child {
        margin-bottom: 0;
    }
    .address-entry-icon {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 50%;
        background: #faf8f5;
        border: 1px solid rgba(199, 181, 140, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--gold-color);
        margin-top: 2px;
    }
    .address-entry-content {
        flex-grow: 1;
        min-width: 0;
    }
    .address-entry-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--secondary-color);
        margin-bottom: 3px;
        font-weight: 600;
    }
    .address-entry-val {
        font-size: 15px;
        color: var(--dark-900);
        font-weight: 500;
        line-height: 1.5;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    /* Order Tracking Section (Desktop Layout) */
    .tracking-timeline-horizontal {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
        padding: 20px 10px;
    }
    .tracking-node {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 2;
        padding: 0 10px;
    }
    .tracking-node:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 50px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e8e2d9;
        z-index: 1;
        transition: all 0.4s ease;
    }
    .tracking-node.is-completed:not(:last-child)::after {
        height: 3px;
        top: 49.5px;
        background: #B58A46;
        box-shadow: 0 1px 3px rgba(181, 138, 70, 0.25);
        border-radius: 2px;
        z-index: 2;
    }
    .tracking-node-stepnum {
        font-size: 12px;
        line-height: 14px;
        font-weight: 600;
        letter-spacing: 1px;
        color: var(--secondary-color);
        margin-bottom: 11px;
        text-transform: uppercase;
    }
    .tracking-node.is-completed .tracking-node-stepnum,
    .tracking-node.is-active .tracking-node-stepnum {
        color: #b58a46;
        font-weight: 700;
    }
    .tracking-node-iconbox {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #ffffff;
        border: 1.5px solid #ded6ca;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #b8b2aa;
        margin-bottom: 14px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 3;
    }
    .tracking-node.is-completed .tracking-node-iconbox {
        background: #faf5eb;
        border: 2px solid #b58a46;
        color: #b58a46;
        box-shadow: 0 2px 8px rgba(181, 138, 70, 0.22);
    }
    .tracking-node.is-active .tracking-node-iconbox {
        background: #ffffff;
        border: 2.5px solid #b58a46;
        color: #b58a46;
        box-shadow: 0 0 0 6px rgba(181, 138, 70, 0.25), 0 4px 14px rgba(181, 138, 70, 0.22);
    }
    .tracking-node-title {
        font-family: var(--heading-font);
        font-size: 16px;
        font-weight: 600;
        color: #8c827a;
        margin-bottom: 4px;
        transition: color 0.3s ease;
    }
    .tracking-node.is-completed .tracking-node-title,
    .tracking-node.is-active .tracking-node-title {
        color: var(--dark-900);
        font-weight: 700;
    }
    .tracking-node-desc {
        font-size: 12px;
        color: var(--grey-666);
        line-height: 1.4;
    }
    .tracking-node.is-active .tracking-node-desc {
        color: #b58a46;
        font-weight: 600;
    }


    /* Product in this Order Section */
    .product-cards-row {
        margin: 0 -12px;
    }
    .product-luxury-card {
        display: flex;
        align-items: stretch;
        gap: 20px;
        padding: 22px;
        background: #ffffff;
        border: 1px solid #ede8e0;
        border-radius: 4px;
        transition: all 0.3s ease;
        height: 100%;
    }
    .product-luxury-card:hover {
        border-color: var(--gold-color);
        box-shadow: 0 6px 22px rgba(14, 34, 51, 0.04);
    }
    .product-thumb-wrapper {
        width: 140px;
        height: 140px;
        min-width: 140px;
        flex-shrink: 0;
        background: #faf8f5;
        border: 1px solid #ede8e0;
        border-radius: 4px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-thumb-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .product-luxury-card:hover .product-thumb-wrapper img {
        transform: scale(1.04);
    }
    .product-content-wrapper {
        flex-grow: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .product-name-link {
        text-decoration: none;
    }
    .product-name {
        font-family: var(--heading-font);
        font-size: 20px;
        font-weight: 500;
        color: var(--dark-900);
        margin: 0 0 12px 0;
        line-height: 1.35;
        word-break: break-word;
        overflow-wrap: break-word;
        transition: color 0.3s ease;
    }
    .product-name-link:hover .product-name {
        color: var(--gold-color);
    }
    .product-meta-flex {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 22px;
        align-items: center;
        margin-bottom: 14px;
    }
    .product-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--secondary-color);
    }
    .product-meta-item .order-icon {
        width: 15px;
        height: 15px;
        color: var(--gold-color);
    }
    .product-meta-val {
        color: var(--dark-900);
        font-weight: 600;
    }
    .product-subtotal-strip {
        padding-top: 12px;
        border-top: 1px dashed #e8e2d9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px;
    }
    .product-subtotal-text {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 600;
        color: var(--secondary-color);
    }
    .product-subtotal-amount {
        font-size: 16px;
        font-weight: 600;
        color: var(--gold-color);
        /* font-family: var(--heading-font); */
    }

    /* Back to Order Button */
    .back-order-btn-wrap {
        text-align: center;
        margin-top: 40px;
        margin-bottom: 25px;
        display: flex;
        justify-content: center;
    }
    .back-order-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        padding: 13px 32px !important;
        font-size: 14px !important;
        letter-spacing: 1.2px !important;
        text-transform: uppercase !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
    }
    .back-order-btn .back-btn-arrow {
        width: 17px;
        height: 17px;
        stroke: currentColor;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }
    .back-order-btn:hover .back-btn-arrow {
        transform: translateX(-4px);
    }

    /* =======================================================
       RESPONSIVE DESIGN ACROSS ALL SCREEN SIZES
       ======================================================= */

    /* 1. Laptops & Medium Desktops (992px to 1199px) */
    @media (max-width: 1199px) {
        .title_60 {
            font-size: 50px;
        }
        .tracking-node-iconbox {
            width: 44px;
            height: 44px;
        }
        .tracking-node:not(:last-child)::after {
            top: 46px;
            height: 2px;
        }
        .tracking-node.is-completed:not(:last-child)::after {
            top: 45.5px;
            height: 3px;
        }
        .tracking-node-title {
            font-size: 14px;
        }
        .tracking-node-desc {
            font-size: 11px;
        }
        .product-luxury-card {
            padding: 18px;
            gap: 16px;
        }
        .product-thumb-wrapper {
            width: 120px;
            height: 120px;
            min-width: 120px;
        }
        .product-name {
            font-size: 18px;
            margin-bottom: 8px;
        }
        .product-subtotal-amount {
            font-size: 18px;
        }
    }

    /* 2. Tablets & Medium Screens (768px to 991px) */
    @media (max-width: 991px) {
        .mt_60 {
            margin-top: 40px !important;
        }
        .mb_120 {
            margin-bottom: 70px !important;
        }
        .title_60 {
            font-size: 42px;
        }
        .section_header {
            margin-bottom: 30px;
        }
        .section_header .sub_head {
            font-size: 13px;
            gap: 12px !important;
        }
        .section_header .sub_head svg,
        .order_detail_head .sub_head svg {
            width: 45px !important;
            height: 5px !important;
        }
        .order_detail_head .sub_head {
            font-size: 20px !important;
            gap: 12px !important;
        }
        .order_detail_card {
            padding: 24px 20px;
            margin-bottom: 24px;
        }
        
        /* Delivery Address Stacked on Tablet */
        .address-grid {
            grid-template-columns: 1fr;
            gap: 22px;
        }
        .address-column:first-child {
            padding-right: 0;
            padding-bottom: 22px;
            border-right: none;
            border-bottom: 1px dashed rgba(199, 181, 140, 0.4);
        }

        /* Order Tracking Vertical Timeline */
        .tracking-timeline-horizontal {
            flex-direction: column;
            align-items: stretch;
            padding: 10px 0 10px 5px;
            gap: 0;
        }
        .tracking-node {
            display: flex;
            align-items: flex-start;
            text-align: left;
            padding: 0 0 24px 0;
            gap: 16px;
            position: relative;
        }
        .tracking-node:last-child {
            padding-bottom: 0;
        }
        .tracking-node-stepnum {
            display: none;
        }
        .tracking-node-iconbox {
            width: 44px;
            height: 44px;
            min-width: 44px;
            margin-bottom: 0;
            flex-shrink: 0;
            position: relative;
            z-index: 3;
            background: #ffffff;
        }
        .tracking-node.is-completed .tracking-node-iconbox {
            background: #faf5eb;
            border-color: #b58a46;
            color: #b58a46;
        }
        .tracking-node:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 22px; /* Starts at center of 44px iconbox */
            left: 21px; /* 44 / 2 - 2 / 2 = 21px */
            width: 2px;
            height: 100%; /* Seamlessly reaches into center of next iconbox */
            background: #e8e2d9;
            z-index: 1;
        }
        .tracking-node.is-completed:not(:last-child)::after {
            width: 3px;
            left: 20.5px;
            background: #B58A46;
            box-shadow: none;
            border-radius: 2px;
            z-index: 2;
        }
        .tracking-node-content {
            padding-top: 3px;
            flex-grow: 1;
        }
        .tracking-node-title {
            font-size: 15px;
            margin-bottom: 3px;
        }
        .tracking-node-desc {
            font-size: 12.5px;
        }

        /* Product Cards on Tablet (50% 50% columns maintained) */
        .product-luxury-card {
            gap: 14px;
            padding: 16px;
        }
        .product-thumb-wrapper {
            width: 100px;
            height: 100px;
            min-width: 100px;
        }
        .product-name {
            font-size: 16px;
            margin-bottom: 6px;
        }
        .product-meta-flex {
            gap: 6px 14px;
            margin-bottom: 8px;
        }
        .product-meta-item {
            font-size: 13px;
        }
        .product-subtotal-strip {
            padding-top: 8px;
        }
        .product-subtotal-text {
            font-size: 12px;
        }
        .product-subtotal-amount {
            font-size: 16px;
        }
    }

    /* 3. Table Responsive Mobile Isolation (<= 768px) */
    @media (max-width: 768px) {
        .order-summary-responsive .shopping-summery,
        .order-summary-responsive .shopping-summery tbody,
        .order-summary-responsive .shopping-summery thead {
            display: table !important;
            width: 100% !important;
            min-width: 580px !important;
        }
        .order-summary-responsive .shopping-summery thead {
            display: table-header-group !important;
        }
        .order-summary-responsive .shopping-summery tbody {
            display: table-row-group !important;
        }
        .order-summary-responsive .shopping-summery tr {
            display: table-row !important;
            position: static !important;
            padding: 0 !important;
            border: none !important;
            margin-bottom: 0 !important;
        }
        .order-summary-responsive .shopping-summery th {
            display: table-cell !important;
            padding: 12px 8px !important;
            font-size: 11.5px !important;
            letter-spacing: 0.3px !important;
            white-space: nowrap !important;
            text-align: center !important;
            background: var(--gold-color) !important;
            color: var(--white-color) !important;
        }
        .order-summary-responsive .shopping-summery td {
            display: table-cell !important;
            position: static !important;
            padding: 13px 8px !important;
            font-size: 13.5px !important;
            white-space: nowrap !important;
            text-align: center !important;
            border-bottom: 1px solid #eee !important;
        }
        .order-summary-responsive .shopping-summery .status_pill {
            padding: 4px 10px !important;
            font-size: 11px !important;
        }
    }

    /* 4. Standard Mobile Screens (<= 767px) */
    @media (max-width: 767px) {
        .mt_60 {
            margin-top: 30px !important;
        }
        .mb_120 {
            margin-bottom: 55px !important;
        }
        .section_header {
            margin-bottom: 22px;
        }
        .title_60 {
            font-size: 36px;
        }
        .section_header .sub_head {
            font-size: 12px;
            gap: 10px !important;
        }
        .section_header .sub_head svg,
        .order_detail_head .sub_head svg {
            width: 36px !important;
            height: 5px !important;
        }
        .order_detail_head {
            margin-bottom: 18px;
        }
        .order_detail_head .sub_head {
            font-size: 18px !important;
            gap: 10px !important;
        }
        .order_detail_card {
            padding: 18px 15px;
            margin-bottom: 18px;
        }

        /* Product Cards on Mobile: Full-width card with comfortable spacing */
        .product-luxury-card {
            padding: 16px;
            gap: 16px;
        }
        .product-thumb-wrapper {
            width: 105px;
            height: 105px;
            min-width: 105px;
        }
        .product-name {
            font-size: 17px;
            margin-bottom: 8px;
        }
        .product-meta-flex {
            gap: 8px 16px;
            margin-bottom: 10px;
        }
        .product-meta-item {
            font-size: 13px;
        }
        .product-subtotal-amount {
            font-size: 17px;
        }
    }

    /* 5. Small Mobile / Phones (<= 575px) */
    @media (max-width: 575px) {
        .mt_60 {
            margin-top: 22px !important;
        }
        .mb_120 {
            margin-bottom: 40px !important;
        }
        .title_60 {
            font-size: 28px !important;
            line-height: 1.25 !important;
        }
        .section_header .sub_head {
            font-size: 11.5px;
            gap: 8px !important;
        }
        .section_header .sub_head svg,
        .order_detail_head .sub_head svg {
            width: 28px !important;
            height: 4.5px !important;
        }
        .order_detail_head .sub_head {
            font-size: 16px !important;
            gap: 8px !important;
        }
        .order_detail_card {
            padding: 15px 12px;
            margin-bottom: 16px;
        }
        .address-subheading {
            font-size: 11px;
            margin-bottom: 14px;
        }
        .address-entry {
            gap: 11px;
            margin-bottom: 14px;
        }
        .address-entry-icon {
            width: 30px;
            height: 30px;
            min-width: 30px;
        }
        .address-entry-icon .order-icon {
            width: 14px;
            height: 14px;
        }
        .address-entry-label {
            font-size: 11px;
        }
        .address-entry-val {
            font-size: 13.5px;
        }

        /* Order Tracking on Small Mobile */
        .tracking-node {
            gap: 12px;
            padding-bottom: 22px;
        }
        .tracking-node-iconbox {
            width: 38px;
            height: 38px;
            min-width: 38px;
        }
        .tracking-node-iconbox .order-icon {
            width: 17px;
            height: 17px;
        }
        .tracking-node:not(:last-child)::after {
            top: 19px; /* Center of 38px circle */
            left: 18px; /* 38 / 2 - 2 / 2 = 18px */
            width: 2px;
            height: 100%;
            background: #e8e2d9;
        }
        .tracking-node.is-completed:not(:last-child)::after {
            width: 3px;
            left: 17.5px;
            background: #B58A46;
            box-shadow: none;
            border-radius: 2px;
        }
        .tracking-node-title {
            font-size: 14px;
        }
        .tracking-node-desc {
            font-size: 11.5px;
        }

        /* Product Cards on Small Mobile */
        .product-cards-row {
            --bs-gutter-y: 14px;
            --bs-gutter-x: 14px;
            margin: 0 -7px;
        }
        .product-luxury-card {
            padding: 13px 11px;
            gap: 12px;
        }
        .product-thumb-wrapper {
            width: 85px;
            height: 85px;
            min-width: 85px;
        }
        .product-name {
            font-size: 15px;
            margin-bottom: 6px;
        }
        .product-meta-flex {
            gap: 6px 12px;
            margin-bottom: 8px;
        }
        .product-meta-item {
            font-size: 12px;
            gap: 5px;
        }
        .product-meta-item .order-icon {
            width: 13px;
            height: 13px;
        }
        .product-subtotal-strip {
            padding-top: 7px;
        }
        .product-subtotal-text {
            font-size: 11px;
        }
        .product-subtotal-amount {
            font-size: 15px;
        }

        /* Back to Order Button: Full Width Mobile Friendly */
        .back-order-btn-wrap {
            text-align: center;
            margin-top: 22px !important;
            margin-bottom: 12px !important;
            display: flex;
            justify-content: center;
        }
        .back-order-btn-wrap .back-order-btn {
            display: inline-flex !important;
            width: 100% !important;
            max-width: 320px;
            text-align: center !important;
            justify-content: center !important;
            padding: 12px 20px !important;
            font-size: 13.5px !important;
            letter-spacing: 0.8px !important;
        }
    }

    /* 6. Extra Small Mobile (<= 380px, e.g. iPhone SE, Galaxy Fold) */
    @media (max-width: 380px) {
        .title_60 {
            font-size: 24px !important;
        }
        .section_header .sub_head {
            font-size: 10.5px;
            gap: 6px !important;
        }
        .section_header .sub_head svg,
        .order_detail_head .sub_head svg {
            width: 22px !important;
            height: 4px !important;
        }
        .order_detail_head .sub_head {
            font-size: 14.5px !important;
            gap: 6px !important;
        }
        .order_detail_card {
            padding: 12px 10px;
            margin-bottom: 14px;
        }
        .address-entry-icon {
            width: 28px;
            height: 28px;
            min-width: 28px;
        }
        .address-entry-icon .order-icon {
            width: 13px;
            height: 13px;
        }
        .address-entry-label {
            font-size: 10px;
        }
        .address-entry-val {
            font-size: 12.5px;
        }

        /* Tracking on Extra Small Mobile */
        .tracking-node {
            gap: 10px;
            padding-bottom: 20px;
        }
        .tracking-node-iconbox {
            width: 34px;
            height: 34px;
            min-width: 34px;
        }
        .tracking-node-iconbox .order-icon {
            width: 15px;
            height: 15px;
        }
        .tracking-node:not(:last-child)::after {
            top: 17px;
            left: 16px; /* 34 / 2 - 2 / 2 = 16px */
            width: 2px;
        }
        .tracking-node.is-completed:not(:last-child)::after {
            width: 2.5px;
            left: 15.75px;
            background: #B58A46;
            box-shadow: none;
        }
        .tracking-node-title {
            font-size: 13.5px;
        }
        .tracking-node-desc {
            font-size: 11px;
        }

        /* Product Cards on Extra Small Mobile */
        .product-luxury-card {
            padding: 10px 8px;
            gap: 10px;
        }
        .product-thumb-wrapper {
            width: 72px;
            height: 72px;
            min-width: 72px;
        }
        .product-name {
            font-size: 14px;
        }
        .product-meta-flex {
            flex-direction: column;
            align-items: flex-start;
            gap: 3px;
        }
        .product-meta-item {
            font-size: 11.5px;
        }
        .product-subtotal-amount {
            font-size: 14px;
        }
    }
</style>

<section class="mt_60 mb_120">
    <div class="container">

        <!-- Main Header (Website Native Header System) -->
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Your Order</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Order Detail</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">

                <!-- 1. ORDER SUMMARY TABLE (PELE JESA ORIGINAL & FULLY RESPONSIVE) -->
                <div class="order_detail_wrapper mb-4">
                    <div class="table-responsive order-summary-responsive">
                        <table class="table shopping-summery mb-0" style="--bs-table-bg:--bs-table-bg;">
                            <thead>
                                <tr class="main-hading">
                                    <th scope="col" class="text-nowrap">ORDER CREATED ON</th>
                                    <th scope="col" class="text-nowrap">ORDER</th>
                                    <th scope="col" class="text-nowrap">ORDER STATUS</th>
                                    <th scope="col" class="text-nowrap">PAYMENT STATUS</th>
                                    <th scope="col" class="text-nowrap">SUB TOTAL</th>
                                    {{-- @if(isset($orderDetails->discount) && $orderDetails->discount != null)
                                        <th scope="col" class="text-nowrap">DISCOUNT</th>
                                    @endif --}}
                                    <th scope="col" class="text-nowrap">TOTAL AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($orderDetails->created_at)->format('M d, Y') }}</td>
                                    <td><span>#</span>{{$orderDetails->order_number ?? $orderDetails->id}}</td>
                                    <td>
                                        <span class="status_pill @if(strtolower($orderDetails->status) == 'confirmed' || strtolower($orderDetails->status) == 'delivered') status_green @else status_red @endif">
                                            {{strtoupper($orderDetails->status) ?? '-'}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status_pill @if(strtolower($orderDetails->payment_status) == 'paid') status_green @else status_red @endif">
                                            {{strtoupper($orderDetails->payment_status) ?? '-'}}
                                        </span>
                                    </td>
                                    <td>{{number_format($orderDetails->subtotal, 2) ?? '-'}}</td>
                                    {{-- @if(isset($orderDetails->discount) && $orderDetails->discount != null)
                                        <td>{{number_format($orderDetails->discount, 2) ?? '-'}}</td>
                                    @endif --}}
                                    <td>{{number_format($orderDetails->order_total, 2) ?? '-'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 2. DELIVERY ADDRESS SECTION -->
                <div class="order_detail_wrapper order_detail_card">
                    <div class="order_detail_head my-2 mb-4">
                        <h5 class="sub_head pb-2 text-center d-flex align-items-center justify-content-center gap-3">
                            <span>
                                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46" /></svg>
                            </span>
                            <span>Delivery Address</span>
                            <span>
                                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46" /></svg>
                            </span>
                        </h5>
                    </div>
                    @if($orderDetails->orderAddress)
                        <div class="address-grid">
                            <!-- Left Column: Recipient Information -->
                            <div class="address-column">
                                <div class="address-subheading">Recipient Details</div>

                                <!-- Name -->
                                <div class="address-entry">
                                    <div class="address-entry-icon">
                                        <svg class="order-icon order-icon-sm" viewBox="0 0 24 24" fill="none">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="1.6"/>
                                        </svg>
                                    </div>
                                    <div class="address-entry-content">
                                        <div class="address-entry-label">Recipient Name</div>
                                        <div class="address-entry-val fw-semibold" style="font-size: 16px; font-family: var(--heading-font);">
                                            {{ $orderDetails->orderAddress->name ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact No -->
                                @if(!empty($orderDetails->orderAddress->contact_no))
                                <div class="address-entry">
                                    <div class="address-entry-icon">
                                        <svg class="order-icon order-icon-sm" viewBox="0 0 24 24" fill="none">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="address-entry-content">
                                        <div class="address-entry-label">Contact Number</div>
                                        <div class="address-entry-val">
                                            {{ $orderDetails->orderAddress->contact_no }}
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- WhatsApp No -->
                                @if(!empty($orderDetails->orderAddress->whatsapp_no))
                                <div class="address-entry">
                                    <div class="address-entry-icon">
                                        <svg class="order-icon order-icon-sm" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="address-entry-content">
                                        <div class="address-entry-label">WhatsApp Number</div>
                                        <div class="address-entry-val">
                                            {{ $orderDetails->orderAddress->whatsapp_no }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Right Column: Shipping Destination -->
                            <div class="address-column">
                                <div class="address-subheading">Shipping Destination</div>

                                <!-- Emirate -->
                                @if(!empty($orderDetails->orderAddress->emirate))
                                <div class="address-entry">
                                    <div class="address-entry-icon">
                                        <svg class="order-icon order-icon-sm" viewBox="0 0 24 24" fill="none">
                                            <rect x="4" y="2" width="16" height="20" rx="2" stroke="currentColor" stroke-width="1.6"/>
                                            <line x1="9" y1="6" x2="9" y2="6.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <line x1="15" y1="6" x2="15" y2="6.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <line x1="9" y1="10" x2="9" y2="10.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <line x1="15" y1="10" x2="15" y2="10.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <line x1="9" y1="14" x2="9" y2="14.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <line x1="15" y1="14" x2="15" y2="14.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M10 22v-4h4v4" stroke="currentColor" stroke-width="1.6"/>
                                        </svg>
                                    </div>
                                    <div class="address-entry-content">
                                        <div class="address-entry-label">Emirate / City</div>
                                        <div class="address-entry-val fw-medium">
                                            {{ $orderDetails->orderAddress->emirate }}
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Address -->
                                <div class="address-entry">
                                    <div class="address-entry-icon">
                                        <svg class="order-icon order-icon-sm" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.6"/>
                                        </svg>
                                    </div>
                                    <div class="address-entry-content">
                                        <div class="address-entry-label">Complete Address</div>
                                        <div class="address-entry-val">
                                            {{ $orderDetails->orderAddress->address_line1 ?? '' }}
                                            @if(!empty($orderDetails->orderAddress->address_line2))
                                                <br>{{ $orderDetails->orderAddress->address_line2 }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Landmark -->
                                @if(!empty($orderDetails->orderAddress->landmark))
                                <div class="address-entry">
                                    <div class="address-entry-icon">
                                        <svg class="order-icon order-icon-sm" viewBox="0 0 24 24" fill="none">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="address-entry-content">
                                        <div class="address-entry-label">Landmark</div>
                                        <div class="address-entry-val">
                                            {{ $orderDetails->orderAddress->landmark }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <p class="text-muted text-center py-4 mb-0" style="font-style: italic;">No delivery address associated with this order.</p>
                    @endif
                </div>

                <!-- 3. ORDER TRACKING SECTION (NEW) -->
                <div class="order_detail_wrapper order_detail_card">
                    <div class="order_detail_head my-2 mb-4">
                        <h5 class="sub_head pb-2 text-center d-flex align-items-center justify-content-center gap-3">
                            <span>
                                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46" /></svg>
                            </span>
                            <span>Order Tracking</span>
                            <span>
                                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46" /></svg>
                            </span>
                        </h5>
                    </div>
                    @php
                        $rawStatus = strtolower(trim($orderDetails->status ?? 'pending'));
                        $currentStep = 1;
                        if ($rawStatus === 'confirmed') {
                            $currentStep = 2;
                        } elseif (in_array($rawStatus, ['processing', 'in_process', 'packed', 'preparing'])) {
                            $currentStep = 3;
                        } elseif (in_array($rawStatus, ['shipped', 'dispatched', 'in_transit', 'out_for_delivery'])) {
                            $currentStep = 4;
                        } elseif (in_array($rawStatus, ['delivered', 'completed'])) {
                            $currentStep = 5;
                        }
                    @endphp

                    <div class="tracking-timeline-horizontal">
                        <!-- Step 1: Order Placed -->
                        <div class="tracking-node {{ $currentStep > 1 ? 'is-completed' : ($currentStep == 1 ? 'is-active' : '') }}">
                            <div class="tracking-node-stepnum">01</div>
                            <div class="tracking-node-iconbox">
                                <svg class="order-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9l-6-6H9z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 3v6h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 14l2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="tracking-node-content">
                                <div class="tracking-node-title">Order Placed</div>
                                <div class="tracking-node-desc">
                                    {{ \Carbon\Carbon::parse($orderDetails->created_at)->format('M d, Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Order Confirmed -->
                        <div class="tracking-node {{ $currentStep > 2 ? 'is-completed' : ($currentStep == 2 ? 'is-active' : '') }}">
                            <div class="tracking-node-stepnum">02</div>
                            <div class="tracking-node-iconbox">
                                <svg class="order-icon" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/>
                                    <path d="M8.5 12.5l2.5 2.5 4.5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="tracking-node-content">
                                <div class="tracking-node-title">Order Confirmed</div>
                                <div class="tracking-node-desc">
                                    {{ $currentStep >= 2 ? 'Verified & accepted' : 'Pending verification' }}
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Processing -->
                        <div class="tracking-node {{ $currentStep > 3 ? 'is-completed' : ($currentStep == 3 ? 'is-active' : '') }}">
                            <div class="tracking-node-stepnum">03</div>
                            <div class="tracking-node-iconbox">
                                <svg class="order-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.27 6.96L12 12.01l8.73-5.05" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <line x1="12" y1="22.08" x2="12" y2="12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="tracking-node-content">
                                <div class="tracking-node-title">Processing</div>
                                <div class="tracking-node-desc">
                                    {{ $currentStep >= 3 ? 'Carefully packaging' : 'Awaiting packaging' }}
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Shipped -->
                        <div class="tracking-node {{ $currentStep > 4 ? 'is-completed' : ($currentStep == 4 ? 'is-active' : '') }}">
                            <div class="tracking-node-stepnum">04</div>
                            <div class="tracking-node-iconbox">
                                <svg class="order-icon" viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="5" width="13" height="11" rx="1.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15 9h3.5a1 1 0 0 1 .8.4L22 13v3h-7V9z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="6.5" cy="18.5" r="2.5" stroke="currentColor" stroke-width="1.6"/>
                                    <circle cx="17.5" cy="18.5" r="2.5" stroke="currentColor" stroke-width="1.6"/>
                                </svg>
                            </div>
                            <div class="tracking-node-content">
                                <div class="tracking-node-title">Shipped</div>
                                <div class="tracking-node-desc">
                                    {{ $currentStep >= 4 ? 'Dispatched with courier' : 'Handover to courier' }}
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Delivered -->
                        <div class="tracking-node {{ $currentStep == 5 ? 'is-completed is-active' : '' }}">
                            <div class="tracking-node-stepnum">05</div>
                            <div class="tracking-node-iconbox">
                                <svg class="order-icon" viewBox="0 0 24 24" fill="none">
                                    <path d="M3 10.5L12 3l9 7.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.5z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 13.5l2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="tracking-node-content">
                                <div class="tracking-node-title">Delivered</div>
                                <div class="tracking-node-desc">
                                    {{ $currentStep == 5 ? 'Safely delivered' : 'Final destination' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. PRODUCT IN THIS ORDER SECTION (50% 50% TWO-COLUMN LAYOUT) -->
                <div class="order_detail_wrapper order_detail_card">
                    <div class="order_detail_head my-2 mb-4">
                        <h5 class="sub_head pb-2 text-center d-flex align-items-center justify-content-center gap-3">
                            <span>
                                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46" /></svg>
                            </span>
                            <span>Product in this Order</span>
                            <span>
                                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46" /></svg>
                            </span>
                        </h5>
                    </div>
                    @if (isset($orderDetails->orderProducts) && is_countable($orderDetails->orderProducts) && count($orderDetails->orderProducts) > 0)
                        <div class="row g-4 product-cards-row">
                            @foreach ($orderDetails->orderProducts as $item)
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="product-luxury-card">
                                    <!-- Product Image -->
                                    <a href="{{ route('front.product.details', $item->product->product_url ?? '#') }}" class="product-thumb-wrapper">
                                        <img src="{{ isset($item->product->list_page_img) ? asset('public/images/admin/product_list/'.$item->product->list_page_img) : asset('public/images/no-image.png') }}" alt="{{ $item->product->product_name ?? 'Product Image' }}">
                                    </a>

                                    <!-- Product Details -->
                                    <div class="product-content-wrapper">
                                        <div>
                                            <a href="{{ route('front.product.details', $item->product->product_url ?? '#') }}" class="product-name-link">
                                                <h4 class="product-name">{{ $item->product->product_name ?? 'N/A' }}</h4>
                                            </a>

                                            <div class="product-meta-flex">
                                                <!-- Price -->
                                                <div class="product-meta-item">
                                                    <svg class="order-icon order-icon-sm" viewBox="0 0 24 24" fill="none">
                                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <circle cx="7" cy="7" r="1.5" fill="currentColor"/>
                                                    </svg>
                                                    <span>Price:</span>
                                                    <span class="product-meta-val">AED {{ number_format($item->price, 2) ?? '-' }}</span>
                                                </div>

                                                <!-- Quantity -->
                                                <div class="product-meta-item">
                                                    <svg class="order-icon order-icon-sm" viewBox="0 0 24 24" fill="none">
                                                        <rect x="7" y="7" width="14" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/>
                                                        <path d="M3 17V5a2 2 0 0 1 2-2h12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                                    </svg>
                                                    <span>Quantity:</span>
                                                    <span class="product-meta-val">{{ $item->quantity ?? '1' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Subtotal Bar -->
                                        <div class="product-subtotal-strip">
                                            <span class="product-subtotal-text">Item Subtotal</span>
                                            <span class="product-subtotal-amount">
                                                AED {{ number_format($item->subtotal ?? ($item->price * $item->quantity), 2) ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4 mb-0" style="font-style: italic;">No products found in this order.</p>
                    @endif
                </div>

                <!-- 5. BACK TO ORDER BUTTON (CENTERED WITH ARROW) -->
                <div class="mt-4 mb-4 back-order-btn-wrap text-center d-flex justify-content-center">
                    <a href="{{ route('front.order.view') }}" class="com_btn back-order-btn">
                        <svg class="back-btn-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Back to Order</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@include('layouts.frontfooter')