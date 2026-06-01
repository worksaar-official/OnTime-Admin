@php
    use App\CentralLogics\Helpers;
    $idSuffix = $idSuffix ?? 'dm';
    $hide_customer_details_on_delivery = Helpers::get_business_settings('hide_customer_details_on_delivery');
    $hide_customer_email_on_delivery = Helpers::get_business_settings('hide_customer_email_on_delivery');
    $hide_customer_phone_on_delivery = Helpers::get_business_settings('hide_customer_phone_on_delivery');
    $hide_customer_address_on_delivery = Helpers::get_business_settings('hide_customer_address_on_delivery');
    $hide_customer_details_legacy_all = $hide_customer_details_on_delivery == 1 && !$hide_customer_email_on_delivery && !$hide_customer_phone_on_delivery && !$hide_customer_address_on_delivery;
    $hideCustomerFields = [
        'hide_customer_phone_on_delivery' => [
            'label' => 'Hide_Customer_Phone_After_Delivered',
            'enable_title' => 'Want_to_enable_hide_customer_phone_after_delivered',
            'disable_title' => 'Want_to_disable_hide_customer_phone_after_delivered',
            'enable_text' => $idSuffix === 'store' ? 'Hide_customer_phone_from_vendors_after_delivered' : 'Hide_customer_phone_from_deliverymen_after_delivered',
            'disable_text' => $idSuffix === 'store' ? 'Show_customer_phone_to_vendors_after_delivered' : 'Show_customer_phone_to_deliverymen_after_delivered',
        ],
        'hide_customer_email_on_delivery' => [
            'label' => 'Hide_Customer_Email_After_Delivered',
            'enable_title' => 'Want_to_enable_hide_customer_email_after_delivered',
            'disable_title' => 'Want_to_disable_hide_customer_email_after_delivered',
            'enable_text' => $idSuffix === 'store' ? 'Hide_customer_email_from_vendors_after_delivered' : 'Hide_customer_email_from_deliverymen_after_delivered',
            'disable_text' => $idSuffix === 'store' ? 'Show_customer_email_to_vendors_after_delivered' : 'Show_customer_email_to_deliverymen_after_delivered',
        ],
        'hide_customer_address_on_delivery' => [
            'label' => 'Hide_Customer_Delivery_Address_After_Delivered',
            'enable_title' => 'Want_to_enable_hide_customer_address_after_delivered',
            'disable_title' => 'Want_to_disable_hide_customer_address_after_delivered',
            'enable_text' => $idSuffix === 'store' ? 'Hide_customer_address_from_vendors_after_delivered' : 'Hide_customer_address_from_deliverymen_after_delivered',
            'disable_text' => $idSuffix === 'store' ? 'Show_customer_address_to_vendors_after_delivered' : 'Show_customer_address_to_deliverymen_after_delivered',
        ],
    ];
@endphp
<div class="card mb-20" id="hide_customer_details_section_{{ $idSuffix }}">
    <div class="card-body">
        <div class="mb-20">
            <h3 class="mb-1">
                {{ translate('messages.Hide_Customer_Details_After_Order_Delivered') }}
            </h3>
            <p class="mb-0 fs-12">
                {{ translate('messages.Hide_customer_details_only_when_order_delivered') }}.
                {{ translate('messages.Choose_which_customer_details_to_hide_when_delivered') }}.
                {{ translate('messages.Customer_name_is_always_visible') }}
            </p>
        </div>
        <div class="row g-3">
            @foreach ($hideCustomerFields as $subKey => $field)
                @php($subValue = $$subKey ?? 0)
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group mb-0">
                        <span class="d-flex align-items-center mb-2">
                            <span class="text-dark pr-1">{{ translate('messages.' . $field['label']) }}</span>
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
                                data-title-on="<strong>{{ translate('messages.' . $field['enable_title']) }}</strong>"
                                data-title-off="<strong>{{ translate('messages.' . $field['disable_title']) }}</strong>"
                                data-text-on="<p>{{ translate('messages.' . $field['enable_text']) }}</p>"
                                data-text-off="<p>{{ translate('messages.' . $field['disable_text']) }}</p>"
                                class="status toggle-switch-input dynamic-checkbox-toggle"
                                value="1"
                                name="{{ $subKey }}"
                                id="{{ $subKey }}_{{ $idSuffix }}"
                                {{ ($subValue == 1 || $hide_customer_details_legacy_all) ? 'checked' : '' }}>
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
