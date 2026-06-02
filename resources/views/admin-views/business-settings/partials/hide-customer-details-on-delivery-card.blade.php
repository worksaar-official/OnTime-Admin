@php
    use App\CentralLogics\Helpers;
    $idSuffix = $idSuffix ?? 'dm';
    $settingPrefix = $idSuffix === 'store' ? 'store' : 'dm';
    $masterSettingKey = "hide_customer_details_on_delivery_{$settingPrefix}";
    $hide_customer_details_on_delivery = Helpers::get_business_settings($masterSettingKey);
    $hide_customer_email_on_delivery = Helpers::get_business_settings("hide_customer_email_on_delivery_{$settingPrefix}");
    $hide_customer_phone_on_delivery = Helpers::get_business_settings("hide_customer_phone_on_delivery_{$settingPrefix}");
    $hide_customer_address_on_delivery = Helpers::get_business_settings("hide_customer_address_on_delivery_{$settingPrefix}");
    $hide_customer_details_legacy_all = $hide_customer_details_on_delivery == 1 && !$hide_customer_email_on_delivery && !$hide_customer_phone_on_delivery && !$hide_customer_address_on_delivery;
    $isStore = $idSuffix === 'store';
    $hideCustomerFields = [
        "hide_customer_phone_on_delivery_{$settingPrefix}" => [
            'label' => $isStore ? 'Show Customer Phone' : 'Show Customer Phone After Delivered',
            'enable_title' => $isStore ? 'Want to enable Show Customer Phone?' : 'Want to enable Show Customer Phone After Delivered?',
            'disable_title' => $isStore ? 'Want to disable Show Customer Phone?' : 'Want to disable Show Customer Phone After Delivered?',
            'enable_text' => $idSuffix === 'store' ? 'If enabled, vendors can see customer phone in all order statuses.' : 'If enabled, deliverymen can see customer phone after order is delivered.',
            'disable_text' => $idSuffix === 'store' ? 'If disabled, customer phone will be hidden from vendors in all order statuses.' : 'If disabled, customer phone will be hidden from deliverymen after order is delivered.',
        ],
        "hide_customer_email_on_delivery_{$settingPrefix}" => [
            'label' => $isStore ? 'Show Customer Email' : 'Show Customer Email After Delivered',
            'enable_title' => $isStore ? 'Want to enable Show Customer Email?' : 'Want to enable Show Customer Email After Delivered?',
            'disable_title' => $isStore ? 'Want to disable Show Customer Email?' : 'Want to disable Show Customer Email After Delivered?',
            'enable_text' => $idSuffix === 'store' ? 'If enabled, vendors can see customer email in all order statuses.' : 'If enabled, deliverymen can see customer email after order is delivered.',
            'disable_text' => $idSuffix === 'store' ? 'If disabled, customer email will be hidden from vendors in all order statuses.' : 'If disabled, customer email will be hidden from deliverymen after order is delivered.',
        ],
        "hide_customer_address_on_delivery_{$settingPrefix}" => [
            'label' => $isStore ? 'Show Customer Delivery Address' : 'Show Customer Delivery Address After Delivered',
            'enable_title' => $isStore ? 'Want to enable Show Customer Delivery Address?' : 'Want to enable Show Customer Delivery Address After Delivered?',
            'disable_title' => $isStore ? 'Want to disable Show Customer Delivery Address?' : 'Want to disable Show Customer Delivery Address After Delivered?',
            'enable_text' => $idSuffix === 'store' ? 'If enabled, vendors can see customer delivery address in all order statuses.' : 'If enabled, deliverymen can see customer delivery address after order is delivered.',
            'disable_text' => $idSuffix === 'store' ? 'If disabled, customer delivery address will be hidden from vendors in all order statuses.' : 'If disabled, customer delivery address will be hidden from deliverymen after order is delivered.',
        ],
    ];
@endphp
<div class="card mb-20" id="hide_customer_details_section_{{ $idSuffix }}">
    <div class="card-body">
        <div class="mb-20">
            <h3 class="mb-1">
                {{ $isStore ? translate('messages.Hide_Customer_Details') : translate('messages.Hide_Customer_Details_After_Order_Delivered') }}
            </h3>
            <p class="mb-0 fs-12">
                {{ $isStore ? translate('Choose which customer details to hide for vendors in all order statuses') : translate('messages.Hide_customer_details_only_when_order_delivered') }}.
                {{ $isStore ? translate('These settings apply immediately on vendor panel and app') : translate('messages.Choose_which_customer_details_to_hide_when_delivered') }}.
                {{ translate('messages.Customer_name_is_always_visible') }}
            </p>
        </div>
        <div class="row g-3">
            @foreach ($hideCustomerFields as $subKey => $field)
                @php($subValue = $$subKey ?? 0)
                @php($isHidden = ($subValue == 1 || $hide_customer_details_legacy_all))
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group mb-0">
                        <span class="d-flex align-items-center mb-2">
                            <span class="text-dark pr-1">{{ translate($field['label']) }}</span>
                        </span>
                        <label class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control mb-0">
                            <span class="pr-1 d-flex align-items-center switch--label">
                                <span class="line--limit-1">{{ translate('messages.Status') }}</span>
                            </span>
                            <input type="checkbox"
                                data-id="{{ $subKey }}_{{ $idSuffix }}"
                                data-type="toggle"
                                data-image-on="{{ asset('/public/assets/admin/img/modal/info-warning.png') }}"
                                data-image-off="{{ asset('/public/assets/admin/img/modal/info-warning.png') }}"
                                data-title-on="<strong>{{ translate($field['enable_title']) }}</strong>"
                                data-title-off="<strong>{{ translate($field['disable_title']) }}</strong>"
                                data-text-on="<p>{{ translate($field['enable_text']) }}</p>"
                                data-text-off="<p>{{ translate($field['disable_text']) }}</p>"
                                class="status toggle-switch-input dynamic-checkbox-toggle"
                                value="1"
                                name="{{ $subKey }}"
                                id="{{ $subKey }}_{{ $idSuffix }}"
                                {{ !$isHidden ? 'checked' : '' }}>
                            <span class="toggle-switch-label text">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
